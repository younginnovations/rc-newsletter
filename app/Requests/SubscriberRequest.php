<?php namespace App\Requests;

class SubscriberRequest
{
    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'email'  => 'required|email|unique:subscribers',
            'source' => 'required',
        ];
    }
}
