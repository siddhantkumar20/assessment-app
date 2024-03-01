<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $newTeacher = new Teacher();
        $newTeacher->name = $faker->name;
        $newTeacher->email = $faker->email;
        $newTeacher->address = $faker->address;
        $newTeacher->cs = $faker->company;
        $newTeacher->ps = $faker->company;
        $newTeacher->experience = $faker->numberBetween($min = 1, $max = 10);
        $newTeacher->expertise = $faker->sentence($nbWords = 3, $variableNbWords = true);
        $newTeacher->password = $faker->password;
        $newTeacher->save();
    }
}
