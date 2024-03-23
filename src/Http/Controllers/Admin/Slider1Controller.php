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
    
    public function index()
    {
        $data = Slider1::all();
        return view('admin.resources.slider.index', compact('data'));
    }

    public function create()
    {
        return view('admin.resources.slider1.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading1' => 'required',
            'image1' => 'required',
        ]);
        $slider1 = new Slider1();

        if ($request->image1 != '') {
            $image1_name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->image1->move(public_path('/storage/images/slider'), $image1_name);
            $slider1->image1 = $image1_name;
        }

        if ($request->image2 != '') {
            $image2_name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->image2->move(public_path('/storage/images/slider'), $image2_name);
            File::delete(public_path('/storage/images/slider' . Auth::guard('admin')->user()->image2));
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

    public function edit($id)
    {
        $data = Slider1::find($id);
        return view('admin.resources.slider1.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading1' => 'required',
        ]);
        $slider1 =  Slider1::find($id);

        if ($request->image1 != '') {
            $image1_name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->image1->move(public_path('/storage/images/slider'), $image1_name);
            if ($slider1->image1 != 'dummy.png') {
                File::delete(public_path('/storage/images/slider' . $slider1->image1));
            }
            
            $slider1->image1 = $image1_name;
        }

        if ($request->image2 != '') {
            $image2_name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->image2->move(public_path('/storage/images/slider'), $image2_name);
            if ($slider1->image2 != 'dummy.png') {
                File::delete(public_path('/storage/images/slider' . $slider1->image2));
            }
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
