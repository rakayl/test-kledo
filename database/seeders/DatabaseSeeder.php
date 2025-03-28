<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statuses;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Statuses::create(
            [
                'name' => 'Menunggu Persetujuan'
            ]
        );
        Statuses::create(
            [
                'name' => 'Disetujui'
            ]
        );
    }
}
