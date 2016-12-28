<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\APIService;
use App\Http\Services\ContractService;
use App\Http\Services\SubscriberService;
use Illuminate\Http\Request;

/**
 * Class SettingController
 * @property APIService        api
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{
    /**
     * SettingController constructor.
     *
     * @param APIService        $api
     * @param SubscriberService $subscriber
     */
    public function __construct(
        APIService $api,
        SubscriberService $subscriber
    ) {
        $this->api        = $api;
        $this->subscriber = $subscriber;
    }

    /**
     * Loads settings page
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
        $subscriber                 = $this->subscriber->findSubscriber($email, $token);

        if ($this->subscriber->isTokenValid($email, $token)) {
            return view(
                'setting',
                compact(
                    'countries',
                    'groups',
                    'subscriber'
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

        if ($this->subscriber->isTokenValid($email, $token)) {
            $subscriber = $this->subscriber->findSubscriber($email, $token);
            $subscriber->update($data);
            return view('setting.settingssaved', compact('email'));
        } else {
            return 'This request can not be processed';
        }
    }
}