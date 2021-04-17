<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	

    	//reset roles table 
        //DB::table("roles")->truncate();
    	DB::table('roles')->delete();

		//create admin role
		$admin = new Role;             //creating role using role model
		$admin->name = "admin";
		$admin->display_name = "Administrator";
		$admin->save();

		//create editor role
		$staff = new Role;            //creating role using role model
		$staff->name = "staff";
		$staff->display_name = "Staff";
		$staff->save();

		//attach roles to users

		//first user as admin
		$user1 = User::find('1');   //get user where id is 1
		$user1->detachRole($admin); //detach role so that we wont get duplicate entry error if we run seeder again
		$user1->attachRole($admin); //attaching role here

		//second user as editor
		$user2 = User::find('2'); //get user where id is 2
		$user2->detachRole($staff); //detach role so that we wont get duplicate entry error if we run seeder again
		$user2->attachRole($staff);//attaching role here

		//third user as author
		$user3 = User::find('3'); //get user where id is 3
		$user3->detachRole($staff); //detach role so that we wont get duplicate entry error if we run seeder again
		$user3->attachRole($staff); //attaching role here
    }
}