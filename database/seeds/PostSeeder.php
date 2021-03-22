<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
           'title' =>  'This is post 1 title',
            'description' => 'This is post 1 description',
            'featurePath' => 'post-noimage.jpg',
            'user_id' => 1,
            'status' => 1
        ]);
    }
}
