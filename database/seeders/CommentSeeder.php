<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');
        for ($i = 1; $i <= 500; $i++) {
            DB::table('th_forum_comment')->insert([
                'mh_forum_topic_id' => rand(1, 100),
                'comment' => $faker->paragraph,
                'created_at'    => $faker->dateTime(),
                'created_by'    => rand(1, 15)
            ]);
        }
    }
}
