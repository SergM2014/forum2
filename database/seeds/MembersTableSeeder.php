<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name' => 'member1',
            'email' => 'member1@member1.member1',
            'password' => bcrypt('member1'),
            'remember_token' => str_random(10),
        ]);
        DB::table('members')->insert([
            'name' => 'member2',
            'email' => 'member2@member2.member2',
            'password' => bcrypt('member2'),
            'remember_token' => str_random(10),
        ]);

        DB::table('members')->insert([
            'name' => 'member3',
            'email' => 'member3@member3.member3',
            'password' => bcrypt('member3'),
            'remember_token' => str_random(10),
        ]);
    }
}
