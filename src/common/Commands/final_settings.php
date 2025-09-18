<?php

namespace Susheelbhai\StarterKit\common\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class final_settings extends Command
{
    protected $signature = 'starter_kit:final_settings';

    protected $description = 'To change some final settings which is required on starting new project';

    public function handle()
    {
        $delete_unused_file = $this->ask("Do you want to delete unused files? (yes/no)", 'yes');
        
        // $custom_path_after_root_url = $this->ask("custom path after root url", $project_name . '/public_html');
       
        // new UpdateAppServiceProvider()->handle($this, $custom_path_after_root_url);
        
        
        // new UpdateIndexFile()->handle($this);
        new UpdateAppServiceProvider()->uncomment($this);
        if ($delete_unused_file == 'yes') {
            $this->deleteUnusedFolder();
        }
    }


    private function deleteUnusedFolder()
    {
        try {
            File::deleteDirectory(base_path('resources/js/pages/auth'));
            File::deleteDirectory(base_path('resources/js/pages/settings'));
            File::deleteDirectory(base_path('app/Http/Controllers/Auth'));
            File::deleteDirectory(base_path('app/Http/Controllers/Settings'));
        } catch (\Throwable $th) {
            return $th;
        }
        $this->line("Unused files and folders removed");
        return true;
    }
}
