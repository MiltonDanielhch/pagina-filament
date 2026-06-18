<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'history',
        'mission',
        'vision',
        'objectives',
        'image',
    ];
}
