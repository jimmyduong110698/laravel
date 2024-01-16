<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker,DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->email,
                'password' => bcrypt('12345678'),
                'level' => 3,
                'full_name' => $faker->name,
                'phone' => '0938123123',
                'citizen_id' => '079001123123',
                'date_of_birth' => $faker->dateTimeBetween('1960-01-01', '2005-12-31'),
                'addresss' => $faker->address,
                'points' => rand(10,1000),
                'status' => rand(1,2)
            ]);
        }
    }
}
