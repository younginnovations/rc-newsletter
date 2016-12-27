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
    return sha1(microtime().$email);
}

/**
 * Checks if checkbox named all is selected and return value accordingly
 *
 * @param $all_country
 * @param $country
 *
 * @return array
 */
function isAllSelected($all_country, $country)
{
    if ($all_country || empty($country)) {
        return ["ALL"];
    }

    return $country;
}
