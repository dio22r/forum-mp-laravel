<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');
        for ($i = 1; $i <= 100; $i++) {
            DB::table('mh_forum_topic')->insert([
                'slug' => Str::slug(substr($faker->sentence(15), 0, 49)),
                'title' => $faker->sentence(10),
                'mh_forum_tag_id' => rand(1, 15),
                'description'    => $faker->paragraph,
                'created_by'    => rand(1, 15)
            ]);
        }
    }
}
