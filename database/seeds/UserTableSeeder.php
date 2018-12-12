<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_normal = Role::where('name', 'normal_user')->first();
    	$role_manager  = Role::where('name', 'admin')->first();
    	$employee = new User();
    	$employee->name = 'Mr Smith';
    	$employee->email = 'employee@example.com';
    	$employee->password = bcrypt('secret');
    	$employee->save();
    	$employee->roles()->attach($role_normal);

    	$manager = new User();
    	$manager->name = 'Admin';
    	$manager->email = 'admin@admin.com';
    	$manager->password = bcrypt('Passw@rd1');
    	$manager->save();
    	$manager->roles()->attach($role_manager);
    }
}
