<?php namespace App\Http\Services;

/**
 * Class SiteService
 * @package App\Http\Services\SiteService
 */
class SiteService
{
    /**
     * Get Env value;
     *
     * @param $env
     *
     * @return null|string
     *
     */
    public function getEnv($env)
    {
        return trim(env($env, null));
    }

    /**
     * Get Admin Api Url.
     *
     * @return string
     */
    public function adminApiUrl()
    {
        return trim($this->getEnv('ADMIN_API_URL'), '/');
    }

    /**
     * Get RC Api Url
     *
     * @return string
     */
    public function rcApiUrl()
    {
        return trim($this->getEnv('ES_API'), '/');
    }

}
