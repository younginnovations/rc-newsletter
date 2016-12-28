<?php namespace App\Http\Services;

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
     * Get full Url of Api
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
     * Get countries list from RC Api
     * @return mixed
     */
    public function countries()
    {
        $endpoint = '/contract/countries';
        return $this->callApi($endpoint)->results;
    }

    /**
     * Get corporate group list from RC Api
     * @return mixed
     */
    public function corporate_group()
    {
        $endpoint = '/contract/attributes';
        $corporate_group = $this->callApi($endpoint)->corporate_grouping;
        asort($corporate_group);

        return $corporate_group;
    }

    /**
     * Returns country list
     * @return array
     */
    public function getCountryList()
    {
        $countries_config = config('country');
        $countries_api    = $this->countries();
        $countries        = [];

        foreach ($countries_api as $country_api) {
            $countries[strtoupper($country_api->code)] = $countries_config[strtoupper($country_api->code)];
        }

        asort($countries);
        return $countries;
    }

    /**
     * Get data from RC Api
     *
     * @param $endpoint
     *
     * @return bool|mixed
     */
    public function callApi($endpoint)
    {
        $baseUrl = $this->site->apiUrl();
        try {
            $client  = new Client(['base_url' => $baseUrl]);
            $request = $client->get($baseUrl.$endpoint);
            $data    = json_decode($request->getBody()->getContents());

            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }
}
