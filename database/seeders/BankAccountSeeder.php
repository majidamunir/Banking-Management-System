<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_accounts')->insert([
            ['account_name' => 'Bank Account', 'balance' => 15000.00],
//            ['account_name' => 'Checking Account', 'balance' => 5000.00],
        ]);
    }
}
