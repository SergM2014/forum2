<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Category::class, 10)->create();
        factory(App\Category::class, 20)->states('parentId')->create();
    }
}
