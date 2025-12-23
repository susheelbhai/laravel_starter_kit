<?php

namespace App\Http\Controllers\Admin;

use App\Events\SellerCreated;
use Inertia\Inertia;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function index()
    {
        $data = Seller::latest('id')->paginate(15)->through(function ($seller) {
            return [
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
                'phone' => $seller->phone,
                'profile_pic' => $seller->profile_pic,
                'profile_pic_thumb' => $seller->getFirstMediaUrl('profile_pic', 'thumb'),
            ];
        });
        return Inertia::render('admin/resources/seller/index', compact('data'));
    }

    public function create()
    {
        return Inertia::render('admin/resources/seller/create');
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
        $data = new Seller();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make(rand(888888888, 9999999999));
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }

        SellerCreated::dispatch($data);

        return Redirect::route('admin.seller.index')->with('success', 'new seller created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Seller::find($id);
        return Inertia::render('admin/resources/seller/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Seller::find($id);
        return Inertia::render('admin/resources/seller/edit', compact('data'));
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
        $data = Seller::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->clearMediaCollection('profile_pic');
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }


        return Redirect::route('admin.seller.update', $id)->with('success', 'profile-updated');
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
