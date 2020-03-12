<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'keyword',
        'description',
        'origin',
        'link_md5'
    ];
}
