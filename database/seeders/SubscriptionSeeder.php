<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear data
        Subscription::truncate();
        $userCount = User::all()->count();
        $websiteCount = Website::all()->count();

        for ($i = 0; $i < 20; $i++) {

            Subscription::create([
                'userid' =>rand(1,$userCount),
                'web_id'=>rand(1,$websiteCount),
            ]);

        }
    }
}
