<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'section',
        'path',
        'ip_address',
        'user_agent',
    ];
}
