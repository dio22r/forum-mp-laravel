<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');
        for ($i = 1; $i <= 20; $i++) {
            DB::table('mh_forum_tag')->insert([
                'slug' => Str::slug($faker->sentence(2)),
                'title' => $faker->sentence(2),
                'description'    => $faker->paragraph,
                'created_by'    => rand(1, 15)
            ]);
        }
    }
}
