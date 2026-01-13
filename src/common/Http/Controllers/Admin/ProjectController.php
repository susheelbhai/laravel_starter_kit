<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Support\Str;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function index()
    {
        $data = Project::latest()->get()->map(function ($product) {
            $media = $product->getMedia('images');
            return [
                ...$product->toArray(),
                'thumbnail' => $media->first()?->getUrl('thumb'),
                'images' => $media->map(fn($m) => $m->getUrl()),
            ];
        });
        return $this->render('admin/resources/project/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/project/create');
    }
    public function store(ProjectRequest $request)
    {
        $data = new Project();

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->author = $request->author;
        $data->tags = $request->tags;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->highlighted_text1 = $request->highlighted_text1;
        $data->highlighted_text2 = $request->highlighted_text2;
        $data->ad_url = $request->ad_url;
        $data->views = $request->views;
        $data->is_active = $request->is_active;
        $data->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }
        if ($request->hasFile('ad_img')) {
            $data->addMediaFromRequest('ad_img')
                ->toMediaCollection('ad_img');
        }
        return redirect()->route('admin.project.index')->with('success', 'New project created successfully');
    }

    public function show($id)
    {
        $data = Project::findOrFail($id);
        return $this->render('admin/resources/project/show', compact('data'));
    }
    
    public function edit($id)
    {
        $data = Project::findOrFail($id);
        return $this->render('admin/resources/project/edit', compact('data'));
    }

    public function update(ProjectRequest $request, $id)
    {
        $data = Project::find($id);

        $data->title = $request->title;
        // $data->category = $request->category; // Removed, not in migration
        $data->author = $request->author;
        $data->tags = $request->tags;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->highlighted_text1 = $request->highlighted_text1;
        $data->highlighted_text2 = $request->highlighted_text2;
        $data->ad_url = $request->ad_url;
        $data->views = $request->views;
        $data->is_active = $request->is_active;
        $data->update();

        // Handle deleted images - properly delete files and database entries
        if ($request->has('deleted_images_ids') && is_array($request->deleted_images_ids)) {
            $mediaItems = MediaExternal::whereIn('id', $request->deleted_images_ids)
                ->where('model_type', Product::class)
                ->where('model_id', $data->id)
                ->get();
            
            foreach ($mediaItems as $media) {
                $media->delete(); // This triggers Spatie's cleanup and deletes actual files
            }
        }
        if ($request->hasFile('ad_img')) {
            $data->clearMediaCollection('ad_img');
            $data->addMediaFromRequest('ad_img')
                ->toMediaCollection('ad_img');
        }
        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }

        
        return redirect()->route('admin.project.index')->with('success', 'Project data updated successfully');
    }

  
    public function destroy(Project $project)
    {
        //
    }
}
