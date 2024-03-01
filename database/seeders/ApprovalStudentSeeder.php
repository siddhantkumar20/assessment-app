<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ApprovalStudent;
use Faker\Factory as Faker;

class ApprovalStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $newStudent = new ApprovalStudent();
        $newStudent->name = $faker->name;
        $newStudent->email = $faker->email;
        $newStudent->address = $faker->address;
        $newStudent->cs = $faker->company;
        $newStudent->ps = $faker->company;
        $newStudent->parent = $faker->name;
        $newStudent->parentno = $faker->phoneNumber;
        $newStudent->password = $faker->password;
        $newStudent->save();
    }
}
