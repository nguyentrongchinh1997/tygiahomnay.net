<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';

    protected $fillable = [
        'name',
    ];

    public function exchangeRate()
    {
    	return $this->hasMany(ExchangeRate::class);
    }
}
