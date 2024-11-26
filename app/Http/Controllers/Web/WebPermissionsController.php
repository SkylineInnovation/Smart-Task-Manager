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

        $permissions = Permission::where('name', 'Not Like', '%delete%')
            ->where('name', 'Not Like', '%restore%')
            ->where('name', 'Not Like', '%applang%')
            ->where('name', 'Not Like', '%otpsendcode%')
            ->where('name', 'Not Like', '%passwordcode%')
            ->where('name', 'Not Like', '%devicetokenlist%')
            ->where('name', 'Not Like', '%loghistory%')
            ->where('name', 'Not Like', '%userdetail%')
            ->orderBy('name')->get();

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
