<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StageSeeder;
use Database\Seeders\SubjectTimeSeeder;
use Database\Seeders\CreateMAnagerseeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SubjectTimeSeeder::class);
        $this->call(CreateMAnagerseeder::class);
        $this->call(StageSeeder::class);
    }
}
