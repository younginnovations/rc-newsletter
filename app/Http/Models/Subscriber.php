<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed status
 */
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

    public function country()
    {
        $country_code = $this->group->country;
        $config = config('country');
        $country = [];
        foreach ($country_code as $code) {
            if (isset($config[$code])) {
                $country[$code] = $config[$code];
            } else {
                $country[$code] = $code;
            }
        }
        return $country;
    }

    public function source()
    {
        $code = strtoupper($this->source);

        $config = config('source');
        if (isset($config[$code])) {
            return $config[$code];
        }
        return $code;
    }

    public function status()
    {
        $status = $this->status;

        if ($status) {
            return "Confirmed";
        } else {
            return "<i style='color:#ff5f5f'>Not confirmed</i>";
        }
    }
}
