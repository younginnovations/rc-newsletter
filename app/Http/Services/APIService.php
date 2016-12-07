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

    public function countries()
    {
        $endpoint = '/contract/countries';
        return $this->getFromRcApi($endpoint)->results;
    }

    public function corporate_group()
    {
        $endpoint = '/contract/attributes';
        return $this->getFromRcApi($endpoint)->corporate_grouping;
    }

    public function getFromRcApi($endpoint)
    {
        $baseUrl = $this->site->rcApiUrl();
        try {
            $client      = new Client(['base_url' => $baseUrl]);
            $request = $client->get($baseUrl.$endpoint);
            $data = json_decode($request->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

}
