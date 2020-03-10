<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoldToday extends Model
{
    protected $table = 'gold_today';

    protected $fillable = [
        'type',
        'buy',
        'sell',
    ];
}
