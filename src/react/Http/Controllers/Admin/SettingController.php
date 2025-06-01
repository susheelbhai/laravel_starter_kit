<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        return Inertia::render('admin/resources/settings/general', compact('setting'));
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

        if ($req->hasFile('favicon')) {
            $favicon_name = 'images/logo/' . uniqid() . '.' . $req->file('favicon')->getClientOriginalExtension();
            $req->favicon->move(public_path('/storage/images/logo'), $favicon_name);
            $setting->favicon = $favicon_name;
        }
        if ($req->hasFile('dark_logo')) {
            $dark_logo_name = 'images/logo/' . uniqid() . '.' . $req->file('dark_logo')->getClientOriginalExtension();
            $req->dark_logo->move(public_path('/storage/images/logo'), $dark_logo_name);
            $setting->dark_logo = $dark_logo_name;
        }
        if ($req->hasFile('light_logo')) {
            $light_logo_name = 'images/logo/' . uniqid() . '.' . $req->file('light_logo')->getClientOriginalExtension();
            $req->light_logo->move(public_path('/storage/images/logo'), $light_logo_name);
            $setting->light_logo = $light_logo_name;
        }


        $setting->app_name = $req->app_name;
        $setting->color1 = $req->color1;
        $setting->color2 = $req->color2;
        $setting->color3 = $req->color3;
        $setting->color4 = $req->color4;
        $setting->color5 = $req->color5;
        $setting->color6 = $req->color6;
        $setting->short_description = $req->short_description;
        $setting->address = $req->address;
        $setting->phone = $req->phone;
        $setting->email = $req->email;
        $setting->facebook = $req->facebook;
        $setting->instagram = $req->instagram;
        $setting->linkedin = $req->linkedin;
        $setting->twitter = $req->twitter;
        $setting->youtube = $req->youtube;
        $setting->whatsapp = $req->whatsapp;
        $setting->save();
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
