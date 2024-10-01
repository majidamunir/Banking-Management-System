<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionsExport implements FromCollection
{
    public function collection()
    {
        return Transaction::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Account ID',
            'Type',
            'Amount',
            'Date',
            'Status',
        ];
    }
}
