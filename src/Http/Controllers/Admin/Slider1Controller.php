<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Slider1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Slider1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider1::all();
        return view('admin.resources.slider.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.slider1.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'heading1' => 'required',
            'image1' => 'required',
        ]);
        $slider1 = new Slider1();

        if ($request->image1 != '') {
            $image1_name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->image1->move(public_path('/storage/images/webpages/banners'), $image1_name);
            File::delete(public_path('/storage/images/webpages/banners' . Auth::guard('admin')->user()->image1));
            $slider1->image1 = $image1_name;
        }

        if ($request->image2 != '') {
            $image2_name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->image2->move(public_path('/storage/images/webpages/banners'), $image2_name);
            File::delete(public_path('/storage/images/webpages/banners' . Auth::guard('admin')->user()->image2));
            $slider1->image2 = $image2_name;
        }

        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        if (isset($request->is_active)) {
            $slider1->is_active = 1;
        } else {
            $slider1->is_active = 0;
        }
        $slider1->save();
        return redirect()->route('admin.pages.homePage');
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
        $data = Slider1::find($id);
        return view('admin.resources.slider1.edit', compact('data'));
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
        // return $request;
        $request->validate([
            'heading1' => 'required',
        ]);
        $slider1 =  Slider1::find($id);

        if ($request->image1 != '') {
            $image1_name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->image1->move(public_path('/storage/images/webpages/banners'), $image1_name);
            File::delete(public_path('/storage/images/webpages/banners' . Auth::guard('admin')->user()->image1));
            $slider1->image1 = $image1_name;
        }

        if ($request->image2 != '') {
            $image2_name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->image2->move(public_path('/storage/images/webpages/banners'), $image2_name);
            File::delete(public_path('/storage/images/webpages/banners' . Auth::guard('admin')->user()->image2));
            $slider1->image2 = $image2_name;
        }

        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        if (isset($request->is_active)) {
            $slider1->is_active = 1;
        } else {
            $slider1->is_active = 0;
        }
        $slider1->update();
        return redirect()->route('admin.pages.homePage');
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
