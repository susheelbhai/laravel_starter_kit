<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

use PDO;

class EnvValue
{

    public function setEnvironmentValueDatabase($this_data, $env_values, $db_type, $project_name)
    {
        // dd($db_type);
        if ($db_type == 'sqlite') {
            return $this->setEnvironmentValueSqlite($this_data, $env_values);
        }
        if ($db_type == 'mysql') {
            return $this->setEnvironmentValueMySql($this_data, $project_name, $env_values);
        }
    }

    private function setEnvironmentValueSqlite($this_data, $env_values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("DB_HOST", "# DB_HOST", $str);
        $str = str_replace("DB_PORT", "# DB_PORT", $str);
        $str = str_replace("DB_DATABASE", "# DB_DATABASE", $str);
        $str = str_replace("DB_USERNAME", "# DB_USERNAME", $str);
        $str = str_replace("DB_PASSWORD", "# DB_PASSWORD", $str);

        if (!file_put_contents($envFile, $str)) return false;
        $env_values['DB_CONNECTION'] = 'sqlite';
        $this->setEnvironmentValue($this_data, $env_values);
    }

    private function setEnvironmentValueMySql($this_data, $project_name, $env_values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("# DB_HOST", "DB_HOST", $str);
        $str = str_replace("# DB_PORT", "DB_PORT", $str);
        $str = str_replace("# DB_DATABASE", "DB_DATABASE", $str);
        $str = str_replace("# DB_USERNAME", "DB_USERNAME", $str);
        $str = str_replace("# DB_PASSWORD", "DB_PASSWORD", $str);

        if (!file_put_contents($envFile, $str)) return false;

        $db_host = $this_data->ask("DB_HOST", '127.0.0.1');
        $db_port = $this_data->ask("DB_PORT", '3306');
        $db_user_name = $this_data->ask("DB_USERNAME", 'root');
        $db_password = $this_data->ask("DB_PASSWORD", 'password');
        // dd($db_password);
        $env_values['DB_CONNECTION'] = 'mysql';
        $env_values['DB_DATABASE'] = $project_name;
        $env_values['DB_HOST'] = $db_host;
        $env_values['DB_PORT'] = $db_port;
        $env_values['DB_USERNAME'] = $db_user_name;
        $env_values['DB_PASSWORD'] = $db_password;
        $pdo = new PDO('mysql:host=' . $db_host, $db_user_name, $db_password);
        $this->setEnvironmentValue($this_data, $env_values);
        try {
            $pdo->exec('CREATE DATABASE ' . $project_name);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function setEnvironmentValue($this_data, array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = str_replace("APP_URL=http://localhost", "APP_URL=http://localhost" . "\n" . "ASSET_URL=http://localhost", $str);

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
        $this_data->line("Environment Variable changed");
        return true;
    }
}
