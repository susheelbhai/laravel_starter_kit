<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $data = User::latest()->paginate(15)->through(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'profile_pic' => $user->profile_pic,
                'profile_pic_thumb' => $user->getFirstMediaUrl('profile_pic', 'thumb'),
            ];
        });
        return $this->render('admin/resources/user/index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return $this->render('admin/resources/user/create');
    }

    public function store(UserRequest $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make(rand(888888888, 9999999999));
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }

        return Redirect::route('admin.user.index')->with('success', 'new user created successfully');
    }

    public function show($id)
    {
        $data = User::find($id);
        return $this->render('admin/resources/user/show', [
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        return $this->render('admin/resources/user/edit', [
            'data' => User::find($id),
        ]);
    }
    
    public function update(UserRequest $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        if ($request->hasFile('profile_pic')) {
            $data->clearMediaCollection('profile_pic');
            $data->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }
        return Redirect::route('admin.user.update', $id)->with('success', 'profile-updated');
    }


    public function destroy($id)
    {
        //
    }
}
