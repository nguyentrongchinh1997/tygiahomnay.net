<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rate';

    protected $fillable = [
        'currency_name_id',
        'bank_id',
        'buy',
        'sell',
        'sell_transfer',
        'transfer',
        'timestamp',
        'date',
        'updated_at',
    ];

    public function currencyName()
    {
        return $this->belongsTo(CurrencyName::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
