<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $data = User::all();
        return Inertia::render('admin/resources/user/index', [
            'data' => $data,
        ]);
    }

 
    public function create()
    {
        return Inertia::render('admin/resources/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            // Return errors in an Inertia response
            // return back()->withErrors($validator->errors())->withInput();
            return Inertia::render('admin/resources/user/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }

        if($request->profile_pic==''){
            $image_name='dummy.png';
          }
          else{
            $image_name=uniqid().'.'.$request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/user'),$image_name);
          }
          User::create([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'dob' => $request->dob,
              'profile_pic' => $image_name,
              'password' => Hash::make(rand(888888888,9999999999)),
            ]);


        return Redirect::route('admin.user.index')->with('status', 'new user created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return view('separate.admin.resources.user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('separate.admin.resources.user.edit', [
            'user' => User::find($id),
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
        $data = User::find($id);

        if($request->profile_pic==''){
            $image_name=$data->profile_pic;
          }
          else{
            $image_name=uniqid().'.'.$request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/user'),$image_name);
            File::delete(public_path('storage/images/profile_pic/user/'.$data->profile_pic));
          }
          User::where('id', $data->id)->
          update([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'dob' => $request->dob,
              'profile_pic' => $image_name,
            ]);


        return Redirect::route('admin.user.update', $id)->with('status', 'profile-updated');
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
