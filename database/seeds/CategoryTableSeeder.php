<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
           'category'=>'Technology',
            'slug'=>'technology'
        ]);

        DB::table('categories')->insert([
            'category'=>'Sport',
            'slug'=>'sport'
        ]);

        DB::table('categories')->insert([
            'category'=>'Life',
            'slug'=>'life'
        ]);

        DB::table('categories')->insert([
            'category'=>'social',
            'slug'=>'social'
        ]);

        DB::table('categories')->insert([
            'category'=>'komsan',
            'slug'=>'komsan'
        ]);

        DB::table('categories')->insert([
            'category'=>'entertainment',
            'slug'=>'entertainment'
        ]);
    }
}
