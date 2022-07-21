<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $admin_role = Role::create([
            'name' => 'Super Admin',
        ]);
        $writer_role = Role::create([
            'name' => 'writer',
        ]);
        $manager_role = Role::create([
            'name' => 'manager',
        ]);
        $groups     = ['Product', 'Customer', 'Category', 'Employee', 'Interface', 'Notifi', 'Role', 'Supplier'];
        $actions    = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                $permission = Permission::create([
                    'name' => $group . ' ' . $action,

                ]);
            }
        }
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $manager->assignRole($manager_role);
        $admin_role->givePermissionTo(Permission::all());
        $category = Category::create([
            'nameVi' => 'Cơm',
            'nameEn' => 'Rice',
            'updated_by' => Carbon::now(),
        ]);
        $category = Category::create([
            'nameVi' => 'Thịt',
            'nameEn' => 'Meat',
            'updated_by' => Carbon::now(),
        ]);
        $category = Category::create([
            'nameVi' => 'Cá',
            'nameEn' => 'Fish',
            'updated_by' => Carbon::now(),
        ]);
        $category = Category::create([
            'nameVi' => 'Rau củ',
            'nameEn' => 'Vegetable',
            'updated_by' => Carbon::now(),
        ]);
    }
}
