<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = 8; // replace with actual admin ID if needed

        Destination::insert([
            [
                'name' => 'Cox’s Bazar',
                'location' => 'Chattogram',
                'description' => 'Longest sea beach in the world.',
                'category' => 'Beach',
                'image_url' => 'https://example.com/images/cox.jpg',
                'latitude' => 21.4272,
                'longitude' => 92.0058,
                'created_by' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sundarbans',
                'location' => 'Khulna',
                'description' => 'Largest mangrove forest in the world.',
                'category' => 'Forest',
                'image_url' => 'https://example.com/images/sundarbans.jpg',
                'latitude' => 21.9497,
                'longitude' => 89.1833,
                'created_by' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more...
            // [
            //     'name' => 'Sundarbans',
            //     'location' => 'Khulna',
            //     'description' => 'Largest mangrove forest in the world.',
            //     'category' => 'Forest',
            //     'image_url' => 'https://example.com/images/sundarbans.jpg',
            //     'latitude' => 21.9497,
            //     'longitude' => 89.1833,
            //     'created_by' => $adminId,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
