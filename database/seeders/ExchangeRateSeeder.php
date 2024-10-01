<?php
namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2024, 8, 1);
        $endDate = Carbon::create(2024, 9, 16);

        while ($startDate <= $endDate) {
            foreach (['USD', 'PKR', 'INR'] as $currency) {
                ExchangeRate::factory()->create([
                    'date' => $startDate->format('Y-m-d'),
                    'currency_to' => $currency,
                ]);
            }
            $startDate->addDay();
        }
    }
}
