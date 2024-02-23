<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ships')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Ship::create([
            'name' => 'express delivery',
            'descripttion' => "This method allows goods to be shipped from the sender to the recipient's address in a short time, usually within 24 hours.",
            'fee' => '70000',
            'create_by' => 1,
        ]);

        Ship::create([
            'name' => 'overnight delivery',
            'descripttion' => "This method allows goods to be shipped from the sender to the recipient's address within one night.",
            'fee' => '100000',
            'create_by' => 1,
        ]);

        Ship::create([
            'name' => 'air freight',
            'descripttion' => "This method uses aircraft to transport goods between locations, often used for items that need to be transported quickly and important.",
            'fee' => '120000',
            'create_by' => 1,
        ]);

        Ship::create([
            'name' => 'sea freight',
            'descripttion' => "This method uses ships to transport goods between locations, often used for large and time-critical items.",
            'fee' => '120000',
            'create_by' => 1,
        ]);
    }
}
