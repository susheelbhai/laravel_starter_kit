<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::all();
        return view('admin.resources.service.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resources.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'long_description1' => 'required',
        ]);
        $image_name = 'dummy.png';
        $data = new Service();

        if ($request->image != '') {
            $image_name = 'images/services/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/services'), $image_name);
        }
        
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->tags = $request->tags;
        $data->display_img = $image_name;
        if (isset($request->is_active)) {
            $data->is_active = 1;
        } else {
            $data->is_active = 0;
        }
        $data->save();
        return redirect()->route('admin.service.index')->with('success', 'New service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Service::findOrFail($id);
        return view('separate.admin.resources.service.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Service::findOrFail($id);
        return view('separate.admin.resources.service.edit', compact('data'));
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

        if ($request->image != '') {
            $image_name = 'images/services/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/services'), $image_name);
        }
        
        $data->title = $request->title;
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->tags = $request->tags;
        $data->display_img = $image_name;
        if (isset($request->is_active)) {
            $data->is_active = 1;
        } else {
            $data->is_active = 0;
        }
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
