<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function index()
    {
        $data = Blog::latest()->get();
        return $this->render('admin/resources/blog/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/blog/create');
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

        $data = new Blog();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category = $request->category;
        $data->author = $request->author;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->highlighted_text1 = $request->highlighted_text1;
        $data->highlighted_text2 = $request->highlighted_text2;
        $data->ad_url = $request->ad_url;
        $data->tags = $request->tags;
        // $data->is_active = $request->is_active;
        $data->save();

        if ($request->hasFile('display_img')) {
            $data->addMediaFromRequest('display_img')
                ->toMediaCollection('display_image');
        }

        if ($request->hasFile('ad_img')) {
            $data->addMediaFromRequest('ad_img')
                ->toMediaCollection('ad_image');
        }
        return redirect()->route('admin.blog.index')->with('success', 'New blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Blog::findOrFail($id);
        return $this->render('admin/resources/blog/show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Blog::find($id);
        return $this->render('admin/resources/blog/edit', compact('data'));
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
        $data = Blog::find($id);

        $data->title = $request->title;
        $data->author = $request->author;
        $data->category = $request->category;
        $data->short_description = $request->short_description;
        $data->long_description1 = $request->long_description1;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->highlighted_text1 = $request->highlighted_text1;
        $data->highlighted_text2 = $request->highlighted_text2;
        $data->ad_url = $request->ad_url;
        $data->tags = $request->tags;
        $data->is_active = $request->is_active;
        $data->update();

        if ($request->hasFile('display_img')) {
            $data->clearMediaCollection('display_image');
            $data->addMediaFromRequest('display_img')
                ->toMediaCollection('display_image');
        }

        if ($request->hasFile('ad_img')) {
            $data->clearMediaCollection('ad_image');
            $data->addMediaFromRequest('ad_img')
                ->toMediaCollection('ad_image');
        }
        return redirect()->route('admin.blog.index')->with('success', 'New blog created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
