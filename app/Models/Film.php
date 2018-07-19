<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'genre',
        'photo'
    ];
}
