<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{

    public function index()
    {
        $data = Partner::latest('id')->get();
        return Inertia::render('admin/resources/partner/index', compact('data'));
    }

    public function create()
    {
        return Inertia::render('admin/resources/partner/create');
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
            'phone' => 'required|unique:partners,phone',
            'email' => 'required|email|unique:partners,email',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = new Partner();
        if ($request->hasFile('profile_pic')) {
            $profile_pic_name = 'images/profile_pic/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic'), $profile_pic_name);
            $data->profile_pic = $profile_pic_name;
        }

        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make(rand(888888888, 9999999999));

        $data->save();


        return Redirect::route('admin.partner.index')->with('success', 'new partner created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Partner::find($id);
        return Inertia::render('admin/resources/partner/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Partner::find($id);
        return Inertia::render('admin/resources/partner/edit', compact('data'));
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
            'phone' => 'required|unique:partners,phone,'.$id,
            'email' => 'required|email|unique:partners,email,'.$id,
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = Partner::find($id);

        if ($request->hasFile('profile_pic')) {
            $profile_pic_name = 'images/profile_pic/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic'), $profile_pic_name);
            $data->profile_pic = $profile_pic_name;
        }

        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;

        $data->save();


        return Redirect::route('admin.partner.update', $id)->with('success', 'profile-updated');
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
