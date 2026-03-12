<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class SetupTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the comprehensive testing environment';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Setting up comprehensive test environment...');
        $this->newLine();

        // Step 1: Check Node.js
        if (!$this->checkNodeJs()) {
            return Command::FAILURE;
        }

        // Step 2: Check npm
        if (!$this->checkNpm()) {
            return Command::FAILURE;
        }

        // Step 3: Install npm dependencies
        if (!$this->installNpmDependencies()) {
            return Command::FAILURE;
        }

        // Step 4: Check TypeScript
        $this->checkTypeScript();

        // Step 5: Run TypeScript type check
        $this->runTypeCheck();

        // Step 6: Build frontend
        if (!$this->buildFrontend()) {
            return Command::FAILURE;
        }

        // Step 7: Check Composer
        if (!$this->checkComposer()) {
            return Command::FAILURE;
        }

        // Step 8: Install Composer dependencies
        if (!$this->installComposerDependencies()) {
            return Command::FAILURE;
        }

        // Step 9: Check .env file
        $this->checkEnvFile();

        // Step 10: Generate app key if needed
        $this->checkAppKey();

        $this->newLine();
        $this->info('✨ Setup complete! You can now run tests with:');
        $this->newLine();
        $this->line('   <fg=cyan>php artisan test</fg=cyan>           # Run all tests');
        $this->line('   <fg=cyan>php artisan test --parallel</fg=cyan> # Run tests in parallel');
        $this->line('   <fg=cyan>php artisan test:frontend</fg=cyan>   # Check frontend only');
        $this->newLine();
        $this->comment('📚 See TESTING.md for complete documentation');

        return Command::SUCCESS;
    }

    private function checkNodeJs(): bool
    {
        $this->info('1️⃣  Checking Node.js installation...');

        $process = Process::fromShellCommandline('node --version');
        $process->run();

        if ($process->isSuccessful()) {
            $version = trim($process->getOutput());
            $this->line("   <fg=green>✅ Node.js {$version} installed</fg=green>");
            return true;
        }

        $this->error('   ❌ Node.js not found. Please install Node.js first.');
        return false;
    }

    private function checkNpm(): bool
    {
        $this->info('2️⃣  Checking npm installation...');

        $process = Process::fromShellCommandline('npm --version');
        $process->run();

        if ($process->isSuccessful()) {
            $version = trim($process->getOutput());
            $this->line("   <fg=green>✅ npm {$version} installed</fg=green>");
            return true;
        }

        $this->error('   ❌ npm not found. Please install npm first.');
        return false;
    }

    private function installNpmDependencies(): bool
    {
        $this->info('3️⃣  Installing npm dependencies...');

        $process = Process::fromShellCommandline('npm install');
        $process->setTimeout(300);
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ npm dependencies installed</fg=green>');
            return true;
        }

        $this->error('   ❌ Failed to install npm dependencies');
        $this->line($process->getErrorOutput());
        return false;
    }

    private function checkTypeScript(): void
    {
        $this->info('4️⃣  Verifying TypeScript installation...');

        $process = Process::fromShellCommandline('npm list typescript');
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ TypeScript already installed</fg=green>');
        } else {
            $this->warn('   ⚠️  TypeScript not found, installing...');
            $installProcess = Process::fromShellCommandline('npm install --save-dev typescript');
            $installProcess->run();
            $this->line('   <fg=green>✅ TypeScript installed</fg=green>');
        }
    }

    private function runTypeCheck(): void
    {
        $this->info('5️⃣  Running TypeScript type check...');

        $process = Process::fromShellCommandline('npm run type-check');
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ No TypeScript errors</fg=green>');
        } else {
            $this->warn('   ⚠️  TypeScript errors found. Please fix them before running tests.');
            $this->comment("   Run 'npm run type-check' to see detailed errors.");
        }
    }

    private function buildFrontend(): bool
    {
        $this->info('6️⃣  Building frontend assets...');

        $process = Process::fromShellCommandline('npm run build');
        $process->setTimeout(300);
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ Frontend built successfully</fg=green>');
            return true;
        }

        $this->error('   ❌ Frontend build failed');
        return false;
    }

    private function checkComposer(): bool
    {
        $this->info('7️⃣  Checking Composer installation...');

        $process = Process::fromShellCommandline('composer --version');
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ Composer installed</fg=green>');
            return true;
        }

        $this->error('   ❌ Composer not found. Please install Composer first.');
        return false;
    }

    private function installComposerDependencies(): bool
    {
        $this->info('8️⃣  Installing Composer dependencies...');

        $process = Process::fromShellCommandline('composer install --no-interaction');
        $process->setTimeout(300);
        $process->run();

        if ($process->isSuccessful()) {
            $this->line('   <fg=green>✅ Composer dependencies installed</fg=green>');
            return true;
        }

        $this->error('   ❌ Failed to install Composer dependencies');
        return false;
    }

    private function checkEnvFile(): void
    {
        $this->info('9️⃣  Checking environment configuration...');

        if (!File::exists(base_path('.env'))) {
            $this->warn('   ⚠️  .env file not found, copying from .env.example...');
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->line('   <fg=green>✅ .env file created</fg=green>');
        } else {
            $this->line('   <fg=green>✅ .env file exists</fg=green>');
        }
    }

    private function checkAppKey(): void
    {
        $this->info('🔟 Checking application key...');

        $envContent = File::get(base_path('.env'));

        if (!str_contains($envContent, 'APP_KEY=base64:')) {
            $this->warn('   ⚠️  Generating application key...');
            $this->call('key:generate');
            $this->line('   <fg=green>✅ Application key generated</fg=green>');
        } else {
            $this->line('   <fg=green>✅ Application key exists</fg=green>');
        }
    }
}
