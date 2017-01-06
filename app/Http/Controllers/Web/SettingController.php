<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\API\APIService;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Subscriber\SubscriberService;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Exception;

/**
 * Class SettingController
 * @property APIService        api
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @property LoggerInterface   logger
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{
    /**
     * SettingController constructor.
     *
     * @param APIService        $api
     * @param SubscriberService $subscriber
     * @param LoggerInterface   $logger
     */
    public function __construct(
        APIService $api,
        SubscriberService $subscriber,
        LoggerInterface $logger
    ) {
        $this->api        = $api;
        $this->subscriber = $subscriber;
        $this->logger     = $logger;
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
        try {
            $groups                     = $this->api->corporate_group();
            $countries                  = $this->api->getCountryList();
            $subscriber                 = $this->subscriber->findSubscriber($email, $token);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        if ($this->subscriber->isTokenValid($email, $token)) {
            return view(
                'setting.setting',
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
            try {
                $subscriber = $this->subscriber->findSubscriber($email, $token);
                $subscriber->update($data);
                $this->logger->info("Settings saved.");

                return view('setting.settingssaved', compact('email'));
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }

        } else {
            return 'This request can not be processed';
        }
    }
}