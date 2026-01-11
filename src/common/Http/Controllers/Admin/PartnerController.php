<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use App\Http\Requests\PartnerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
// No unused imports found, but removing all multiline comments

class PartnerController extends Controller
{
    public function index()
    {
        $data = Partner::latest('id')->paginate(15)->through(function ($partner) {
            return [
                'id' => $partner->id,
                'name' => $partner->name,
                'email' => $partner->email,
                'phone' => $partner->phone,
                'profile_pic' => $partner->profile_pic,
                'profile_pic_thumb' => $partner->getFirstMediaUrl('profile_pic', 'thumb'),
            ];
        });
        return $this->render('admin/resources/partner/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/partner/create');
    }

    public function store(PartnerRequest $request)
    {
        $data = new Partner();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make(rand(888888888, 9999999999));
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }

        return Redirect::route('admin.partner.index')->with('success', 'new partner created successfully');
    }

    public function show($id)
    {
        $data = Partner::find($id);
        return $this->render('admin/resources/partner/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Partner::find($id);
        return $this->render('admin/resources/partner/edit', compact('data'));
    }

    public function update(PartnerRequest $request, $id)
    {
        $data = Partner::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->clearMediaCollection('profile_pic');
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }


        return Redirect::route('admin.partner.update', $id)->with('success', 'Partner updated successfully');
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
