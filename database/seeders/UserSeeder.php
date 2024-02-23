<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = User::create([
            'name' => 'Quang Anh',
            'age' => 22,
            'image' => 'no-image.png',
            'address' => '21/85 Phạm Ngũ Lão, TP Hải Dương, Tỉnh Hải Dương',
            'phone_number' => '0985962069',
            'email' => 'funkytown0601@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
        ]);
        $user->roles()->attach(1);
    }
}
