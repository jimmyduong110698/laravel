<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Faker;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('user_info')->insert([
                'level' => 'Normal',
                'content' => $faker->text,
                'nick_name' => $faker->userName,
                'level' => rand(1,3),
                'location' => 'VN',
                'gender' => rand(1,2),
                'avatar' => 'avatar.png',
                'credit_points' => rand(50,100),
                'create_date' => $faker->dateTimeBetween('- 1 years', '-1 months'),
            ]);
        };
    }
}
