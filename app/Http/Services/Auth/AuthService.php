<?php namespace App\Http\Services\Auth;

use App\Http\Services\SiteService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

/**
 * Class AuthService
 * @package App\Http\Services
 */
Class AuthService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     * @param SiteService $auth
     */
    public function __construct(Client $client, SiteService $auth)
    {
        $this->client = $client;
        $this->auth   = $auth;
    }

    /**
     * Login a user
     *
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public function login($username, $password)
    {
        $baseUrl = $this->auth->adminApiUrl();
        try {
            $client      = new Client(['base_url' => $baseUrl]);

            $request = $client->post($baseUrl.'/api/login', [
                'json' => [
                    'username' => $username,
                    'password' => $password
                ],
            ]);
            $data = json_decode($request->getBody()->getContents());
            if ($data->status == 'success') {
                $this->setAuth($data);

                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Logged out user
     */
    public function logout()
    {
        Session::forget('user_auth');
    }

    /**
     * Check if user logged in or not
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        if (Session::has('user_auth')) {
            return true;
        }

        return false;
    }

    /**
     * Check for Guest User
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->isLoggedIn();
    }

    /**
     * Set Auth
     *
     * @param $userData
     */
    protected function setAuth($userData)
    {
        session(['user_auth' => $userData->message]);
    }

    /**
     * Get User Data
     *
     * @return Session
     */
    public function user()
    {
        return session('user_auth');
    }
}
