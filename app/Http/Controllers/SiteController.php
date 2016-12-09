<?php
namespace App\Http\Controllers;

use App\Http\Models\PublishedContract;
use App\Http\Services\APIService;
use Illuminate\Http\Request;
use App\Http\Models\Subscriber;
use App\Services\ConfirmationService;

/**
 * Class SiteController
 * @property APIService api
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    public function __construct(APIService $api)
    {
        $this->api = $api;
    }

    /**
     * Home Page
     *
     */
    public function home()
    {
        $groups = $this->api->corporate_group();
        asort($groups);

        $countries = $this->getCountryList();

        return view(
            'index',
            compact(
                'countries',
                'groups'
            )
        );
    }

    public function getCountryList()
    {
        $countries_config = config('country');
        $countries_api    = $this->api->countries();
        $countries        = [];
        foreach ($countries_api as $country_api) {
            $countries[strtoupper($country_api->code)] = $countries_config[strtoupper($country_api->code)];
        }
        asort($countries);

        return $countries;
    }

    public function subscribe(Request $request, ConfirmationService $confirm)
    {
        $data           = [];
        $data['email']  = $request->input('email');
        $data['token']  = $this->generateToken($data['email']);
        $data['source'] = $request->input('source');
        $data['status'] = 0;
        $data['group']  = [
            'country'         => $this->isAllSelected($request->input('all_country'), $request->input('country')),
            'corporate_group' => $this->isAllSelected(
                $request->input('all_corporate_group'),
                $request->input
                (
                    'corporate_group'
                )
            ),
        ];

        try {
            $subscriber = Subscriber::create($data);
            $confirm->sendConfirmationEmail($subscriber);

            return view('thanks');
        } catch (\Exception $e) {
            return redirect()->route('home')->withInput()->with('message', 'This email is already subscribed !');
        }
    }

    public function isAllSelected($name, $list)
    {
        if ($name) {
            return ["ALL"];
        } else {
            $list = ($list == "") ? [] : $list;

            return $list;
        }
    }

    public function isTokenValid($email, $token)
    {
        try {
            $res = Subscriber::where('email', $email)->where('token', $token)->firstOrFail();

            return $res;
        } catch (\Exception $e) {
            return false;
        }

    }


    public function confirm($email, $token)
    {
        if ($subscriber = $this->isTokenValid($email, $token)) {
            $subscriber->status = 1;
            $subscriber->token  = $this->generateToken($email);
            $subscriber->save();

            return view('confirm');
        } else {
            return view('invalid-token');
        }
    }

    public function generateToken($email)
    {
        return md5(microtime().$email);
    }

    public function publishPost(Request $request)
    {
        $data                = [];
        $data['contract_id'] = $request->input('contract_id');
        $data['metadata']    = $request->input('metadata');

        $published_contract = PublishedContract::whereRaw("contract_id = ?", [$data['contract_id']])->first();
        if (is_null($published_contract)) {
            try {
                PublishedContract::create($data);

                return 1;
            } catch (\Exception $e) {
                return 0;
            }
        } else {
            return 1;
        }

    }

    public function confirmUnsubscribe($email, $token)
    {
        $data          = [];
        $data['email'] = $email;
        $data['token'] = $token;
        if ($this->isTokenValid($data['email'], $data['token'])) {
            return view('confirm-unsubscribe', compact('email', 'token'));
        } else {
            return view('invalid-token');
        }
    }

    public function unsubscribe($email, $token)
    {
        $data          = [];
        $data['email'] = $email;
        $data['token'] = $token;
        if ($this->isTokenValid($data['email'], $data['token'])) {
            $subscriber = Subscriber::whereRaw("email = ?", [$data['email']])->first();
            $subscriber->delete();

            return view('unsubscribe');
        } else {
            return view('invalid-token');
        }
    }

    /**
     * write brief description
     *
     * @param $email
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function setting($email, $token)
    {
        $corporate_groups = config('groups');
        $groups           = [];
        foreach ($corporate_groups as $group) {
            $groups[$group['name']] = $group['name'];
        }
        asort($groups);

        $countries = config('country');
        asort($countries);

        $subscriber                 = Subscriber::whereRaw("email = ?", [$email])
                                                ->whereRaw("token = ?", [$token])
                                                ->first();
        $subscribed_country         = $this->getSubscribedCountry($subscriber);
        $subscribed_corporate_group = $this->getSubscribedCorporateGroup($subscriber);

//        $subscribed_country_list         = $this->getList($subscribed_country);
//        $subscribed_corporate_group_list = $this->getList($subscribed_corporate_group);
//        dd($subscribed_country);

        if ($this->isTokenValid($email, $token)) {
            return view(
                'setting',
                compact(
                    'countries',
                    'groups',
                    'email',
                    'token',
                    'subscribed_country',
                    'subscribed_corporate_group'
                )
            );
        } else {
            return 'This request can not be processed';
        }
    }

    public function getSubscribedCountry($subscriber)
    {
        return $subscriber->group->country;
    }

    public function getSubscribedCorporateGroup($subscriber)
    {
        return $subscriber->group->corporate_group;
    }

//    public function getList($subscribed_data)
//    {
//        $list = [];
//        foreach ($subscribed_data as $key => $value) {
//           $list[] = $value;
//        }
//        return $list;
//    }

    public function settingPost(Request $request)
    {
        $data          = [];
        $data['group'] = [
            'country'         => $this->isAllSelected($request->input('all_country'), $request->input('country')),
            'corporate_group' => $this->isAllSelected(
                $request->input('all_corporate_group'),
                $request->input
                (
                    'corporate_group'
                )
            ),
        ];
        $email         = $request->input('email');
        $token         = $request->input('token');

        if ($this->isTokenValid($email, $token)) {
            $subscriber = Subscriber::whereRaw("email = ?", [$email])->first();
            $subscriber->update($data);

            return view('settingssaved', compact('email'));
        } else {
            return 'This request can not be processed';
        }
    }

}
