<?php

namespace Susheelbhai\StarterKit\Commands;

use Exception;
use Illuminate\Console\Command;

class initial_settings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starter_kit:initial_settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To change some initial configuration which is required on starting new project';

    /**
     * Execute the console command.
     */

    public $env_values = array(
        'MAIL_HOST' => '127.0.0.1',
        'APP_TIMEZONE' => 'Asia/Kolkata',
        'MAIL_PORT' => '1025',
    );
    public $config_values = array(
        'timezone' => 'Asia/Kolkata'
    );

    public function handle()
    {
        $this->question("Set Environment variable");
        $app_url = $this->ask("APP_URL", 'http://localhost/new/public_html');
        $asset_url = $this->ask("ASSET_URL", 'http://localhost/new/public_html/storage');
        try {      
            $this->env_values['APP_URL'] = $app_url;  
            $this->env_values['ASSET_URL'] = $asset_url;  
            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        
        $this->setEnvironmentValue($this->env_values);
        $this->setConfigValue($this->config_values);
    }

    public function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        $this->line("Environment Variable changed");
        return true;
    }

    public function setConfigValue(array $values)
    {
        $path = base_path('config/app.php');
        $str = file_get_contents($path);

        if (count($values) > 0) {
            foreach ($values as $configKey => $configValue) {

                $str .= "\n'"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$configKey}' => ");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$configKey}' => '{$configValue}',\n";
                } else {
                    $str = str_replace($oldLine, "{$configKey}' => '{$configValue}',", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($path, $str)) return false;
        $this->line("Config Variable changed");
        return true;
    }
}
