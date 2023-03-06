<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin1 = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone' => '9090653356',
            'gender_id' => 1,
            'password' => '$2a$12$9Aoav7u7YHAbXY955CQE2uImhKxiELBetcpGDnlfwGHdxwKCzSVxa' //bbbbbbbb
        ]);

        $admin2 = Admin::create([
            'name' => ' Admin 2',
            'email' => 'susheelkrsingh306@gmail.com',
            'phone' => '9090653355',
            'gender_id' => 1,
            'password' => '$2a$12$9Aoav7u7YHAbXY955CQE2uImhKxiELBetcpGDnlfwGHdxwKCzSVxa' //bbbbbbbb
        ]);

        // $admin3 = Admin::create([
        //     'name' => ' Admin 3',
        //     'email' => 'admin3@gmail.com',
        //     'phone' => '9090653354',
        //     'gender_id' => 1,
        //     'password' => '$2a$12$9Aoav7u7YHAbXY955CQE2uImhKxiELBetcpGDnlfwGHdxwKCzSVxa' //bbbbbbbb
        // ]);

        // $super_admin = Role::create(['guard_name' => 'admin','name' => 'super_admin']);
        // $crm = Role::create(['guard_name' => 'admin','name' => 'crm']);
        // $finance = Role::create(['guard_name' => 'admin','name' => 'finance']);
        // $doctor_manager = Role::create(['guard_name' => 'admin','name' => 'doctor_manager']);
        
        // $namage_finance = Permission::create(['guard_name' => 'admin', 'name' => 'Manage Finance']);
        // $manage_crm = Permission::create(['guard_name' => 'admin', 'name' => 'Manage Customer Data']);
        // $verify_doctor = Permission::create(['guard_name' => 'admin', 'name' => 'Verify Doctor']);
        
        // $admin1->assignRole($super_admin);
        // $admin2->assignRole($crm);
        // $admin3->assignRole($finance);

        // $super_admin->givePermissionTo([ $namage_finance, $manage_crm, $verify_doctor]);
        // $crm->givePermissionTo([ $manage_crm]);
        // $finance->givePermissionTo([ $namage_finance]);
        // $doctor_manager->givePermissionTo([ $verify_doctor]);
    }
}
