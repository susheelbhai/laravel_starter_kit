<?php

namespace Susheelbhai\StarterKit\common\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class initial_settings extends Command
{
    protected $signature = 'starter_kit:initial_settings';

    protected $description = 'To change some initial configuration which is required on starting new project';

    public $env_values = array(
        'FILESYSTEM_DISK' => 'public',
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => '127.0.0.1',
        'APP_TIMEZONE' => 'Asia/Kolkata',
        'MAIL_PORT' => '1025',
        'WATERMARK' => 1,
        'ADMIN_MAIL' => 'admin@example.com',
        'ADMIN_NAME' => 'Admin'
    );


    public function handle()
    {
        $starter_kit_type = $this->choice(
            'Select starter kit type',
            ['blade', 'react'],
            1,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );
        

        $this->question("Set Environment variable");
        $project_name = $this->ask("Project Name", 'new');
        $has_ssl = $this->ask("do you have ssl available? (yes/no)", 'yes');
        $db_type = $this->choice(
            'DB_CONNECTION',
            ['sqlite', 'mysql', 'mariadb', 'pgsql', 'sqlsrv'],
            1,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );



        if ($has_ssl == 'yes') {
            $app_url = $this->ask("APP_URL", 'https://' . $project_name . '.test');
        } else {
            $app_url = $this->ask("APP_URL", 'http://' . $project_name . '.test');
        }

        try {
            $this->env_values['APP_URL'] = $app_url;
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        $obj = new EnvValue();

        $obj->setEnvironmentValueDatabase($this, $this->env_values, $db_type, $project_name);

        
        switch ($starter_kit_type) {
            case 'blade':
                $this->info("Publishing Blade Starter Kit...");

                $exitCode1 = Artisan::call('vendor:publish', [
                    '--tag'   => 'blade_starter_kit',
                    '--force' => true,
                ]);
                $this->line(Artisan::output());

                $exitCode2 = Artisan::call('vendor:publish', [
                    '--tag'   => 'starter_kit_themes',
                    '--force' => true,
                ]);
                $this->line(Artisan::output());

                if ($exitCode1 === 0 && $exitCode2 === 0) {
                    $this->info("✅ Blade Starter Kit and Themes published successfully!");
                } else {
                    $this->error("❌ Failed to publish Blade Starter Kit or Themes");
                }
                break;


            case 'react':
                $this->info("Publishing React Starter Kit...");

                $exitCode = Artisan::call('vendor:publish', [
                    '--tag'   => 'react_starter_kit',
                    '--force' => true,
                ]);

                // show what artisan actually did
                $this->line(Artisan::output());

                if ($exitCode === 0) {
                    $this->info("✅ React Starter Kit published successfully!");
                } else {
                    $this->error("❌ Failed to publish React Starter Kit");
                }
                break;
        }
        

        $configClass = new ConfigValue();
        $config_response = $configClass->handle();
        $this->line($config_response);
    }
}
