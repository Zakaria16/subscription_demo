<?php

namespace Database\Seeders;

use App\Models\Website;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Let's truncate our existing records to start from scratch.
        Website::truncate();

        $faker = Factory::create();
        // And now, let's create a few Subscriptions in our database:
        for ($i = 0; $i < 5; $i++) {
            Website::create([
                'url' => $faker->url
            ]);
        }

    }
}
