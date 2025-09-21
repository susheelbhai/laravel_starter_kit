<?php

namespace Susheelbhai\StarterKit\common\Commands;

use Exception;
use Illuminate\Console\Command;
use Susheelbhai\StarterKit\common\Commands\Helper\EnvValue;
use Susheelbhai\StarterKit\common\Commands\Helper\ConfigValue;
use Susheelbhai\StarterKit\common\Commands\Helper\InstallPackages;
use Susheelbhai\StarterKit\common\Commands\Helper\Publish;

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
        );

        $this->question("Set Environment variable");
        $project_name = $this->ask("Project Name", 'new');
        $has_ssl = $this->ask("do you have ssl available? (yes/no)", 'yes');
        $db_type = $this->choice(
            'DB_CONNECTION',
            ['sqlite', 'mysql', 'mariadb', 'pgsql', 'sqlsrv'],
            1,
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

        $env_obj = new EnvValue();
        $env_obj->setEnvironmentValueDatabase($this, $this->env_values, $db_type, $project_name);

        $package_obj = new InstallPackages();
        $publish_obj = new Publish();

        switch ($starter_kit_type) {
            case 'blade':
                $publish_obj->blade($this);
                $package_obj->blade($this);
                break;

            case 'react':
                $publish_obj->react($this);
                $package_obj->react($this);
                break;
        }

        $configClass = new ConfigValue();
        $configClass->handle($this);
    }
}
