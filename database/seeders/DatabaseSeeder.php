<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin VisitBatu',
            'email' => 'nopal.r.octa@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('NaOH_27101510'),
        ]);

        $this->call([
            CategorySeeder::class,
            TripSeeder::class,
        ]);
    }
}
