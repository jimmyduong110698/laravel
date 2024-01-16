<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 12;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('categories')->insert([
                'name' => $faker->domainWord,
                'image' => $faker->name,
            ]);
        }
    }
}
