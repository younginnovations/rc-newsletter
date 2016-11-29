<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $casts = ['group' => 'object'];

    protected $fillable = [
        'email',
        'group',
        'token',
        'source',
        'status',
    ];
}
