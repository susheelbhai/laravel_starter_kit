<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

use Illuminate\Support\Facades\Artisan;

class Publish
{
    public function blade($this_data, $starter_kit_installed)
    {
        $this_data->info("Publishing Blade Starter Kit...");

        $exitCode1 = Artisan::call('vendor:publish', [
            '--tag'   => 'blade_starter_kit',
            '--force' => true,
        ]);
        $this_data->line(Artisan::output());

        $exitCode2 = Artisan::call('vendor:publish', [
            '--tag'   => 'starter_kit_themes',
            '--force' => true,
        ]);
        $this_data->line(Artisan::output());

        if ($exitCode1 === 0 && $exitCode2 === 0) {
            $this_data->info("✅ Blade Starter Kit and Themes published successfully!");
        } else {
            $this_data->error("❌ Failed to publish Blade Starter Kit or Themes");
        }
    }

    public function react($this_data, $starter_kit_installed)
    {
        $this_data->info("Publishing React Starter Kit...");

        $exitCode1 = Artisan::call('vendor:publish', [
            '--tag'   => 'react_starter_kit',
            '--force' => true,
        ]);
        $exitCode2 = Artisan::call('vendor:publish', [
            '--tag'   => 'react_starter_kit_for_non_react_project',
            '--force' => true,
        ]);

        // show what artisan actually did
        $this_data->line(Artisan::output());

        if ($exitCode1 === 0 && $exitCode2 === 0) {
            $this_data->info("✅ React Starter Kit published successfully!");
        } else {
            $this_data->error("❌ Failed to publish React Starter Kit");
        }
    }
}
