<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('payments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('payments')->insert([
            'name' => 'Credit card',
            'descripttion' => 'Customers use their credit card to pay for the order.',
        ]);
        DB::table('payments')->insert([
            'name' => 'Bank transfer',
            'descripttion' => 'The customer transfers money to your bank account.',
        ]);
        DB::table('payments')->insert([
            'name' => 'Cash on delivery (COD)',
            'descripttion' => 'Customers pay cash to the delivery person when receiving the order.',
        ]);
        DB::table('payments')->insert([
            'name' => 'E-wallet',
            'descripttion' => 'Customers use e-wallets like Momo, Zalo Pay to pay for orders.',
        ]);
    }
}
