<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function goldDetail()
    {
    	return $this->hasMany(GoldDetail::class);
    }
}
