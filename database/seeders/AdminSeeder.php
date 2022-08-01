<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use App\Models\RoleHaspermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'username' => 'Nguyễn Ngọc Dương',
            'address' => '38 Lý thường Kiệt',
            'gender' => true,
            'day_of_birth' => '2000/10/29',
            'start_day' => '2002/10/22',
            'province_id' => '30',
            'district_id' => '335',
            'ward_id' => '6090',
            'image' => '',
            'note' => 'good',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $writer = User::create([
            'name' => 'Huyền',
            'email' => 'ngochuyen@admin.com',
            'username' => 'Nguyễn Hoàng Ngọc Huyền ',
            'address' => '38 Lý thường Kiệt',
            'gender' => false,
            'day_of_birth' => '2001/10/29',
            'start_day' => '2022/02/02',
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'image' => '',
            'note' => 'good',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $manager = User::create([
            'name' => 'Hằng',
            'email' => 'ngochang@admin.com',
            'username' => 'Nguyễn Hoàng Ngọc Huyền ',
            'address' => '38 Lý thường Kiệt',
            'gender' => false,
            'day_of_birth' => '2001/10/29',
            'start_day' => '2022/02/02',
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'image' => '',
            'note' => 'good',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $employee = User::create([
            'name' => 'Thảo Trang',
            'email' => 'thaotrang@admin.com',
            'username' => 'Phan nguyễn Thảo Trang ',
            'address' => '38 Lý thường Kiệt',
            'gender' => false,
            'day_of_birth' => '2001/10/29',
            'start_day' => '2022/02/02',
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'image' => '',
            'note' => 'good',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $admin_role = Role::create([
            'name' => 'Super Admin',
        ]);
        $writer_role = Role::create([
            'name' => 'writer',
        ]);
        $manager_role = Role::create([
            'name' => 'manager',
        ]);
        $Employee_role = Role::create([
            'name' => 'employee',
        ]);
        $groups     = ['Product', 'Customer', 'Category', 'Employee', 'Role','Permission', 'Supplier'];
        $actions    = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                $permission = Permission::create([
                    'group_name' => $group,
                    'name' => $group . ' ' . $action,

                ]);
            }
        }
        $$permission = Permission::create([
            'group_name' => 'notification',
            'name' => 'Add_Notification',
        ]);

        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $manager->assignRole($manager_role);
        $employee->assignRole($Employee_role);
        $admin_role->givePermissionTo(Permission::all());
        $writer_role->givePermissionTo(Permission::where('group_name','Product')->orwhere('group_name','Category')->orwhere('group_name','Supplier')->orwhere('group_name','Notifi')->get());
        $manager_role->givePermissionTo(Permission::all());
        $Employee_role->givePermissionTo(Permission::where('group_name','Product')->orwhere('group_name','Category')->get());

    }
}
