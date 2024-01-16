<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('items')->insert([
                'name' => $faker->userName,
                'content' => $faker->text,
                'image' => 'image.jpg',
                'price' => rand(50,1000),
                'status' => 1,
                'create_date' => $faker->dateTimeBetween('2023-11-01', '2023-12-01'),
                'begin_date' => $faker->dateTimeBetween('2023-11-01', '2023-12-01'),
                'end_date' => $faker->dateTimeBetween('+1 day', '+1 week'),
                'view' => rand(1,10000),
                'user_id' => rand(1,100),
                'category_id' => rand(1,10),
            ]);
        }
    }
}
