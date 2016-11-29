<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PublishedContract extends Model
{
    protected $casts = ['metadata' => 'object'];

    protected $fillable = [
        'contract_id',
        'metadata'
    ];
}
