<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Slider;
use App\Models\Slider1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Slider1Controller extends Controller
{

    public function index()
    {
        $data = Slider1::latest()->get();
        return Inertia::render('admin/resources/slider/index', compact('data'));
    }

    public function create()
    {
        return Inertia::render('admin/resources/slider/create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'heading1' => 'required',
            'image1' => 'required',
        ]);

        if ($validator->fails()) {
            return Inertia::render('admin/resources/slider1/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }
        $slider1 = new Slider1();
        if ($request->hasFile('image1')) {
            $image_name = 'images/slider/' . uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->file('image1')->move(public_path('/storage/images/slider'), $image_name);
        }
        if ($request->hasFile('image2')) {
            $image_name = 'images/slider/' . uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move(public_path('/storage/images/slider'), $image_name);
        }

        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        $slider1->is_active = $request->is_active;
        $slider1->save();
        return redirect()->route('admin.pages.homePage');
    }

    public function edit($id)
    {
        $data = Slider1::find($id);
        return Inertia::render('admin/resources/slider/show', compact('data'));
    }

    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->all(), [
            'heading1' => 'required',
        ]);

        if ($validator->fails()) {
            return Inertia::render('admin/resources/slider1/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }
        $slider1 =  Slider1::find($id);
        if ($request->hasFile('image1')) {
            $image_name = 'images/slider/' . uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $request->file('image1')->move(public_path('/storage/images/slider'), $image_name);
        }
        if ($request->hasFile('image2')) {
            $image_name = 'images/slider/' . uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move(public_path('/storage/images/slider'), $image_name);
        }

        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        $slider1->is_active = $request->is_active;
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
