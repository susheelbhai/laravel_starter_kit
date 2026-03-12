<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class CheckFrontend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:frontend {--skip-type-check : Skip TypeScript type checking}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check frontend code (TypeScript type check and build)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🔍 Checking frontend code...');
        $this->newLine();

        // Check if node_modules exists
        if (!$this->checkNodeModules()) {
            return Command::FAILURE;
        }

        // Run TypeScript type checking (unless skipped)
        if (!$this->option('skip-type-check')) {
            if (!$this->runTypeCheck()) {
                $this->error('❌ TypeScript errors must be fixed before proceeding!');
                $this->comment('   Run "npm run type-check" to see all errors');
                $this->comment('   Or use --skip-type-check to bypass (not recommended)');
                return Command::FAILURE;
            }
        } else {
            $this->warn('⚠️  Skipping TypeScript type check...');
        }

        // Build the frontend
        if (!$this->buildFrontend()) {
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info('✅ All frontend checks passed!');

        return Command::SUCCESS;
    }

    private function checkNodeModules(): bool
    {
        if (!File::exists(base_path('node_modules'))) {
            $this->warn('❌ node_modules not found. Installing dependencies...');

            $process = Process::fromShellCommandline('npm install');
            $process->setTimeout(300);
            $process->run();

            if (!$process->isSuccessful()) {
                $this->error('Failed to install npm dependencies');
                return false;
            }

            $this->line('<fg=green>✅ Dependencies installed</fg=green>');
        }

        return true;
    }

    private function runTypeCheck(): bool
    {
        $this->info('📝 Running TypeScript type check...');

        $process = Process::fromShellCommandline('npm run type-check');
        $process->setTimeout(120);
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ No TypeScript errors</fg=green>');
            return true;
        }

        $this->error('   ❌ TypeScript type check failed!');
        return false;
    }

    private function buildFrontend(): bool
    {
        $this->info('🏗️  Building frontend assets...');

        $process = Process::fromShellCommandline('npm run build:check');
        $process->setTimeout(300);
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ Frontend build successful</fg=green>');
            return true;
        }

        $this->error('   ❌ Frontend build failed!');
        $this->newLine();
        $this->line($process->getErrorOutput());
        return false;
    }
}
