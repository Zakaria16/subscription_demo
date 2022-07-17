<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // remove previous data
        User::truncate();

        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'=>$faker->userName,
                'password'=>bcrypt("default"),
                'email'=>$faker->email
            ]);
        }
    }
}
