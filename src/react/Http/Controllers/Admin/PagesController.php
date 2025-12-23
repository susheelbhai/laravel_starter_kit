<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\PageTnc;
use App\Models\Slider1;
use App\Models\PageAuth;
use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageRefund;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use Illuminate\Http\Request;
use App\Traits\HandlesMediaUploads;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    use HandlesMediaUploads;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function authPage()
    {
        $data = PageAuth::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/auth', compact('data'));
    }
    public function updateAuthPage(Request $request)
    {
        $data = PageAuth::find(1);

        $data->update();

        $this->handleSingleFileUpload($data, $request, 'side_image');

        return to_route('admin.dashboard')->with('success', 'Auth Page Updated successfully');
    }
    public function homePage()
    {
        $data = PageHome::where('id', '=', 1)->first();
        $slider1 = Slider1::latest()->get();
        return Inertia::render('admin/resources/edit_pages/home', compact('data', 'slider1'));
    }
    public function updateHomePage(Request $request)
    {
        $data = PageHome::find(1);
        $data->banner_heading = $request->banner_heading;
        $data->banner_description = $request->banner_description;
        $data->about_heading = $request->about_heading;
        $data->about_description = $request->about_description;
        $data->why_us_heading = $request->why_us_heading;
        $data->why_us_description = $request->why_us_description;
        $data->update();

        $this->handleSingleFileUpload($data, $request, 'banner_image');
        $this->handleSingleFileUpload($data, $request, 'about_image');
        $this->handleSingleFileUpload($data, $request, 'why_us_image');

        return to_route('admin.dashboard')->with('success', 'Updated successfully');
    }
    
    public function aboutPage()
    {
        $data = PageAbout::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/about', compact('data'));
    }
    public function updateAboutPage(Request $request)
    {
        $data = PageAbout::find(1);

        $data->para1 = $request->para1;
        $data->para2 = $request->para2;
        $data->objective = $request->objective;
        $data->mission = $request->mission;
        $data->vision = $request->vision;
        $data->founder_message = $request->founder_message;
        $data->update();

        $this->handleSingleFileUpload($data, $request, 'founder_image');
        $this->handleSingleFileUpload($data, $request, 'banner');

        return to_route('admin.dashboard')->with('success', 'Updated successfully');
    }
    public function contactPage()
    {
        $data = PageContact::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/contact', compact('data'));
    }
    public function updateContactPage(Request $request)
    {
        $data = PageContact::find(1);
        if ($request->hasFile('banner')) {
            $banner_name = 'images/banner/' . uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
            $request->banner->move(public_path('/storage/images/banner'), $banner_name);
            $data->banner = $banner_name;
        }
        $data->form_heading1 = $request->form_heading1;
        $data->form_paragraph1 = $request->form_paragraph1;
        $data->map_embad_url = $request->map_embad_url;
        $data->working_hour = $request->working_hour;
        $data->update();
        return back()->with('success', 'Updated successfully');
    }
    public function tncPage()
    {
        $data = PageTnc::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/tnc', compact('data'));
    }
    public function updateTncPage(Request $request)
    {
        $data = PageTnc::find(1);
        $data->title = $request->title;
        $data->content = $request->content;
        $data->update();
        return back()->with('success', 'Updated successfully');
    }
    public function privacyPage()
    {
        $data = PagePrivacy::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/privacy', compact('data'));
    }
    public function updatePrivacyPage(Request $request)
    {
        $data = PagePrivacy::find(1);
        $data->title = $request->title;
        $data->content = $request->content;
        $data->update();
        return back()->with('success', 'Updated successfully');
    }
    public function refundPage()
    {
        $data = PageRefund::where('id', '=', 1)->first();
        return Inertia::render('admin/resources/edit_pages/refund', compact('data'));
    }
    public function updateRefundPage(Request $request)
    {
        $data = PageRefund::find(1);
        $data->title = $request->title;
        $data->content = $request->content;
        $data->update();
        return back()->with('success', 'Updated successfully');
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
