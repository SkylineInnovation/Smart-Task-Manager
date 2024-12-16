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
                'display_name' => [
                    'ar' => 'صاحب المشروع',
                    'en' => 'Project Owner',
                ],
                'description' => [
                    'ar' => 'مستخدم يمتلك كامل الصلاحيات في النظام',
                    'en' => 'User with full privileges in the system',
                ],
            ]);

        // $devRole = Role::where('name', 'dev')->first();
        // if (!$devRole)
        //     $devRole = Role::create([
        //         'name' => 'dev',
        //         'display_name' => 'Devloper', // optional
        //         'description' => 'User is the dev of this given project', // optional
        //     ]);

        // $fullRole = Role::where('name', 'full')->first();
        // if (!$fullRole)
        //     $fullRole = Role::create([
        //         'name' => 'full',
        //         'display_name' => 'Full', // optional
        //         'description' => 'User is the full of this given project', // optional
        //     ]);

        $lists = [
            [
                'name' => 'user',
                'ar' => 'مستخدم',
                'en' => 'user',
            ],
            // 'applang',

            // 'otpsendcode',
            // 'passwordcode',
            // 'devicetokenlist',

            [
                'name' => 'task',
                'ar' => 'مهمة',
                'en' => 'task',
            ],
            [
                'name' => 'attachment',
                'ar' => 'مرفق',
                'en' => 'attachment',
            ],
            [
                'name' => 'comment',
                'ar' => 'تعليق',
                'en' => 'comment',
            ],
            [
                'name' => 'extratime',
                'ar' => 'وقت اضافي',
                'en' => 'extra time',
            ],
            [
                'name' => 'leave',
                'ar' => 'مغادرة',
                'en' => 'leave',
            ],
            [
                'name' => 'discount',
                'ar' => 'خصم',
                'en' => 'discount',
            ],
            [
                'name' => 'dailytask',
                'ar' => 'مهمة يومية',
                'en' => 'daily task',
            ],

            // 'loghistory',

            [
                'name' => 'department',
                'ar' => 'قسم',
                'en' => 'department',
            ],
            [
                'name' => 'branch',
                'ar' => 'فرع',
                'en' => 'branch',
            ],
            [
                'name' => 'company',
                'ar' => 'شركة',
                'en' => 'company',
            ],
            [
                'name' => 'area',
                'ar' => 'منطقة',
                'en' => 'area',
            ],

            // 'userdetail',
            [
                'name' => 'work',
                'ar' => 'عمل',
                'en' => 'work',
            ],
            [
                'name' => 'exchangepermission',
                'ar' => 'طلب صرف',
                'en' => 'exchange permission',
            ],

            [
                'name' => 'completepercentage',
                'ar' => 'نسبة الانجاز',
                'en' => 'complete percentage',
            ],
        ];

        foreach ($lists as $item) {
            try {
                $indexPermission = Permission::create([
                    'name' => "index-" . $item['name'],
                    'display_name' => [
                        'ar' => "عرض " . $item['ar'],
                        'en' => "index " . $item['en'],
                    ],
                ]);
                $ownerRole->attachPermissions([$indexPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $createPermission = Permission::create([
                    'name' => "create-" . $item['name'],
                    'display_name' => [
                        'ar' => "اضافة " . $item['ar'],
                        'en' => "create " . $item['en'],
                    ],
                ]);
                $ownerRole->attachPermissions([$createPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $editPermission = Permission::create([
                    'name' => "edit-" . $item['name'],
                    'display_name' => [
                        'ar' => "تعديل " . $item['ar'],
                        'en' => "edit " . $item['en'],
                    ],
                ]);
                $ownerRole->attachPermissions([$editPermission]);
            } catch (\Throwable $th) {
            }

            try {
                $deletePermission = Permission::create([
                    'name' => "delete-" . $item['name'],
                    'display_name' => [
                        'ar' => "حذف " . $item['ar'],
                        'en' => "delete " . $item['en'],
                    ],
                ]);
                $ownerRole->attachPermissions([$deletePermission]);
            } catch (\Throwable $th) {
            }

            try {
                $restorePermission = Permission::create([
                    'name' => "restore-" . $item['name'],
                    'display_name' => [
                        'ar' => "ارجاع " . $item['ar'],
                        'en' => "restore " . $item['en'],
                    ],
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
            [
                'name' => 'show-user',
                'ar' => 'عرض المستخدم',
                'en' => 'show user',
            ],
            [
                'name' => 'show-task',
                'ar' => 'عرض التاسك',
                'en' => 'show task',
            ],
            [
                'name' => 'show-branch',
                'ar' => 'عرض الفرع',
                'en' => 'show branch',
            ],
            [
                'name' => 'show-company',
                'ar' => 'عرض الشركة',
                'en' => 'show company',
            ],

            [
                'name' => 'index-permission',
                'ar' => 'عرض الصلاحيات',
                'en' => 'index permission',
            ],
            [
                'name' => 'create-permission',
                'ar' => 'اضافة صلاحيات',
                'en' => 'create permission',
            ],
            [
                'name' => 'edit-permission',
                'ar' => 'تعديل صلاحيات',
                'en' => 'edit permission',
            ],
            [
                'name' => 'delete-permission',
                'ar' => 'حذف صلاحيات',
                'en' => 'delete permission',
            ],

            [
                'name' => 'index-report',
                'ar' => 'التقارير',
                'en' => 'index report',
            ],
        ];

        foreach ($customPermissions as $customPermission) {
            $permission = Permission::where('name', $customPermission['name'])->latest()->first();

            if (!$permission) {
                $permission = Permission::create([
                    'name' => $customPermission['name'],
                    // 'display_name' => str_replace(['_', '-'], [' ', ' '], $customPermission),
                    'display_name' => [
                        'ar' => $customPermission['ar'],
                        'en' => $customPermission['en'],
                    ],

                ]);

                $ownerRole->attachPermissions([$permission]);
            }
        }

        $managerRole = Role::where('name', 'manager')->first();

        if (!$managerRole)
            $managerRole = Role::create([
                'name' => 'manager',
                'display_name' => [
                    'ar' => 'مدير',
                    'en' => 'Manager',
                ],
                'description' => [
                    'ar' => 'صلاحية المدراء في النظام',
                    'en' => 'managers role in the system',
                ],
            ]);

        $employeeRole = Role::where('name', 'employee')->first();

        if (!$employeeRole)
            $employeeRole = Role::create([
                'name' => 'employee',
                'display_name' => [
                    'ar' => 'موظف',
                    'en' => 'Employee',
                ],
                'description' => [
                    'ar' => 'صلاحية الموظفين في النظام',
                    'en' => 'employee role in the system',
                ],
            ]);


        $employeeRole = Role::where('name', 'financial')->first();

        if (!$employeeRole)
            $employeeRole = Role::create([
                'name' => 'financial',
                'display_name' => [
                    'ar' => 'المدير المالي',
                    'en' => 'Financial Director',
                ],
                'description' => [
                    'ar' => 'صلاحية المدير المالي في النظام',
                    'en' => 'Financial Director role in the system',
                ],
            ]);
        $employeeRole = Role::where('name', 'technical')->first();

        if (!$employeeRole)
            $employeeRole = Role::create([
                'name' => 'technical',
                'display_name' => [
                    'ar' => 'المدير الفني',
                    'en' => 'Technical Director',
                ],
                'description' => [
                    'ar' => 'صلاحية المدير الفني في النظام',
                    'en' => 'Technical Director role in the system',
                ],
            ]);
    }
}
