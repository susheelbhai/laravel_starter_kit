<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return Inertia::render("admin/resources/role/index", [
            "data" => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/resources/role/create', [
            "permissions" => Permission::select('id', 'name as title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        $role = Role::create(['name' => $request['name']]);
        $role->syncPermissions($request['permissions']);
        return to_route('admin.role.index')->with('success', 'New role created successfully');
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
        $roles = Role::whereId($id)->with('permissions')->first();
        $permissions = Permission::select('id', 'name as title')->get();
        return Inertia::render("admin/resources/role/edit", [
            "permissions" => $permissions,
            "data" => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        // permissions come as ['1', '2', '3'] (strings from FormData)
        // Cast them to integers so Spatie treats them as IDs
        $permissionIds = collect($request->permissions)
            ->filter()                // remove null/empty values if any
            ->map(fn($v) => (int) $v)
            ->all();                  // result: [1, 2, 3]

        $role->syncPermissions($permissionIds);

        return to_route('admin.role.index')->with('success', 'Role updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
