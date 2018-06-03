<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             MembersTableSeeder::class,
             CategoriesTableSeeder::class,
             TopicsTableSeeder::class,
             ResponseTableSeeder::class,
             LikesTableSeeder::class,

             ]);
    }
}
