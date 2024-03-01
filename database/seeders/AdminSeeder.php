<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $admin = new Admin();
        $admin->name = $faker->name;
        $admin->email = $faker->email;
        $admin->password = $faker->password;
        $res = $admin->save();
    }
}
