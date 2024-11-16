<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();
        // Permission::truncate();

        // owner
        // dev
        // manager
        // employee

        $ownerRole = Role::where('name', 'owner')->first();
        if (!$ownerRole)
            $ownerRole = Role::create([
                'name' => 'owner',
                'display_name' => 'Project Owner', // optional
                'description' => 'User is the owner of a given project', // optional
            ]);

        $devRole = Role::where('name', 'dev')->first();
        if (!$devRole)
            $devRole = Role::create([
                'name' => 'dev',
                'display_name' => 'Devloper', // optional
                'description' => 'User is the dev of this given project', // optional
            ]);

        // $fullRole = Role::where('name', 'full')->first();
        // if (!$fullRole)
        //     $fullRole = Role::create([
        //         'name' => 'full',
        //         'display_name' => 'Full', // optional
        //         'description' => 'User is the full of this given project', // optional
        //     ]);

        $lists = [
            'user',
            'applang',

            'otpsendcode',
            'passwordcode',
            'devicetokenlist',

            'task',
            'attachment',
            'comment',
            'extratime',
            'leave',
            'discount',
            'dailytask',

            'loghistory',

            'department',
            'branch',
            'company',
            'area',

            'userdetail',
        ];

        foreach ($lists as $item) {
            try {
                $indexPermission = Permission::create([
                    'name' => "index-$item",
                    'display_name' => "index $item", // optional
                    'description' => "allow user to show index $item", // optional
                ]);
                $ownerRole->attachPermissions([$indexPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $createPermission = Permission::create([
                    'name' => "create-$item",
                    'display_name' => "create new $item", // optional
                    'description' => "allow user to create new $item", // optional
                ]);
                $ownerRole->attachPermissions([$createPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $editPermission = Permission::create([
                    'name' => "edit-$item",
                    'display_name' => "edit $item", // optional
                    'description' => "allow user to edit $item", // optional
                ]);
                $ownerRole->attachPermissions([$editPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $deletePermission = Permission::create([
                    'name' => "delete-$item",
                    'display_name' => "delete $item", // optional
                    'description' => "allow user to delete $item", // optional
                ]);
                $ownerRole->attachPermissions([$deletePermission]);
            } catch (\Throwable $th) {
            }

            try {
                $restorePermission = Permission::create([
                    'name' => "restore-$item",
                    'display_name' => "restore $item", // optional
                    'description' => "allow user to restore $item", // optional
                ]);
                $ownerRole->attachPermissions([$restorePermission]);
            } catch (\Throwable $th) {
            }

            // try {
            //     $importExcelPermission = Permission::create([
            //         'name' => "import-excel-$item",
            //         'display_name' => "import excel $item", // optional
            //         'description' => "allow user import $item excel", // optional
            //     ]);
            //     $ownerRole->attachPermissions([$importExcelPermission]);
            // } catch (\Throwable $th) {
            // }
            // try {
            //     $exportExcelPermission = Permission::create([
            //         'name' => "export-excel-$item",
            //         'display_name' => "export excel $item", // optional
            //         'description' => "allow user export $item excel", // optional
            //     ]);
            //     $ownerRole->attachPermissions([$exportExcelPermission]);
            // } catch (\Throwable $th) {
            // }
        }

        $customPermissions = [
            'show-user',
            'show-task',
            'show-branch',
            'show-company',
        ];

        foreach ($customPermissions as $customPermission) {
            $permission = Permission::where('name', $customPermission)->latest()->first();

            if (!$permission)
                Permission::create([
                    'name' => $customPermission,
                    'display_name' => str_replace(['_', '-'], [' ', ' '], $customPermission),
                ]);
        }

        $managerRole = Role::where('name', 'manager')->first();

        if (!$managerRole)
            $managerRole = Role::create([
                'name' => 'manager',
                'display_name' => 'Manager', // optional
            ]);

        $employeeRole = Role::where('name', 'employee')->first();

        if (!$employeeRole)
            $employeeRole = Role::create([
                'name' => 'employee',
                'display_name' => 'Employee', // optional
            ]);
    }
}
