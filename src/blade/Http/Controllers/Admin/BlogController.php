<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::all();
        return view('admin.resources.blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resources.blog.create');
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
        $ad_img_name = 'dummy.png';
        $data = new Blog();

        if ($request->image != '') {
            $image_name = 'images/blogs/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/blogs'), $image_name);
        }
        if ($request->ad_img != '') {
            $ad_img_name = 'images/blogs/ads/'.uniqid() . '.' . $request->file('ad_img')->getClientOriginalExtension();
            $request->ad_img->move(public_path('/storage/images/blogs/ads'), $ad_img_name);
        }
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
        $data->display_img = $image_name;
        $data->ad_img = $ad_img_name;
        if (isset($request->is_active)) {
            $data->is_active = 1;
        } else {
            $data->is_active = 0;
        }
        $data->save();
        return redirect()->route('admin.blog.index')->with('success', 'New blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Blog::findOrFail($id);
        return view('separate.admin.resources.blog.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Blog::find($id);
        return view('separate.admin.resources.blog.edit', compact('data'));
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
        $image_name = $data['display_img'];
        $ad_img_name = $data['ad_img'];

        if ($request->image != '') {
            $image_name = 'images/blogs/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/blogs'), $image_name);
        }
        if ($request->ad_img != '') {
            $ad_img_name = 'images/blogs/ads/'.uniqid() . '.' . $request->file('ad_img')->getClientOriginalExtension();
            $request->ad_img->move(public_path('/storage/images/blogs/ads'), $ad_img_name);
        }
        
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
        $data->display_img = $image_name;
        $data->ad_img = $ad_img_name;
        if (isset($request->is_active)) {
            $data->is_active = 1;
        } else {
            $data->is_active = 0;
        }
        $data->update();
        return redirect()->route('admin.blog.index')->with('success', 'Blog data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
