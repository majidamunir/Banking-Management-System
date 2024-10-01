<?php
//namespace App\Console\Commands;
//
//use Illuminate\Console\Command;
//use Illuminate\Support\Facades\Http;
//use App\Models\ExchangeRate;
//
//class FetchExchangeRates extends Command
//{
//    protected $signature = 'fetch:exchange-rates';
//    protected $description = 'Fetch exchange rates from an external API and update USD, PKR, and INR in the database';
//
//    public function __construct()
//    {
//        parent::__construct();
//    }
//
//    public function handle()
//    {
//        $apiKey = 'f702cc6e164cafdb0edd9a3c69b96cb7';
//        $apiUrl = "https://api.exchangeratesapi.io/v1/latest?access_key={$apiKey}";
//
//        $response = Http::get($apiUrl);
//        if ($response->failed()) {
//            return $this->error('Failed to fetch exchange rates.');
//        }
//
//        $data = $response->json();
//
//        if (isset($data['rates'])) {
//            $currencies = ['USD', 'PKR', 'INR'];
//
//            foreach ($currencies as $currency) {
//                if (isset($data['rates'][$currency])) {
//                    ExchangeRate::create([
//                        'currency_from' => 'EUR',
//                        'currency_to' => $currency,
//                        'rate' => $data['rates'][$currency],
//                        'date' => now()->format('Y-m-d'),
//                    ]);
//                }
//            }
//
//            $this->info('Exchange Rates Updated Successfully!!');
//        }
//        else {
//            $this->error('Invalid API response.');
//        }
//    }
//}


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class FetchExchangeRates extends Command
{
    protected $signature = 'fetch:exchange-rates';
    protected $description = 'Fetch exchange rates from an external API and update USD, PKR, and INR.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $apiKey = '82ba3bf70f1d639b90218c8379f118ac';
        $currencies = ['USD', 'PKR', 'INR'];
        $startDate = Carbon::create(null, 9, 1);
        $endDate = Carbon::now();

        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $apiUrl = "https://api.exchangeratesapi.io/v1/{$currentDate->format('Y-m-d')}?access_key={$apiKey}";

            $response = Http::get($apiUrl);
            if ($response->failed()) {
                $this->error("Failed to fetch exchange rates for {$currentDate->format('Y-m-d')}.");
                $currentDate->addDay();
                continue;
            }

            $data = $response->json();

            if (isset($data['rates'])) {
                foreach ($currencies as $currency) {
                    if (isset($data['rates'][$currency])) {
                        ExchangeRate::updateOrCreate(
                            [
                                'currency_from' => 'EUR',
                                'currency_to' => $currency,
                                'date' => $currentDate->format('Y-m-d')
                            ],
                            [
                                'rate' => $data['rates'][$currency],
                            ]
                        );
                    }
                }
            } else {
                $this->error("Invalid API response for {$currentDate->format('Y-m-d')}.");
            }

            $currentDate->addDay();
        }
        $this->info('Exchange Rates Updated Successfully.');
    }
}

