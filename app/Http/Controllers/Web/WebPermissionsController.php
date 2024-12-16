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


        return view('Web.permission.index', compact('roles', 'permissions'));
    }

    public function create(Request $request)
    {
        // 

        $role_name = $request->input('role_name');
        $permissions = $request->input('permissions');

        $role = Role::create([
            'name' => $role_name,
            'display_name' => [
                'ar' => $request->input('role_name_ar'),
                'en' => $request->input('role_name_en'),
            ],

            'description' => [
                'ar' => $request->input('role_description_ar'),
                'en' => $request->input('role_description_en'),
            ],
        ]);

        if ($permissions)
            $role->syncPermissions($permissions);

        return redirect()->route('web.permissions.view');
    }

    public function edit(Role $role)
    {
        if (in_array($role->name, ['owner', 'manager', 'employee', 'financial', 'technical',]))
            return redirect()->route('web.permissions.view');


        $permissions = Permission::where('name', 'Not Like', '%delete%')
            ->where('name', 'Not Like', '%restore%')
            ->where('name', 'Not Like', '%applang%')
            ->where('name', 'Not Like', '%otpsendcode%')
            ->where('name', 'Not Like', '%passwordcode%')
            ->where('name', 'Not Like', '%devicetokenlist%')
            ->where('name', 'Not Like', '%loghistory%')
            ->where('name', 'Not Like', '%userdetail%')
            ->orderBy('name')->get();


        return view('Web.permission.edit', compact('role', 'permissions'));
    }

    public function update(Role $role, Request $request)
    {
        $role_name = $request->input('role_name');
        $permissions = $request->input('permissions');

        $role->update([
            'name' => $role_name,
            'display_name' => [
                'ar' => $request->input('role_name_ar', $role->the_display_name('ar')),
                'en' => $request->input('role_name_en', $role->the_display_name('en')),
            ],
            'description' => [
                'ar' => $request->input('role_description_ar', $role->the_description('ar')),
                'en' => $request->input('role_description_en', $role->the_description('en')),
            ],
        ]);

        if ($permissions)
            $role->syncPermissions($permissions);

        return redirect()->route('web.permissions.view');
    }

    public function delete(Role $role)
    {
        if (!in_array($role->name, ['owner', 'manager', 'employee', 'financial', 'technical',])) {
            $role->delete();
        }

        return redirect()->route('web.permissions.view');
    }
}
