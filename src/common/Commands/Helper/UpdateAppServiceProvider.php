<?php

namespace Susheelbhai\StarterKit\common\Commands\Helper;

use Illuminate\Support\Facades\File;

class UpdateAppServiceProvider
{
    public function handle($this_data, $custom_path_after_root_url)
    {
        $path = base_path('app/Providers/AppServiceProvider.php');
        $str = file_get_contents($path);
        $str = str_replace("{custom_path_after_root_url}", $custom_path_after_root_url, $str);
        if (!file_put_contents($path, $str)) return false;
        $this_data->line("AppServiceProvider file updated");
        return true;
    }

    public function uncomment($this_data)
    {
        $path = base_path('app/Providers/AppServiceProvider.php');
        $str = file_get_contents($path);
        $str = str_replace("/*", '', $str);
        $str = str_replace("*/", '', $str);
        if (!file_put_contents($path, $str)) return false;
        $this_data->line("AppServiceProvider settings uncommented");
        return true;
    }

}
