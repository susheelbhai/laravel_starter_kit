<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
// Removed unused Inertia import

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return $this->render("admin/resources/role/index", [
            "data" => $roles
        ]);
    }

    public function create()
    {
        return $this->render('admin/resources/role/create', [
            "permissions" => Permission::select('id', 'name as title')->get()
        ]);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request['name']]);
        $role->syncPermissions($request['permissions']);
        return to_route('admin.role.index')->with('success', 'New role created successfully');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $roles = Role::whereId($id)->with('permissions')->first();
        $permissions = Permission::select('id', 'name as title')->get();
        return $this->render("admin/resources/role/edit", [
            "permissions" => $permissions,
            "data" => $roles
        ]);
    }

    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        $permissionIds = collect($request->permissions)
            ->filter()
            ->map(fn($v) => (int) $v)
            ->all();

        $role->syncPermissions($permissionIds);

        return to_route('admin.role.index')->with('success', 'Role updated successfully');
    }

    public function destroy(string $id)
    {
    }
}
