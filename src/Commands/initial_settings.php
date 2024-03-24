<?php

namespace Susheelbhai\StarterKit\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
        $folder_name = $this->ask("Folder Name", 'new');
        $app_url = $this->ask("APP_URL", 'http://localhost/'.$folder_name.'/public_html');
        $asset_url = $this->ask("ASSET_URL", 'http://localhost/'.$folder_name.'/public_html/storage');
        $custom_path_after_root_url = $this->ask("custom path after root url", $folder_name.'/public_html');
        try {      
            $this->env_values['APP_URL'] = $app_url;  
            $this->env_values['ASSET_URL'] = $asset_url;  
            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        
        $this->updateAppServiceProvider($custom_path_after_root_url);
        $this->setEnvironmentValue($this->env_values);
        $this->setConfigValue($this->config_values);
        $this->updateIndexFile();
    }

    private function setEnvironmentValue(array $values)
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

    private function setConfigValue(array $values)
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

    private function updateIndexFile() {
        $path = base_path('public/index.php');
        $str = file_get_contents($path);
        $str = str_replace("__DIR__.'/../storage", "__DIR__.'/../project/storage", $str);
        $str = str_replace("__DIR__.'/../vendor", "__DIR__.'/../project/vendor", $str);
        $str = str_replace("__DIR__.'/../bootstrap", "__DIR__.'/../project/bootstrap", $str);
        if (!file_put_contents($path, $str)) return false;
        $this->line("index file updated");
        if (!File::copyDirectory(base_path('public'), base_path('../public_html'))) return false;
        if (!File::deleteDirectories(base_path('public'))) return false;
        $this->line("public folder renamed and moved");
        return true;
    }

    private function updateAppServiceProvider($custom_path_after_root_url) {
        $path = base_path('app/Providers/AppServiceProvider.php');
        $str = file_get_contents($path);
        $str = str_replace("{custom_path_after_root_url}", $custom_path_after_root_url, $str);
        if (!file_put_contents($path, $str)) return false;
        $this->line("AppServiceProvider file updated");
        return true;
    }
}
