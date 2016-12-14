<?php namespace App\Http\Services;

use App\Http\Models\Subscriber;

/**
 * Class SubscriberService
 * @package App\Http\Services
 */
Class SubscriberService
{
    /**
     * Returns subscribers
     * @return mixed
     */
    public function get()
    {
        return Subscriber::get();
    }
    /**
     * Returns subscriber
     */
    public function getSubscribers()
    {
        return Subscriber::paginate(50);
    }

    /**
     * Creates subscriber instance
     *
     * @param $data
     *
     * @return Subscriber
     */
    public function createSubscriber($data)
    {
        return Subscriber::create($data);
    }

    /**
     * Returns the subscriber matching the email param
     *
     * @param $email
     *
     * @return mixed
     */
    public function getSubscriber($email)
    {
        return Subscriber::whereRaw("email = ?", [$email])->first();
    }

    /**
     * Returns subscriber which matches given email and token params
     *
     * @param $email
     * @param $token
     */
    public function getSubscriberWithEmailToken($email, $token)
    {
        return Subscriber::whereRaw("email = ?", [$email])
                  ->whereRaw("token = ?", [$token])
                  ->first();
    }
}
