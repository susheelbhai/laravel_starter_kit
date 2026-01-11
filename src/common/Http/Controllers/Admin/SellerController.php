<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use App\Http\Requests\SellerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Events\SellerCreated;
// Removed unused Inertia, File, and Validator imports

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
        return $this->render('admin/resources/seller/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/seller/create');
    }

    public function store(SellerRequest $request)
    {
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

    public function show($id)
    {
        $data = Seller::find($id);
        return $this->render('admin/resources/seller/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Seller::find($id);
        return $this->render('admin/resources/seller/edit', compact('data'));
    }

    public function update(SellerRequest $request, $id)
    {
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


        return Redirect::route('admin.seller.update', $id)->with('success', 'Seller updated successfully');
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
