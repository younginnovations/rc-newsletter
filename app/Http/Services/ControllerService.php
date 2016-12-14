<?php namespace App\Http\Services;

use App\Services\ConfirmationService;

/**
 * Class ControllerService
 * @package App\Http\Services
 */
Class ControllerService
{
    public function __construct(ConfirmationService $confirm, SubscriberService $subscriber)
    {
        $this->confirm    = $confirm;
        $this->subscriber = $subscriber;
    }

    public function validate()
    {

    }

    /**
     * Generates random token
     *
     * @param $email
     *
     * @return string
     */
    public function generateToken($email)
    {
        return md5(microtime().$email);
    }

    /**
     * Checks if checkbox named all is selected
     *
     * @param $name
     * @param $list
     *
     * @return array
     */
    public function isAllSelected($name, $list)
    {
        if ($name) {
            return ["ALL"];
        } else {
            $list = ($list == "") ? ["ALL"] : $list;

            return $list;
        }
    }

    /**
     * Checks if token is valid
     *
     * @param $email
     * @param $token
     *
     * @return bool
     */
    public function isTokenValid($email, $token)
    {
        try {
            $res = $this->subscriber->getSubscriberWithEmailToken($email, $token);
            return $res;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Returns subscribed countries
     *
     * @param $subscriber
     *
     * @return mixed
     */
    public function getSubscribedCountry($subscriber)
    {
        return $subscriber->group->country;
    }

    /**
     * Returns subscribed corporate group
     *
     * @param $subscriber
     *
     * @return mixed
     */
    public function getSubscribedCorporateGroup($subscriber)
    {
        return $subscriber->group->corporate_group;
    }
}
