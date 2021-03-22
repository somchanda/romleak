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
            'id' =>'1',
            'category' => 'Uncategorized',
            'slug' =>'uncategorized',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
           'category'=>'Technology',
            'slug'=>'technology',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'category'=>'Sport',
            'slug'=>'sport',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'category'=>'Life',
            'slug'=>'life',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'category'=>'social',
            'slug'=>'social',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'category'=>'komsan',
            'slug'=>'komsan',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'category'=>'entertainment',
            'slug'=>'entertainment',
            'user_id' => 1
        ]);
    }
}
