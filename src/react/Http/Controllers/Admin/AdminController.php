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
        $roles = Role::select('id', 'name as title')->get();
        $permissions = Permission::select('id', 'name as title')->get();
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
            'name'   => 'required',
            'phone'  => 'required|unique:admins,phone',
            'email'  => 'required|email|unique:admins,email',
            'dob'    => 'nullable|date',
            'address' => 'nullable|string',
            'city'   => 'nullable|string',
            'state'  => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // from multicheckbox
            'roles'       => 'nullable|array',
            'permissions' => 'nullable|array',
        ]);

        $admin = new Admin();
        $admin->name   = $request->name;
        $admin->dob    = $request->dob;
        $admin->address = $request->address;
        $admin->city   = $request->city;
        $admin->state  = $request->state;
        $admin->email  = $request->email;
        $admin->phone  = $request->phone;

        if ($request->hasFile('profile_pic')) {
            $profile_pic_name = 'images/profile_pic/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic'), $profile_pic_name);
            $admin->profile_pic = $profile_pic_name;
        }
        // password = phone
        $admin->password = Hash::make($request->phone);
        $admin->save();

        // ✅ Assign roles by ID (coming from multicheckbox)
        if ($request->filled('roles')) {
            // roles[] will be like ["1", "3", "5"]
            $roleIds = collect($request->roles)
                ->filter()
                ->map(fn($v) => (int) $v)
                ->all();

            $roles = Role::whereIn('id', $roleIds)->get();
            $admin->syncRoles($roles);
        }

        // ✅ Assign permissions by ID
        if ($request->filled('permissions')) {
            $permissionIds = collect($request->permissions)
                ->filter()
                ->map(fn($v) => (int) $v)
                ->all();

            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $admin->syncPermissions($permissions);
        }

        return Redirect::route('admin.admin.index')
            ->with('success', 'new admin created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Admin::whereId($id)->where('id', '!=', 1)->firstOrFail();
        $data->getAllPermissions();
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
        $roles = Role::select('id', 'name as title')->get();
        $permissions = Permission::select('id', 'name as title')->get();
        return Inertia::render('admin/resources/admin/edit', compact('data', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:admins,email,' . $id,
            'phone'  => 'required|unique:admins,phone,' . $id,
            'dob'    => 'nullable|date',
            'address' => 'nullable|string',
            'city'   => 'nullable|string',
            'state'  => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'roles'       => 'nullable|array',
            'permissions' => 'nullable|array',
        ]);

        $admin = Admin::findOrFail($id);

        // --------------------------
        // 🔹 UPDATE BASIC FIELDS
        // --------------------------
        $admin->name    = $request->name;
        $admin->dob     = $request->dob;
        $admin->address = $request->address;
        $admin->city    = $request->city;
        $admin->state   = $request->state;
        $admin->email   = $request->email;
        $admin->phone   = $request->phone;

        if ($request->hasFile('profile_pic')) {
            $profile_pic_name = 'images/profile_pic/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic'), $profile_pic_name);
            $admin->profile_pic = $profile_pic_name;
        }

        $admin->save();

        // --------------------------
        // 🔹 UPDATE ROLES
        // front-end sends array of IDs: roles[] = 1,2,3
        // --------------------------
        if ($request->filled('roles')) {
            $roleIds = collect($request->roles)
                ->filter()
                ->map(fn($v) => (int)$v)
                ->all();

            $admin->syncRoles($roleIds);
        } else {
            // If no roles checked, remove all roles
            $admin->syncRoles([]);
        }

        // --------------------------
        // 🔹 UPDATE PERMISSIONS
        // front-end sends array of IDs: permissions[] = 5,6
        // --------------------------
        if ($request->filled('permissions')) {
            $permissionIds = collect($request->permissions)
                ->filter()
                ->map(fn($v) => (int)$v)
                ->all();

            $admin->syncPermissions($permissionIds);
        } else {
            // Optional: remove all permissions if none selected
            $admin->syncPermissions([]);
        }

        return redirect()
            ->route('admin.admin.index')
            ->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
