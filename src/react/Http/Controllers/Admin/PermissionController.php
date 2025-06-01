<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return Inertia::render("admin/resources/permission/index", [
            "data" => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/resources/permission/create', [
            "roles" => Role::select('name as title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $permission = Permission::create(['name' => $request['name']]);
        $permission->syncRoles($request['roles']);
        return to_route('admin.permission.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::select('name as title')->get();
        $permissions = Permission::whereId($id)->with('roles')->first();
        return Inertia::render("admin/resources/permission/edit", [
            "data" => $permissions,
            "roles" => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            // 'roles' => 'required'
        ]);
        Permission::whereId($id)->update(['name' => $request['name']]);
        $permission = Permission::find($id);
        $permission->syncRoles($request['roles']);
        return to_route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::find($id)->delete();
        return to_route('admin.permission.index');
    }
}
