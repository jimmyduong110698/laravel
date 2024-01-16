<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Faker;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 1000;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('bids')->insert([
                'price' => rand(1,1000),
                'status' => rand(1,3),
                'item_id' => rand(1,100),
                'user_id' => rand(1,100),
                'create_date' => $faker->dateTimeBetween('-1 week', '-1 day')
            ]);
        };
    }
}
