<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallPackages
{

    public function react($this_data, $starter_kit_installed)
    {

        $this_data->info("Installing NPM packages...");
        $npmPackages = [
            'react-day-picker',
            'date-fns',
            'lucide-react',
            'react-icons',
            'sweetalert2',
            'react-select',
        ];
        $npmPackages2 = [
            '@vitejs/plugin-react',
            '@inertiajs/react',
            '@radix-ui/react-dropdown-menu',
            '@radix-ui/react-popover',
            'class-variance-authority',
            'tw-animate-css',
            'tailwind-merge',
        ];
        
        $this->installNpmPackages($this_data, $npmPackages);
        // if no starter kit selected at the time of installation of laravel
        if ($starter_kit_installed != 'yes') {
            $this->installNpmPackages($this_data, $npmPackages2);
        }
    }

    public function blade($this_data, $starter_kit_installed)
    {
        $this_data->info("Installing composer packages...");
        $composerPackages = [
            'tightenco/ziggy',
        ];
        $this->installComposerPackages($this_data, $composerPackages);

        $this_data->info("Installing NPM packages...");
        $npmPackages = [
            'react-icons',
        ];
        $this->installNpmPackages($this_data, $npmPackages);
    }
    /**
     * Install multiple NPM packages by name.
     * @param $this_data
     * @param array $packageNames
     */
    private function installNpmPackages($this_data, array $packageNames)
    {
        foreach ($packageNames as $pkg) {
            $this->installPackage($this_data, ['npm', 'install', $pkg], "NPM package: $pkg");
        }
    }

    /**
     * Install multiple Composer packages by name.
     * @param $this_data
     * @param array $packageNames
     */
    private function installComposerPackages($this_data, array $packageNames)
    {
        foreach ($packageNames as $pkg) {
            $this->installPackage($this_data, ['composer', 'require', $pkg], "Composer package: $pkg");
        }
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
