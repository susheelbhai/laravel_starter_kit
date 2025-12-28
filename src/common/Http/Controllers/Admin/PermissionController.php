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
        return $this->render("admin/resources/permission/index", [
            "data" => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->render('admin/resources/permission/create', [
            "roles" => Role::select('id', 'name as title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        $permission = Permission::create(['name' => $request['name']]);
        $permission->syncRoles($request['roles']);
        return to_route('admin.permission.index')->with('success', 'New permission created successfully');
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
        $roles = Role::select('id', 'name as title')->get();
        $permissions = Permission::whereId($id)->with('roles')->first();
        return $this->render("admin/resources/permission/edit", [
            "data" => $permissions,
            "roles" => $roles
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'roles' => 'required|array',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        // roles[] will be ["1", "2", "3"] → cast to int
        $roleIds = collect($request->roles)
            ->filter()
            ->map(fn($v) => (int) $v)
            ->all();

        $permission->syncRoles($roleIds);

        return to_route('admin.permission.index')->with('success', 'Permission updated successfully');
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
