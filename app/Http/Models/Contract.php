<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract Model
 */
class Contract extends Model
{
    /**
     * @array casts
     */
    protected $casts = ['metadata' => 'object'];

    /**
     * @array fillable
     */
    protected $fillable = [
        'contract_id',
        'metadata',
        'sent_email',
        'sent_email_date'
    ];

    /**
     * Checks if email is sent and returns text with their color accordingly
     * @return string
     */
    public function sent_email()
    {
        $sent_email = $this->sent_email;

        return $sent_email ? "Sent" : "Not Sent";
    }
}
