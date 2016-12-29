<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting Model
 */
class Setting extends Model
{
    /**
     * @array fillable
     */
    protected $fillable = [
        'key',
        'value'
    ];
}
