<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class ExchangeRateController extends Controller
{
    public function index()
    {
        // Set startDate to September 1st, 2024
        $startDate = Carbon::parse('2024-09-01')->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        // Fetch exchange rates for USD, PKR, INR from September 1st onward
        $exchangeRates = ExchangeRate::whereBetween('date', [$startDate, $today])
            ->whereIn('currency_to', ['USD', 'PKR', 'INR'])
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        $dailyData = [];
        $currencies = ['USD', 'PKR', 'INR'];

        // Group the rates by date and currency
        foreach ($exchangeRates as $date => $rates) {
            foreach ($rates as $rate) {
                $dailyData[$date][$rate->currency_to] = $rate->rate;
            }
        }

        // Fill missing dates with zero rates
        $allDates = [];
        $currentDate = Carbon::parse($startDate);
        while ($currentDate <= Carbon::now()) {
            $allDates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        foreach ($allDates as $date) {
            if (!isset($dailyData[$date])) {
                $dailyData[$date] = array_fill_keys($currencies, 0);
            }
        }

        // Sort the data by date
        ksort($dailyData);

        return view('Admin.rates', [
            'dailyData' => $dailyData,
            'currencies' => $currencies,
        ]);
    }
}

