<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use App\Http\Requests\ServiceRequest;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

    public function index()
    {
        $data = Service::latest()->get();
        return $this->render('admin/resources/service/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/service/create');
    }
    public function store(ServiceRequest $request)
    {
        $data = new Service();

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

        if ($request->hasFile('display_img')) {
            $data->addMediaFromRequest('display_img')
                ->toMediaCollection('display_image');
        }
        return redirect()->route('admin.service.index')->with('success', 'New service created successfully');
    }

    public function show($id)
    {
        $data = Service::findOrFail($id);
        return $this->render('admin/resources/service/show', compact('data'));
    }
    
    public function edit($id)
    {
        $data = Service::findOrFail($id);
        return $this->render('admin/resources/service/edit', compact('data'));
    }

    public function update(ServiceRequest $request, $id)
    {
        $data = Service::find($id);

        $data->title = $request->title;
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->tags = $request->tags;
        $data->is_active = $request->is_active;
        $data->update();

        if ($request->hasFile('display_img')) {
            $data->clearMediaCollection('display_image');
            $data->addMediaFromRequest('display_img')
                ->toMediaCollection('display_image');
        }
        return redirect()->route('admin.service.index')->with('success', 'Service data updated successfully');
    }

  
    public function destroy(Service $service)
    {
        //
    }
}
