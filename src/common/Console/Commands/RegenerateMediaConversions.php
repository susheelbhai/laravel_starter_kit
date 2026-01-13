<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MediaExternal;
use App\Models\MediaInternal;
use Spatie\MediaLibrary\Conversions\FileManipulator;

class RegenerateMediaConversions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


        // Run the regeneration:

        // php artisan media:regenerate --clean

        // Or for specific types:
        // php artisan media:regenerate --type=external --clean
        // php artisan media:regenerate --type=internal --clean
        // That's it! New uploads will  preserve PNG transparency, and existing media will be regenerated correctly.


    protected $signature = 'media:regenerate 
                            {--type=all : Media type to regenerate (external, internal, or all)}
                            {--ids=* : Specific media IDs to regenerate}
                            {--clean : Delete all existing conversions before regenerating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate media conversions with proper transparency support';

    /**
     * Execute the console command.
     */
    public function handle(FileManipulator $fileManipulator)
    {
        $type = strtolower($this->option('type'));
        $ids = $this->option('ids');
        $clean = $this->option('clean');
        
        // Validate type
        if (!in_array($type, ['external', 'internal', 'all'])) {
            $this->error("Invalid type '{$type}'. Must be: external, internal, or all");
            return Command::FAILURE;
        }
        
        // Determine which models to process
        $models = [];
        if ($type === 'external' || $type === 'all') {
            $models[] = ['class' => MediaExternal::class, 'name' => 'External'];
        }
        if ($type === 'internal' || $type === 'all') {
            $models[] = ['class' => MediaInternal::class, 'name' => 'Internal'];
        }
        
        $totalSuccess = 0;
        $totalFailed = 0;
        $totalCleaned = 0;
        
        foreach ($models as $modelConfig) {
            $modelClass = $modelConfig['class'];
            $modelName = $modelConfig['name'];
            
            $this->newLine();
            $this->info("Processing {$modelName} Media...");
            
            $query = $modelClass::whereIn('mime_type', ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']);
            
            if (!empty($ids)) {
                $query->whereIn('id', $ids);
            }
            
            $media = $query->get();
            
            if ($media->isEmpty()) {
                $this->warn("No {$modelName} media items found.");
                continue;
            }

            $this->info("Found {$media->count()} {$modelName} media items to regenerate.");
            
            if ($clean && $media->isNotEmpty()) {
                $this->warn('Cleaning mode: All existing conversions will be deleted first.');
                if (!$this->confirm('Do you want to continue?', true)) {
                    $this->info('Operation cancelled.');
                    continue;
                }
            }

            $progressBar = $this->output->createProgressBar($media->count());
            $progressBar->start();

            $success = 0;
            $failed = 0;
            $cleaned = 0;

            foreach ($media as $mediaItem) {
                try {
                    // Delete existing conversion files if clean mode
                    if ($clean) {
                        $conversionPath = pathinfo($mediaItem->getPath(), PATHINFO_DIRNAME) . '/conversions';
                        if (is_dir($conversionPath)) {
                            $files = glob($conversionPath . '/' . pathinfo($mediaItem->file_name, PATHINFO_FILENAME) . '-*.*');
                            foreach ($files as $file) {
                                if (file_exists($file)) {
                                    @unlink($file);
                                    $cleaned++;
                                }
                            }
                        }
                    }
                    
                    // Reset generated conversions
                    $mediaItem->update(['generated_conversions' => []]);
                    
                    // Temporarily disable queued conversions
                    config(['media-library.queue_conversions_by_default' => false]);
                    
                    // Regenerate all conversions
                    $fileManipulator->createDerivedFiles($mediaItem);
                    
                    // Re-enable queued conversions
                    config(['media-library.queue_conversions_by_default' => true]);
                    
                    $success++;
                    $progressBar->advance();
                } catch (\Exception $e) {
                    $failed++;
                    $this->newLine();
                    $this->error("Failed to regenerate media ID {$mediaItem->id}: {$e->getMessage()}");
                    $progressBar->advance();
                }
            }

            $progressBar->finish();
            $this->newLine();
            
            if ($clean) {
                $this->info("Cleaned {$cleaned} old {$modelName} conversion files.");
            }
            $this->info("{$modelName} Media - Success: {$success}, Failed: {$failed}");
            
            $totalSuccess += $success;
            $totalFailed += $failed;
            $totalCleaned += $cleaned;
        }
        
        $this->newLine();
        $this->info("=== Total Results ===");
        if ($clean) {
            $this->info("Total cleaned: {$totalCleaned} files");
        }
        $this->info("Total success: {$totalSuccess}");
        $this->info("Total failed: {$totalFailed}");
        
        return Command::SUCCESS;
    }
}
