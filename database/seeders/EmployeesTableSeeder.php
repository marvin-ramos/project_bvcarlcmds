<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
	        [
	    		'firstname' => 'Marvin',
	            'middlename' => 'M',
	            'lastname' => 'Ramos',
	            'gender_id' => '1',
	            'age' => '25',
	            'birthday' => '1996-02-01',
	            'contact_number' => '09051344494',
	            'status_id' => '1',
	            'address' => 'General Santos City',
	            'profile' => 'images/employee/sample.jpg'
	        ],[
	            'firstname' => 'Marianne',
	            'middlename' => 'M',
	            'lastname' => 'Ramos',
	            'gender_id' => '2',
	            'age' => '21',
	            'birthday' => '1996-04-01',
	            'contact_number' => '09261123227',
	            'status_id' => '1',
	            'address' => 'General Santos City',
	            'profile' => 'images/employee/sample.jpg'
	        ],[
	            'firstname' => 'Wendilyn',
	            'middlename' => 'M',
	            'lastname' => 'Ramos',
	            'gender_id' => '2',
	            'age' => '18',
	            'birthday' => '1996-04-01',
	            'contact_number' => '09261543222',
	            'status_id' => '1',
	            'address' => 'General Santos City',
	            'profile' => 'images/employee/sample.jpg'
	        ],
		]);
    }
}
