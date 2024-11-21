<?php

namespace Susheelbhai\StarterKit\Commands;

use PDO;
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
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => '127.0.0.1',
        'APP_TIMEZONE' => 'Asia/Kolkata',
        'MAIL_PORT' => '1025',
        'WATERMARK' => 1
    );
    public $config_values = array(
        'watermark' => "env('WATERMARK', 1)",
    );

    public function handle()
    {
        $delete_unused_file = $this->ask("Do you want to delete unused files? (yes/no)", 'yes');
        $this->question("Set Environment variable");
        $folder_name = $this->ask("Folder Name", 'new');
        $db_type = $this->choice(
            'DB_CONNECTION',
            ['sqlite', 'mysql', 'mariadb', 'pgsql', 'sqlsrv'],
            1,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );
        $app_url = $this->ask("APP_URL", 'http://localhost/'.$folder_name.'/public_html');
        $asset_url = $this->ask("ASSET_URL", 'http://localhost/'.$folder_name.'/public_html/storage');
        $custom_path_after_root_url = $this->ask("custom path after root url", $folder_name.'/public_html');
        try {      
            $this->env_values['APP_URL'] = $app_url;  
            $this->env_values['ASSET_URL'] = $asset_url;  
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        $this->setEnvironmentValueDatabase($db_type, $folder_name);
        $this->updateAppServiceProvider($custom_path_after_root_url);
        $this->setEnvironmentValue($this->env_values);
        $this->setConfigValue($this->config_values);
        $this->updateIndexFile();
        if ($delete_unused_file == 'yes') {
            $this->deleteUnusedFolder();
        }
    }


    private function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("APP_URL=http://localhost", "APP_URL=http://localhost"."\n"."ASSET_URL=http://localhost", $str);

        if (count($values) > 0) {
            $str .= "\n"; // In case the searched variable is in the last line without \n
            foreach ($values as $envKey => $envValue) {
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

    private function setEnvironmentValueDatabase($db_type, $folder_name) {
        if ($db_type == 'sqlite') {
            return $this->setEnvironmentValueSqlite();
        }
        if ($db_type == 'mysql') {
            return $this->setEnvironmentValueMySql($folder_name);
        }
    }

    private function setEnvironmentValueSqlite() {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("DB_HOST", "# DB_HOST", $str);
        $str = str_replace("DB_PORT", "# DB_PORT", $str);
        $str = str_replace("DB_DATABASE", "# DB_DATABASE", $str);
        $str = str_replace("DB_USERNAME", "# DB_USERNAME", $str);
        $str = str_replace("DB_PASSWORD", "# DB_PASSWORD", $str);

        if (!file_put_contents($envFile, $str)) return false;
        $this->env_values['DB_CONNECTION'] = 'sqlite';  
    }

    private function setEnvironmentValueMySql($folder_name) {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("# DB_HOST", "DB_HOST", $str);
        $str = str_replace("# DB_PORT", "DB_PORT", $str);
        $str = str_replace("# DB_DATABASE", "DB_DATABASE", $str);
        $str = str_replace("# DB_USERNAME", "DB_USERNAME", $str);
        $str = str_replace("# DB_PASSWORD", "DB_PASSWORD", $str);

        if (!file_put_contents($envFile, $str)) return false;
        
        $db_host = $this->ask("DB_HOST", '127.0.0.1');
        $db_port = $this->ask("DB_PORT", '3306');
        $db_user_name = $this->ask("DB_USERNAME", 'root');
        $db_password = $this->ask("DB_PASSWORD", '');
        $this->env_values['DB_CONNECTION'] = 'mysql';  
        $this->env_values['DB_DATABASE'] = $folder_name;  
        $this->env_values['DB_HOST'] = $db_host;  
        $this->env_values['DB_PORT'] = $db_port;  
        $this->env_values['DB_USERNAME'] = $db_user_name;  
        $this->env_values['DB_PASSWORD'] = $db_password;  
        $pdo = new PDO('mysql:host=' . $db_host, $db_user_name, $db_password);
        try {
            $pdo->exec('CREATE DATABASE ' . $folder_name);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    private function setConfigValue(array $values)
    {
        $path = base_path('config/app.php');
        $str = file_get_contents($path);

        if (count($values) > 0) {
            $str .= "\n'"; // In case the searched variable is in the last line without \n
            $str = str_replace("];", "", $str);
            foreach ($values as $configKey => $configValue) {
                $keyPosition = strpos($str, "{$configKey}' => ");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$configKey}' => {$configValue},\n";
                } else {
                    $str = str_replace($oldLine, "{$configKey}' => {$configValue},", $str);
                }
            }
            $str .= "];;";
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
        $this->line("public folder renamed and moved");
        return true;
    }

    private function deleteUnusedFolder() {
        try {
            File::deleteDirectory(base_path('public'));
        } catch (\Throwable $th) {
            // return $th;
        }
        $this->line("Unused files and folders removed");
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
