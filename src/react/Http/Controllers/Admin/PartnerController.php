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
        $data = Partner::all();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:partners,phone',
            'email' => 'required|email|unique:partners,email',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            // Return errors in an Inertia response
            // return back()->withErrors($validator->errors())->withInput();
            return Inertia::render('admin/resources/partner/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }

        if($request->profile_pic==''){
            $image_name='dummy.png';
          }
          else{
            $image_name=uniqid().'.'.$request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/partner'),$image_name);
          }
          Partner::create([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'dob' => $request->dob,
              'profile_pic' => $image_name,
              'password' => Hash::make(rand(888888888,9999999999)),
            ]);


        return Redirect::route('admin.partner.index')->with('status', 'new partner created successfully');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('separate.admin.resources.partner.edit', [
            'user' => Partner::find($id),
        ]);
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
        $data = Partner::find($id);

        if($request->profile_pic==''){
            $image_name=$data->profile_pic;
          }
          else{
            $image_name=uniqid().'.'.$request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/partner'),$image_name);
            File::delete(public_path('storage/images/profile_pic/partner/'.$data->profile_pic));
          }
          Partner::where('id', $data->id)->
          update([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'dob' => $request->dob,
              'profile_pic' => $image_name,
            ]);


        return Redirect::route('admin.partner.update', $id)->with('status', 'profile-updated');
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
