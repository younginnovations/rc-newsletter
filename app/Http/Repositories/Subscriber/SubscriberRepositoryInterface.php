<?php namespace App\Http\Repositories\Subscriber;

use App\Http\Models\Subscriber;

/**
 * Interface SubscriberRepositoryInterface
 */
interface SubscriberRepositoryInterface
{
    /**
     * Returns subscribers
     * @return mixed
     */
    public function all();

    /**
     * Returns 50 subscribers
     * @return mixed
     */
    public function paginate();

    /**
     * Creates subscriber instance
     *
     * @param $data
     *
     * @return Subscriber
     */
    public function create($data);

    /**
     * Returns the subscriber matching the email and token param
     *
     * @param        $email
     * @param string $token
     *
     * @return mixed
     */
    public function find($email, $token = null);
}
