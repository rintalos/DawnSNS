<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PostsTableSeeder::class);試しに作成してみた。
        DB::table('posts')->insert([
        [
        'id' => '1',
        'user_id' => '2',
        'posts' => 'これはテストです',
        ],
        [
        'id' => '2',
        'user_id' => '3',
        'posts' => 'とりあえず呟いています',
        ],
        [
        'id' => '3',
        'user_id' => '4',
        'posts' => '３番目にの呟き',
        ],


        ]);

    }
}
