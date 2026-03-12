<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TestAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:all {--skip-frontend : Skip frontend checks}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all tests (frontend checks + backend tests)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🧪 Running comprehensive test suite...');
        $this->newLine();

        // Run frontend checks unless skipped
        if (!$this->option('skip-frontend')) {
            $this->info('Step 1: Frontend Checks');
            $this->line('─────────────────────────────────────');
            
            $exitCode = $this->call('test:frontend');
            
            if ($exitCode !== Command::SUCCESS) {
                $this->newLine();
                $this->error('❌ Frontend checks failed! Fix errors before running backend tests.');
                return Command::FAILURE;
            }
            
            $this->newLine();
        } else {
            $this->warn('⚠️  Skipping frontend checks...');
            $this->newLine();
        }

        // Run backend tests
        $this->info('Step 2: Backend Tests');
        $this->line('─────────────────────────────────────');
        
        $process = Process::fromShellCommandline('php artisan test --parallel');
        $process->setTimeout(300);
        $process->setTty(Process::isTtySupported());
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        $this->newLine();

        if ($process->isSuccessful()) {
            $this->info('✅ All tests passed successfully!');
            return Command::SUCCESS;
        }

        $this->error('❌ Some tests failed!');
        return Command::FAILURE;
    }
}
