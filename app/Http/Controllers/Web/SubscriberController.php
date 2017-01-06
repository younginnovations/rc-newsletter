<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Setting\SettingService;
use App\Http\Services\Subscriber\SubscriberService;
use App\Requests\SubscriberRequest;
use App\Services\ConfirmationService;
use Illuminate\Http\Request;
use Exception;
use Psr\Log\LoggerInterface;

/**
 * Class SubscriberController
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @property SubscriberRequest subscriberRequest
 * @property SettingService    setting
 * @property LoggerInterface   logger
 */
class SubscriberController extends Controller
{
    /**
     * SubscriberController constructor.
     *
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     * @param SubscriberRequest $subscriberRequest
     * @param SettingService    $setting
     * @param LoggerInterface   $logger
     */
    public function __construct(
        SubscriberService $subscriber,
        ContractService $contract,
        SubscriberRequest $subscriberRequest,
        SettingService $setting,
        LoggerInterface $logger
    ) {
        $this->subscriber        = $subscriber;
        $this->contract          = $contract;
        $this->subscriberRequest = $subscriberRequest;
        $this->setting           = $setting;
        $this->logger            = $logger;
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
        $this->validate($request, $this->subscriberRequest->rules());
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
            $config     = $this->setting->getConfig();
            $confirm->sendConfirmationEmail($subscriber, $config);
            $this->logger->info("Confirmation email sent.");

            return view('thanks', compact('subscriber'));
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());

            return redirect()->route('home')->withInput()->with('message', 'Error has occurred, please try again !');
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
        if ($subscriber = $this->subscriber->isTokenValid($email, $token)) {
            $subscriber->status = 1;

            try {
                $subscriber->token  = generateToken($email);
                $subscriber->save();
                $this->logger->info($subscriber->email." confirmed subscription.");
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }

            return view('confirm', compact('subscriber'));
        } else {
            $this->logger->info("Invalid token page was displayed via confirmation email.");

            return view('invalid-token');
        }
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

        if ($this->subscriber->isTokenValid($data['email'], $data['token'])) {
            return view('confirm-unsubscribe', compact('email', 'token'));
        } else {
            $this->logger->info("Invalid token page was displayed via un-subscription.");

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

        if ($this->subscriber->isTokenValid($data['email'], $data['token'])) {
            try {
                $subscriber = $this->subscriber->findSubscriber($data['email'], $data['token']);
                $subscriber->delete();
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }

            return view('unsubscribe');
        } else {
            $this->logger->info("Invalid token page was displayed via un-subscription.");

            return view('invalid-token');
        }
    }
}
