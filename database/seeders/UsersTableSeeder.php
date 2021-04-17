<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'employee_id' => '1',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role_name' => 'Administrator'
            ],[
                'employee_id' => '2',
                'email' => 'staff1@staff.com',
                'password' => Hash::make('staff'),
                'role_name' => 'Staff'
            ],[
                'employee_id' => '3',
                'email' => 'staff2@staff.com',
                'password' => Hash::make('staff'),
                'role_name' => 'Staff'
            ]
        ]);
    }
}
