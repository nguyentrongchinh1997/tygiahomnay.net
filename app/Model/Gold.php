<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gold extends Model
{
    protected $table = 'golds';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function goldDetail()
    {
    	return $this->hasMany(Golđetail::class);
    }
}
