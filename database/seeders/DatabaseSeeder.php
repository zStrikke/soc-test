<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // ADMINISTRATOR
        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator User',
            'email' => 'administrator@example.com',
            'type' => 'Administrator',
        ]);

        $user->profile()->create([
            'start_date' => '2023-07-18',
        ]);

        // JUDGE
        $user = \App\Models\User::factory()->create([
            'name' => 'Judge User',
            'email' => 'judge@example.com',
            'type' => 'Judge',
        ]);

        $user->profile()->create([
            'judge_id' => (string) Str::uuid(),
        ]);

        // PARTICIPANT
        $user = \App\Models\User::factory()->create([
            'name' => 'Participant User',
            'email' => 'participant@example.com',
            'type' => 'Participant',
        ]);

        $user->profile()->create([
            'birth_date' => '2023-07-18',
        ]);

        // JOURNALIST
        $user = \App\Models\User::factory()->create([
            'name' => 'Journalist User',
            'email' => 'journalist@example.com',
            'type' => 'Journalist',
        ]);

        $user->profile()->create([
            'company_name' => 'MARCA',
        ]);
    }
}
