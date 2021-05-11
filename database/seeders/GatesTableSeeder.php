<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gates')->insert([
            [
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '0'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        	[
            	'gate_in' => '1',
        		'gate_out' => '1'
        	],
        ]);
    }
}
