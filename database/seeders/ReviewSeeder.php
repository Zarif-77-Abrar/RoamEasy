<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Destination;


class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $touristUsers = User::role('tourist')->get();
        $destinations = Destination::all();

        foreach ($destinations as $destination) {
            foreach ($touristUsers->random(min(3, $touristUsers->count())) as $tourist) {
                Review::create([
                    'user_id'        => $tourist->id,
                    'destination_id' => $destination->id,
                    'rating'         => rand(1, 5),
                    'comment'        => 'Sample review for ' . $destination->name,
                ]);
            }
        }
    }
}

