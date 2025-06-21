<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // ✅ Create admin only if not exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]);
        }

        // Create 2 organizers if they don't already exist
        $organizer1 = User::firstOrCreate(
            ['email' => 'org1@example.com'],
            [
                'name' => 'Organizer One',
                'password' => bcrypt('password'),
                'role' => 'organizer'
            ]
        );

        $organizer2 = User::firstOrCreate(
            ['email' => 'org2@example.com'],
            [
                'name' => 'Organizer Two',
                'password' => bcrypt('password'),
                'role' => 'organizer'
            ]
        );

        // Create 2 participants
        User::firstOrCreate(
            ['email' => 'parta@example.com'],
            [
                'name' => 'Participant A',
                'password' => bcrypt('password'),
                'role' => 'participant'
            ]
        );

        User::firstOrCreate(
            ['email' => 'partb@example.com'],
            [
                'name' => 'Participant B',
                'password' => bcrypt('password'),
                'role' => 'participant'
            ]
        );

        // Create events
        Event::firstOrCreate(
            ['title' => 'Tech Talk 2025'],
            [
                'organizer_id' => $organizer1->id,
                'description' => 'Technology updates and networking.',
                'date' => now()->addDays(10),
                'location' => 'Phnom Penh Hall'
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Food Festival'],
            [
                'organizer_id' => $organizer2->id,
                'description' => 'Local food showcase.',
                'date' => now()->addDays(5),
                'location' => 'Siem Reap'
            ]
        );
    }
}
