<?php

/**
 * Generates random token
 *
 * @param $email
 *
 * @return string
 */
function generateToken($email)
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
function isAllSelected($name, $list)
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
function isTokenValid($email, $token)
{
    try {
        $subscriber = new \App\Http\Services\SubscriberService();
        $res = $subscriber->getSubscriberWithEmailToken($email, $token);
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
function getSubscribedCountry($subscriber)
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
function getSubscribedCorporateGroup($subscriber)
{
    return $subscriber->group->corporate_group;
}