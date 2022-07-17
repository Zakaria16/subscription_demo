<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Post::truncate();

        $websiteCount = Website::all()->count();

        $faker = \Faker\Factory::create();
        // And now, let's create a few Subscriptions in our database:
        for ($i = 0; $i < 50; $i++) {
            Post::create([
                'web_id' => rand(1,$websiteCount),
                'title'=>$faker->text(100),
                'body'=>$faker->text(500)
            ]);
        }
    }
}
