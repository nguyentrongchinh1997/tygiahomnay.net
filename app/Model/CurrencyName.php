<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrencyName extends Model
{
    protected $table = 'currency_name';

    protected $fillable = [
        'name',
        'currency_code',
        'image',
    ];

    public function exchangeRate()
    {
        return $this->hasMany(ExchangeRate::class);
    }
}
