<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';

    protected $fillable = [
        'name',
        'slug'
    ];
}
