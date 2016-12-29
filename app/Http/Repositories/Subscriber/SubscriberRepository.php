<?php namespace App\Http\Repositories\Subscriber;

use App\Http\Models\Subscriber;

/**
 * Class SubscriberRepository
 * @property SubscriberRepositoryInterface subscriber
 */
class SubscriberRepository implements SubscriberRepositoryInterface
{
    /**
     * SubscriberRepository constructor.
     *
     * @param Subscriber $subscriber
     */
    public function __construct(Subscriber $subscriber)
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
     * @return Subscriber
     */
    public function create($data)
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
    public function find($email, $token = null)
    {
        if (is_null($token)) {
            return $this->subscriber->whereRaw("email = ?", [$email])->first();
        }

        return $this->subscriber->whereRaw("email = ?", [$email])
                         ->whereRaw("token = ?", [$token])
                         ->first();
    }
}
