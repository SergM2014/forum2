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
           'name' => 'user',
           'email' => 'user@user.user',
           'role' => 'user',
           'password' => bcrypt('user'),
            'remember_token' => str_random(10),
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'role' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@superadmin.superadmin',
            'role' => 'superadmin',
            'password' => bcrypt('superadmin'),
            'remember_token' => str_random(10),
        ]);
    }
}
