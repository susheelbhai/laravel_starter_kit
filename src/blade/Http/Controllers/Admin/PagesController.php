<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PageTnc;
use App\Models\PagePrivacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider1;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function homePage()
     {
        $data = PageHome::where('id', '=', 1)->first();
        $slider1 = Slider1::all();
        return view('admin.resources.edit_pages.home', compact('data', 'slider1'));
     }
     public function aboutPage()
     {
        $data = PageAbout::where('id', '=', 1)->first();
        return view('admin.resources.edit_pages.about', compact('data'));
     }
     public function updateAboutPage(Request $req)
     {
         $existing_data = PageAbout::find(1)->first();
         $data = PageAbout::find(1);
         if ($req->banner != '') {
             $banner_name = uniqid() . '.' . $req->file('banner')->getClientOriginalExtension();
             $req->banner->move(public_path('/storage/images/webpages/banners'), $banner_name);
             if ($existing_data->banner != 'dummy.png') {
                 File::delete(public_path('storage/images/webpages/banners/' . $existing_data->banner));
             }
             $data->banner = $banner_name;
         }
         $data->update();
         return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');
 
     }
     public function contactPage()
     {
        $data = PageContact::where('id', '=', 1)->first();
        return view('admin.resources.edit_pages.contact', compact('data'));
     }
    public function updateContactPage(Request $req)
    {
        $existing_data = PageContact::find(1)->first();
        $data = PageContact::find(1);
        if ($req->banner != '') {
            $banner_name = uniqid() . '.' . $req->file('banner')->getClientOriginalExtension();
            $req->banner->move(public_path('/storage/images/webpages/banners'), $banner_name);
            if ($existing_data->banner != 'dummy.png') {
                File::delete(public_path('storage/images/webpages/banners/' . $existing_data->banner));
            }
            $data->banner = $banner_name;
        }
        $data->form_heading1 = $req->form_heading1;
        $data->form_paragraph1 = $req->form_paragraph1;
        $data->map_embad_url = $req->map_embad_url;
        $data->working_hour = $req->working_hour;
        $data->update();
        return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');

    }
     public function tncPage()
     {
        $data = PageTnc::where('id', '=', 1)->first();
        return view('admin.resources.edit_pages.tnc', compact('data'));
     }
    public function updateTncPage(Request $req)
    {
        // return $req;
        $data = PageTnc::find(1);
        $data->content = $req->content;
        $data->update();
        return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');

    }
     public function privacyPage()
     {
        $data = PagePrivacy::where('id', '=', 1)->first();
        return view('admin.resources.edit_pages.privacy', compact('data'));
     }
    public function updatePrivacyPage(Request $req)
    {
        // return $req;
        $data = PagePrivacy::find(1);
        $data->content = $req->content;
        $data->update();
        return back()->with('msg', 'Updated successfully')->with('msg_class', 'success');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
