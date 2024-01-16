<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('comment')->insert([
                'content' => $faker->text,
                'status' => rand(1,3),
                'user_id' => rand(1,100),
                'reviewer_id' => rand(1,100),
                'item_id' => rand(1,100),
            ]);
        }
    }
}
