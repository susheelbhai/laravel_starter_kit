<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{

    public $settings;

    public function __construct()
    {
        $this->settings = Setting::where('id', '=', 1)->first();
        if ($this->settings == null) {
            Setting::create(['id'=>1]);
            $this->settings = Setting::where('id', '=', 1)->first();
        }
    }
    public function generalSettings()
    {
        $data = $this->settings;
        return view('admin.resources.settings.general', compact('data'));
    }


    public function advanceSettings()
    {
        $data = $this->settings;
        return view('admin.resources.settings.advance', compact('data'));
    }


    public function generalSettingsUpdate(Request $req)
    {
        // return $req;
        $settings = $this->settings;

        if ($req->favicon == '') {
            $favicon_name = $settings->favicon;
        } else {
            $favicon_name = uniqid() . '.' . $req->file('favicon')->getClientOriginalExtension();
            $req->favicon->move(public_path('storage/images/logo'), $favicon_name);
            if ($settings->favicon != 'dummy.png') {
                File::delete(public_path('storage/images/logo/' . $settings->favicon));
            }
        }

        if ($req->dark_logo == '') {
            $dark_logo_name = $settings->dark_logo;
        } else {
            $dark_logo_name = uniqid() . '.' . $req->file('dark_logo')->getClientOriginalExtension();
            $req->dark_logo->move(public_path('storage/images/logo'), $dark_logo_name);
            if ($settings->dark_logo != 'dummy.png') {
                File::delete(public_path('storage/images/logo/' . $settings->dark_logo));
            }
        }
        if ($req->light_logo == '') {
            $light_logo_name = $settings->light_logo;
        } else {
            $light_logo_name = uniqid() . '.' . $req->file('light_logo')->getClientOriginalExtension();
            $req->light_logo->move(public_path('storage/images/logo'), $light_logo_name);
            if ($settings->light_logo != 'dummy.png') {
                File::delete(public_path('storage/images/logo/' . $settings->light_logo));
            }
        }

        Setting::where('id', '=', 1)->update([
            'app_name' => $req->app_name,
            'favicon' => $favicon_name,
            'dark_logo' => $dark_logo_name,
            'light_logo' => $light_logo_name,
            'color1' => $req->color1,
            'color2' => $req->color2,
            'color3' => $req->color3,
            'color4' => $req->color4,
            'color5' => $req->color5,
            'color6' => $req->color6,
        ]);
        return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');
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
