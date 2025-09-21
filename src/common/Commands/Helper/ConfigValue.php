<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

class ConfigValue
{
    public $config_values_app = array(
        'timezone' => "env('APP_TIMEZONE', 'Asia/Kolkata')",
        'watermark' => "env('WATERMARK', 1)"
    );
    public $config_values_mail = array(
        'admin_mail' => "env('ADMIN_MAIL', 'admin@example.com')",
        'admin_name' => "env('ADMIN_NAME', 'Admin')"
    );

    public function handle($this_data)
    {
        $this->setConfigValue('config/app.php', $this->config_values_app);
        $this->setConfigValue('config/mail.php', $this->config_values_mail);
        $this_data->line("Config Variable changed");
    }

    private function setConfigValue(string $file_name, array $values)
    {
        $path = base_path($file_name);
        $str = file_get_contents($path);

        if (count($values) > 0) {
            // Remove closing array bracket
            $str = preg_replace('/\]\s*;$/', '', $str);

            foreach ($values as $configKey => $configValue) {
                // Match existing line
                $pattern = "/(['\"]{$configKey}['\"]\s*=>\s*).*,/";
                if (preg_match($pattern, $str)) {
                    // Replace old value
                    $str = preg_replace($pattern, "'{$configKey}' => {$configValue},", $str);
                } else {
                    // Append new value before closing bracket
                    $str .= "\n    '{$configKey}' => {$configValue},";
                }
            }

            // Add closing bracket back
            $str .= "\n];";
        }

        if (!file_put_contents($path, $str)) {
            return false;
        }

        return true;
    }
}
