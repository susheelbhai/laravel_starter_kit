<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Testimonial::all();
        return view('admin.resources.testimonial.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);
        $testimonial = new Testimonial();

        if ($request->image != '') {
            $image_name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/common/images/testimonials'), $image_name);
            File::delete(public_path('storage/common/images/testimonials/' . Auth::guard('admin')->user()->image));
            $testimonial->image = $image_name;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        if (isset($request->is_active)) {
            $testimonial->is_active = 1;
        } else {
            $testimonial->is_active = 0;
        }
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
        $data = Testimonial::find($id);
        return view('admin.resources.testimonial.view', compact('data'));
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
        return view('admin.resources.testimonial.edit', compact('data'));
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
        // return $request;
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);
        $testimonial =  Testimonial::find($id);

        if ($request->image != '') {
            $image_name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/common/images/testimonials'), $image_name);
            File::delete(public_path('storage/common/images/testimonials/' . Auth::guard('admin')->user()->image));
            $testimonial->image = $image_name;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        if (isset($request->is_active)) {
            $testimonial->is_active = 1;
        } else {
            $testimonial->is_active = 0;
        }
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
