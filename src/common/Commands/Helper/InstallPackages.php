<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallPackages
{
    public function react($this_data)
    {        

        $this_data->info("Installing NPM packages...");
        $this->installPackage($this_data, ['npm', 'install', 'react-day-picker'], "NPM package: react-day-picker");
        $this->installPackage($this_data, ['npm', 'install', 'date-fns'], "NPM package: date-fns");
        $this->installPackage($this_data, ['npm', 'install', '@radix-ui/react-popover'], "NPM package: @radix-ui/react-popover");
        $this->installPackage($this_data, ['npm', 'install', 'react-icons'], "NPM package: react-icons");
        $this->installPackage($this_data, ['npm', 'install', 'sweetalert2'], "NPM package: sweetalert2");
        $this->installPackage($this_data, ['npm', 'install', 'react-select'], "NPM package: react-select");
        $this->installPackage($this_data, ['composer', 'require', 'spatie/laravel-permission'], "Composer package: spatie/laravel-permission");
        $this->installPackage($this_data, ['composer', 'require', 'spatie/laravel-permission'], "Composer package: spatie/laravel-permission");
        $this->installPackage($this_data, ['composer', 'require', 'spatie/laravel-medialibrary'], "Composer package: spatie/laravel-medialibrary");
        $this->installPackage($this_data, ['composer', 'require', 'intervention/image'], "Composer package: intervention/image");
        $this->installPackage($this_data, ['composer', 'require', 'tightenco/ziggy'], "Composer package: tightenco/ziggy");
    }

    public function blade($this_data)
    {
        $this_data->info("Installing PHP packages...");
        $this->installPackage($this_data, ['composer', 'require', 'tightenco/ziggy'], "Composer package: tightenco/ziggy");

        $this_data->info("Installing NPM packages...");
        $this->installPackage($this_data, ['npm', 'install', 'react-icons'], "NPM package: react-icons");
    }

    private function installPackage($this_data, array $command, string $label)
    {
        $this_data->line("📦 Installing {$label} ...");
        $this->runCommand($this_data, $command, $label);
        $this_data->info("✅ Finished installing {$label}");
    }

    private function runCommand($this_data, array $command, string $label, string $workingDir = null)
    {
        $process = new Process($command, $workingDir ?? base_path());
        $process->setTimeout(null);

        $process->run(function ($type, $buffer) use ($this_data, $label, $command) {
            $cmd = implode(' ', $command);
            $this_data->line("[{$label}] {$buffer}");
        });

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
