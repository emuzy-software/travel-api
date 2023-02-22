<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $timeTs = Carbon::now()->timestamp;
        User::query()->updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => 'nghia123',
            'email' => 'admin@gmail.com',
            'email_verified_at' => $timeTs,
            'is_active' => true,
        ]);
    }
}
