<?php

use Illuminate\Database\Seeder;


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
    		'contact_number' => 1,
    		'email' => 'admin@email.com',
    		'password' => bcrypt('password'),
    		'user_type' => 'admin',
    	]);
    }
}
