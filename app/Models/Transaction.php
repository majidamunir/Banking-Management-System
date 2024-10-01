<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//
//class Transaction extends Model
//{
//    use HasFactory;
//
//    protected $fillable = [
//        'account_id',
//        'transaction_type',
//        'amount',
//        'date',
//        'status',
//    ];
//
//    protected $dates = ['date'];
//
//    public function account(): BelongsTo
//    {
//        return $this->belongsTo(Account::class);
//    }
//}
//


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transaction_type',
        'amount',
        'date',
        'status',
        'target_account_id',
    ];

    protected $dates = ['date'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function targetAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'target_account_id');
    }
}
