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
        DB::table('categories')->insert([
            'parent_id' => 0,
            'title' => 'category1',
            'eng_title' => 'category1'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 0,
            'title' => 'category2',
            'eng_title' => 'category3'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 0,
            'title' => 'category3',
            'eng_title' => 'category3'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 0,
            'title' => 'category4',
            'eng_title' => 'category4'
        ]);


        DB::table('categories')->insert([
            'parent_id' => 8,
            'title' => 'category5',
            'eng_title' => 'category5'
        ]);


        DB::table('categories')->insert([
            'parent_id' => 8,
            'title' => 'category6',
            'eng_title' => 'category6'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 2,
            'title' => 'category7',
            'eng_title' => 'category7'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 2,
            'title' => 'category8',
            'eng_title' => 'category8'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'category9',
            'eng_title' => 'category9'
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'category10',
            'eng_title' => 'category10'
        ]);
    }
}
