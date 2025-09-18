<?php

namespace Susheelbhai\StarterKit\common\Commands;

use Exception;
use Illuminate\Console\Command;

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

        $configClass = new ConfigValue();
        $config_response = $configClass->handle();
        $this->line($config_response);
    }

}
