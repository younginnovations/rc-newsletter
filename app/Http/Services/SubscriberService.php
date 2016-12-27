<?php namespace App\Http\Services;

use App\Http\Repositories\Subscriber\SubscriberRepositoryInterface;

/**
 * Class SubscriberService
 * @package App\Http\Services
 */
Class SubscriberService
{
    /**
     * SubscriberService constructor.
     *
     * @param SubscriberRepositoryInterface $subscriber
     */
    public function __construct(SubscriberRepositoryInterface $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Returns subscribers
     * @return mixed
     */
    public function all()
    {
        return $this->subscriber->all();
    }

    /**
     * Returns 50 subscribers
     */
    public function paginate()
    {
        return $this->subscriber->paginate();
    }

    /**
     * Creates subscriber instance
     *
     * @param $data
     *
     * @return mixed
     */
    public function createSubscriber($data)
    {
        return $this->subscriber->create($data);
    }

    /**
     * Returns subscriber which matches given email and token params
     *
     * @param $email
     * @param $token
     *
     * @return mixed
     */
    public function findSubscriber($email, $token)
    {
        return $this->subscriber->find($email, $token);
    }

    /**
     * Checks if token is valid
     *
     * @param $email
     * @param $token
     *
     * @return bool
     */
    function isTokenValid($email, $token)
    {
        try {
            $res = $this->findSubscriber($email, $token);
            return $res;
        } catch (\Exception $e) {
            return false;
        }
    }
}
