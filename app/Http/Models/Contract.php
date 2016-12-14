<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sent_email
 */
class Contract extends Model
{
    protected $casts = ['metadata' => 'object'];

    protected $fillable = [
        'contract_id',
        'metadata',
        'sent_email',
        'sent_email_date'
    ];

    public function sent_email()
    {
        $sent_email = $this->sent_email;
        if ($sent_email) {
            return "<i style='color: #59d05e;'>Sent</i>";
        } else {
            return "<i style='color: #ff5f5f;'>Not Sent</i>";
        }
    }
}
