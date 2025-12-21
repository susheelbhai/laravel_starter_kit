<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    public function index()
    {
        $data = Service::latest()->get();
        return Inertia::render('admin/resources/service/index', compact('data'));
    }

    public function create()
    {
        return Inertia::render('admin/resources/service/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'long_description1' => 'required',
        ]);
        $image_name = 'dummy.png';
        $data = new Service();

        if ($request->hasFile('display_img')) {
            $image_name = 'images/services/' . uniqid() . '.' . $request->file('display_img')->getClientOriginalExtension();
            $request->display_img->move(public_path('/storage/images/services'), $image_name);
            $data->display_img = $image_name;
        }

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->tags = $request->tags;
        $data->is_active = $request->is_active;

        $data->save();
        return redirect()->route('admin.service.index')->with('success', 'New service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Service::findOrFail($id);
        return Inertia::render('admin/resources/service/show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Service::findOrFail($id);
        return Inertia::render('admin/resources/service/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'long_description1' => 'required',
        ]);
        $data = Service::find($id);
        $image_name = $data['display_img'];

        if ($request->hasFile('display_img')) {
            $image_name = 'images/services/' . uniqid() . '.' . $request->file('display_img')->getClientOriginalExtension();
            $request->display_img->move(public_path('/storage/images/services'), $image_name);
            $data->display_img = $image_name;
        }

        $data->title = $request->title;
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->tags = $request->tags;
        $data->is_active = $request->is_active;

        $data->update();
        return redirect()->route('admin.service.index')->with('success', 'Service data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
