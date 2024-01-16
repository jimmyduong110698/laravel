<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Admin\UsersSeeder;
use Database\Seeders\Admin\UserInfoSeeder;
use Database\Seeders\Admin\WithdrawSeeder;
use Database\Seeders\Admin\RechargeSeeder;
use Database\Seeders\Admin\CategorySeeder;
use Database\Seeders\Admin\ItemSeeder;
use Database\Seeders\Admin\FollowSeeder;
use Database\Seeders\Admin\CommentSeeder;
use Database\Seeders\Admin\BidSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UsersSeeder::class,
            // UserInfoSeeder::class,
            CategorySeeder::class,
            // ItemSeeder::class,
            // FollowSeeder::class,
            // CommentSeeder::class,
            // BidSeeder::class,
        ]);
    }
}
