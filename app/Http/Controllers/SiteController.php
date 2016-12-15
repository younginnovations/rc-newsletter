<?php
namespace App\Http\Controllers;

use App\Http\Services\APIService;
use App\Http\Services\ContractService;
use App\Http\Services\SubscriberService;
use Illuminate\Http\Request;
use App\Http\Models\Subscriber;
use App\Services\ConfirmationService;

/**
 * Class SiteController
 * @property APIService        api
 * @property  subscriber
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * SiteController constructor.
     *
     * @param APIService        $api
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     */
    public function __construct(
        APIService $api,
        SubscriberService $subscriber,
        ContractService $contract
    ) {
        $this->api        = $api;
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(Request $request)
    {
        $email     = $request->input('email');
        $source    = $request->input('source');
        $groups    = $this->api->corporate_group();
        $countries = $this->api->getCountryList();

        return view(
            'index',
            compact(
                'countries',
                'groups',
                'email',
                'source'
            )
        );
    }

    /**
     * Saves subscriber
     *
     * @param Request             $request
     * @param ConfirmationService $confirm
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function postSubscriber(Request $request, ConfirmationService $confirm)
    {
        $data = [];
        $this->validate(
            $request,
            [
                'email'  => 'required|email',
                'source' => 'required',
            ]
        );
        $data['email']  = $request->input('email');
        $data['token']  = generateToken($data['email']);
        $data['source'] = $request->input('source');
        $data['status'] = 0;
        $data['group']  = [
            'country'         => isAllSelected(
                $request->input('all_country'),
                $request->input
                (
                    'country'
                )
            ),
            'corporate_group' => isAllSelected(
                $request->input('all_corporate_group'),
                $request->input('corporate_group')
            ),
        ];
        try {
            $subscriber = $this->subscriber->createSubscriber($data);
            $confirm->sendConfirmationEmail($subscriber);
            return view('thanks');
        } catch (\Exception $e) {
            return redirect()->route('home')->withInput()->with('message', 'This email is already subscribed !');
        }
    }

    /**
     * Confirms user subscription
     *
     * @param $email
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($email, $token)
    {
        if ($subscriber = isTokenValid($email, $token)) {
            $subscriber->status = 1;
            $subscriber->token  = generateToken($email);
            $subscriber->save();
            return view('confirm');
        } else {
            return view('invalid-token');
        }
    }

    /**
     * Saves published contracts from NRGI admin
     *
     * @param Request $request
     *
     * @return int
     */
    public function publishPost(Request $request)
    {
        $data                = [];
        $data['contract_id'] = $request->input('contract_id');
        $data['metadata']    = $request->input('metadata');
        $published_contract  = $this->contract->getContract($data['contract_id']);

        if (is_null($published_contract)) {
            try {
                $this->contract->saveContract($data);
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 1;
    }

    /**
     * Confirms un subscription
     *
     * @param $email
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmUnsubscribe($email, $token)
    {
        $data          = [];
        $data['email'] = $email;
        $data['token'] = $token;

        if (isTokenValid($data['email'], $data['token'])) {
            return view('confirm-unsubscribe', compact('email', 'token'));
        } else {
            return view('invalid-token');
        }
    }

    /**
     * Un subscribes
     *
     * @param $email
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unsubscribe($email, $token)
    {
        $data          = [];
        $data['email'] = $email;
        $data['token'] = $token;

        if (isTokenValid($data['email'], $data['token'])) {
            $subscriber = $this->subscriber->getSubscriber($data['email']);
            $subscriber->delete();
            return view('unsubscribe');
        } else {
            return view('invalid-token');
        }
    }

    /**
     * Saves settings
     *
     * @param $email
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function setting($email, $token)
    {
        $groups                     = $this->api->corporate_group();
        $countries                  = $this->api->getCountryList();
        $subscriber                 = $this->subscriber->getSubscriberWithEmailToken($email, $token);
        $subscribed_country         = getSubscribedCountry($subscriber);
        $subscribed_corporate_group = getSubscribedCorporateGroup($subscriber);

        if (isTokenValid($email, $token)) {
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

    /**
     * Saves settings
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function settingPost(Request $request)
    {
        $data          = [];
        $data['group'] = [
            'country'         => isAllSelected($request->input('all_country'), $request->input
                ('country')),
            'corporate_group' => isAllSelected(
                $request->input('all_corporate_group'),
                $request->input
                (
                    'corporate_group'
                )
            ),
        ];
        $email         = $request->input('email');
        $token         = $request->input('token');

        if (isTokenValid($email, $token)) {
            $subscriber = $this->subscriber->getSubscriber($email);
            $subscriber->update($data);
            return view('settingssaved', compact('email'));
        } else {
            return 'This request can not be processed';
        }
    }
}
