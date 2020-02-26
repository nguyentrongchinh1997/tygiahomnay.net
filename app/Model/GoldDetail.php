<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoldDetail extends Model
{
   	protected $table = 'gold_details';

    protected $fillable = [
        'city',
        'type',
        'buy',
        'sell',
        'gold_id',
        'date',
        'updated_at',
        'created_at',
    ];

    public function gold()
    {
    	return $this->belongsTo(Gold::class);
    }
}
