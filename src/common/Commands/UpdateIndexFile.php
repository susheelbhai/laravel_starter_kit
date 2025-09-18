<?php

namespace Susheelbhai\StarterKit\common\Commands;

use Illuminate\Support\Facades\File;

class UpdateIndexFile
{
    public function handle($this_data)
    {
        $path = base_path('public/index.php');
        $str = file_get_contents($path);
        $str = str_replace("__DIR__.'/../storage", "__DIR__.'/../project/storage", $str);
        $str = str_replace("__DIR__.'/../vendor", "__DIR__.'/../project/vendor", $str);
        $str = str_replace("__DIR__.'/../bootstrap", "__DIR__.'/../project/bootstrap", $str);
        if (!file_put_contents($path, $str)) return false;
        $this_data->line("index file updated");
        if (!File::copyDirectory(base_path('public'), base_path('../public_html'))) return false;
        $this_data->line("public folder renamed and moved");
        return true;
    }
}
