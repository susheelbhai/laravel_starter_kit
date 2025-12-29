<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Slider1Controller extends Controller
{
    public function index()
    {
        $data = Slider1::latest()->get();
        return $this->render('admin/resources/slider/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/slider/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading1' => 'required',
            'image1' => 'required',
        ]);

        $slider1 = new Slider1();
        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        $slider1->is_active = $request->is_active;
        $slider1->save();

        if ($request->hasFile('image1')) {
            $slider1->addMediaFromRequest('image1')
                ->toMediaCollection('image1');
        }
        if ($request->hasFile('image2')) {
            $slider1->addMediaFromRequest('image2')
                ->toMediaCollection('image2');
        }
        return redirect()->route('admin.slider1.index')->with('success', 'New slider created successfully');
    }

    public function edit($id)
    {
        $data = Slider1::find($id);
        return $this->render('admin/resources/slider/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading1' => 'required',
        ]);
        $slider1 =  Slider1::find($id);

        $slider1->heading1 = $request->heading1;
        $slider1->heading2 = $request->heading2;
        $slider1->paragraph1 = $request->paragraph1;
        $slider1->paragraph2 = $request->paragraph2;
        $slider1->btn_name = $request->btn_name;
        $slider1->btn_url = $request->btn_url;
        $slider1->btn_target = $request->btn_target;
        $slider1->is_active = 1;
        $slider1->update();

        if ($request->hasFile('image1')) {
            $slider1->clearMediaCollection('image1');
            $slider1->addMediaFromRequest('image1')
                ->toMediaCollection('image1');
        }
        if ($request->hasFile('image2')) {
            $slider1->clearMediaCollection('image2');
            $slider1->addMediaFromRequest('image2')
                ->toMediaCollection('image2');
        }
        return redirect()->route('admin.slider1.index')->with('success', 'Slider updated successfully');
    }
}
