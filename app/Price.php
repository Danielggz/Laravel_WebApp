<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'symbol', 
        'high',
        'low',
        'price'
    ];
}
