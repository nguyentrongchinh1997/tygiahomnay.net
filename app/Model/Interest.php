<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interests';

    protected $fillable = [
        'bank_id',
        'period_id',
        'type',
        'percent',
        'date',
    ];

    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }
}
