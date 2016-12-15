<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed status
 * @property mixed email
 * @property mixed source
 * @property mixed group
 * @property mixed token
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

    /**
     * Returns country code
     * @return array
     */
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

    /**
     * Returns source's code
     * @return string
     */
    public function source()
    {
        $code = strtoupper($this->source);
        $config = config('source');

        if (isset($config[$code])) {
            return $config[$code];
        }

        return $code;
    }

    /**
     * Returns confirmation status
     * @return string
     */
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
