<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class WebPermissionsController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        $permissions = Permission::get();

        // dd($roles);
        return view('Web.permission.permissions', compact('roles', 'permissions'));
    }

    public function create(Request $request)
    {
        $role_name = $request->input('role_name');
        $permissions = $request->input('permissions');

        $role = Role::create([
            'name' => $role_name,
            'display_name' => $role_name, // optional
        ]);

        foreach ($permissions as $permission) {
            $role->attachPermissions([$permission]);
        }

        return redirect()->route('web.permissions.view');
    }

    public function delete(Role $role)
    {
        if (!in_array($role->name, ['owner', 'manager', 'employee',])) {
            $role->delete();
        }

        return redirect()->route('web.permissions.view');
    }
}
