<?php
namespace App\Http\Services;

use GuzzleHttp\Client;

/**
 * Class APIService
 * @package App\Http\Services
 */
class APIService
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var SiteService
     */
    private $site;

    /**
     * @param Client      $client
     * @param SiteService $site
     */
    public function __construct(Client $client, SiteService $site)
    {
        $this->client = $client;
        $this->site   = $site;
    }

    /**
     * Get Api full URL
     *
     * @param $request
     *
     * @return string
     */
    public function apiURL($request)
    {
        $host    = trim(site()->esUrl(), '/');
        $request = trim($request, '/');

        return sprintf('%s/%s', $host, $request);
    }

    /**
     * Get Summary
     *
     * @return object|null
     */
    public function summary()
    {
        $resource = 'contracts/summary';

        return $this->apiCall($resource);
    }


}
