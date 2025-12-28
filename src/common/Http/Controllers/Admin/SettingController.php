<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Inertia\Inertia;

class SettingController extends Controller
{

    public $settings;

    public function __construct()
    {
        $this->settings = Setting::where('id', '=', 1)->first();
        if ($this->settings == null) {
            Setting::create(['id' => 1]);
            $this->settings = Setting::where('id', '=', 1)->first();
        }
    }
    public function generalSettings()
    {
        $setting = $this->settings;
        return $this->render('admin/resources/settings/general', compact('setting'));
    }


    public function advanceSettings()
    {
        $data = $this->settings;
        return view('admin.resources.settings.advance', compact('data'));
    }


    public function generalSettingsUpdate(Request $req)
    {
        // return $req;
        // $settings = $this->settings;
        $setting = Setting::find(1);

        $setting->app_name = $req->app_name;
        $setting->short_description = $req->short_description;
        $setting->address = $req->address;
        $setting->phone = Helper::cleanPhone($req->phone);
        $setting->email = $req->email;
        $setting->facebook = $req->facebook;
        $setting->instagram = $req->instagram;
        $setting->linkedin = $req->linkedin;
        $setting->twitter = $req->twitter;
        $setting->youtube = $req->youtube;
        $setting->whatsapp = Helper::cleanPhone($req->whatsapp);
        $setting->save();
        $imageManager = new ImageManager(new GdDriver());
        $publicPath = public_path();
        if ($req->hasFile('favicon')) {
            $faviconFile = $req->file('favicon');
            $extension = strtolower($faviconFile->getClientOriginalExtension());
            $tmpPath = $faviconFile->getRealPath();

            $destPng = $publicPath . DIRECTORY_SEPARATOR . 'apple-touch-icon.png';
            $destIco = $publicPath . DIRECTORY_SEPARATOR . 'favicon.ico';
            $destSvg = $publicPath . DIRECTORY_SEPARATOR . 'favicon.svg';

            $image160 = $imageManager->read($tmpPath)->resize(160, 160);
            $image32 = $imageManager->read($tmpPath)->resize(32, 32);
            $image160->toPng()->save($destPng);
            $image32->toPng()->save($destIco);
            if ($extension === 'svg') {
                $faviconFile->move($publicPath, 'favicon.svg');
            } else {
                $base64 = base64_encode(file_get_contents($destPng));
                $svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="160" height="160"><image href="data:image/png;base64,' . $base64 . '" height="160" width="160"/></svg>';
                file_put_contents($destSvg, $svgContent);
            }

            $setting->clearMediaCollection('favicon');
            $setting->addMediaFromRequest('favicon')->toMediaCollection('favicon');
        }
        if ($req->hasFile('dark_logo')) {

            $darkLogoFile = $req->file('dark_logo');
            $extension = strtolower($darkLogoFile->getClientOriginalExtension());
            $tmpPath = $darkLogoFile->getRealPath();

            $dest = $publicPath . DIRECTORY_SEPARATOR . 'logo.svg';

            if ($extension === 'svg') {
                $darkLogoFile->move($publicPath, 'logo.svg');
            } else {
                // Resize to height 120px, keep aspect ratio
                $image = $imageManager->read($tmpPath);
                $origWidth = $image->width();
                $origHeight = $image->height();
                $newHeight = 120;
                $newWidth = intval($origWidth * ($newHeight / $origHeight));
                $resized = $image->resize($newWidth, $newHeight);
                $tmpPng = $publicPath . DIRECTORY_SEPARATOR . 'tmp-dark-logo.png';
                $resized->toPng()->save($tmpPng);
                $base64 = base64_encode(file_get_contents($tmpPng));
                $svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $newWidth . '" height="120"><image href="data:image/png;base64,' . $base64 . '" height="120" width="' . $newWidth . '"/></svg>';
                file_put_contents($dest, $svgContent);
                if (file_exists($tmpPng)) {
                    unlink($tmpPng);
                }
            }
            $setting->clearMediaCollection('dark_logo');
            $setting->addMediaFromRequest('dark_logo')
                ->toMediaCollection('dark_logo');
        }
        if ($req->hasFile('light_logo')) {
            $setting->clearMediaCollection('light_logo');
            $setting->addMediaFromRequest('light_logo')
                ->toMediaCollection('light_logo');
        }
        return redirect()->route('admin.dashboard')->with('success', 'New service created successfully');
    }


    public function advanceSettingsUpdate(Request $req)
    {
        Setting::where('id', '=', 1)->update([
            'short_description' => $req->short_description,
            'address' => $req->address,
            'phone' => $req->phone,
            'email' => $req->email,
            'facebook' => $req->facebook,
            'instagram' => $req->instagram,
            'linkedin' => $req->linkedin,
            'twitter' => $req->twitter,
        ]);
        return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');
    }
}
