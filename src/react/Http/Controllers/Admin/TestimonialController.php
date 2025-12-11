<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Testimonial::latest()->get();
        return Inertia::render('admin/resources/testimonial/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('admin/resources/testimonial/create');
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
            'name' => 'required',
            'message' => 'required',
        ]);
        $image_name = 'images/testimonials/dummy.png';
        $testimonial = new Testimonial();

        if ($request->hasFile('image')) {
            $image_name = 'images/testimonials/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/storage/images/testimonials'), $image_name);
            $testimonial->image = $image_name;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        $testimonial->is_active = $request->is_active;
        $testimonial->save();
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Testimonial::findOrFail($id);
        return Inertia::render('admin/resources/testimonial/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Testimonial::find($id);
        return Inertia::render('admin/resources/testimonial/edit', compact('data'));
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
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);
        $testimonial =  Testimonial::find($id);

        if ($request->hasFile('image')) {
            $image_name = 'images/testimonials/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/storage/images/testimonials'), $image_name);
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        $testimonial->image = $image_name;
        $testimonial->is_active = $request->is_active;
        $testimonial->update();
        return redirect()->route('admin.testimonial.index');
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
