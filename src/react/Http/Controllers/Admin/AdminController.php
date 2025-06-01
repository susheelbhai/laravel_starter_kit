<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::where('id', '!=', 1)->get();
        return Inertia::render('admin/resources/admin/index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        $roles = Role::select('name as title')->get();
        $permissions = Permission::select('name as title')->get();
        return Inertia::render('admin/resources/admin/create', compact('roles', 'permissions'));
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
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:admins,phone',
            'email' => 'required|email|unique:admins,email',
            // 'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->dob = $request->dob;
        $admin->address = $request->address;
        $admin->city = $request->city;
        $admin->state = $request->state;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('images/membership/profile');
            $admin->profile_pic = $path;
        }
        $admin->password = Hash::make($request->phone); // Set password as phone number
        $admin->save();
        // Assign roles (if provided)
        if ($request->has('roles')) {
            $roles = Role::whereIn('name', $request->roles)->get();
            $admin->syncRoles($roles); // Replaces existing roles
        }

        // Assign permissions (if provided)
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->permissions)->get();
            $admin->syncPermissions($permissions); // Replaces existing permissions
        }

        return Redirect::route('admin.admin.index')->with('status', 'new admin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Admin::find(1)->assignRole('Super Admin');
        // $role = Role::create(['name' => 'Reperesentative Admin']);
        // $permission = Permission::create(['name' => 'add rights']);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        $data = Admin::whereId($id)->where('id', '!=', 1)->firstOrFail();
        // $data->getRoleNames();
        $data->getAllPermissions();
        // return $data;

        return Inertia::render('admin/resources/admin/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::whereId($id)->where('id', '!=', 1)->firstOrFail();
        $data->getRoleNames();
        $data->getAllPermissions();
        $roles = Role::select('name as title')->get();
        $permissions = Permission::select('name as title')->get();
        return Inertia::render('admin/resources/admin/edit', compact('data', 'roles', 'permissions'));
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
        // dd($request->all()) ;
        
        $request->validate([
            'name' => 'required',
            'email' => [
            'required',
            'email',
            Rule::unique('admins')->ignore($id)
        ],
        'phone' => [
            'required',
            'string',
            Rule::unique('admins')->ignore($id)
        ],
        ]);
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->dob = $request->dob;
        $admin->address = $request->address;
        $admin->city = $request->city;
        $admin->state = $request->state;
        $admin->email = $request->email;
        $admin->phone = $request->phone;

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('images/membership/profile');
            $admin->profile_pic = $path;
        }

        // Assign roles (if provided)
        
        
        $admin->update();
        if ($request->has('roles')) {
            $roles = Role::whereIn('name', $request->roles)->get();
            $admin->syncRoles($roles); // Replaces existing roles
        }

        // Assign permissions (if provided)
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->permissions)->get();
            $admin->syncPermissions($permissions); // Replaces existing permissions
        }
        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
