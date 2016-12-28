<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Subscriber\SubscriberService;
use App\Requests\SubscriberRequest;
use App\Services\ConfirmationService;
use Illuminate\Http\Request;

/**
 * Class SubscriberController
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @property SubscriberRequest subscriberRequest
 */
class SubscriberController extends Controller
{
    /**
     * SubscriberController constructor.
     *
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     * @param SubscriberRequest $subscriberRequest
     */
    public function __construct(
        SubscriberService $subscriber,
        ContractService $contract,
        SubscriberRequest $subscriberRequest
    ) {
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
        $this->subscriberRequest = $subscriberRequest;
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
            $confirm->sendConfirmationEmail($subscriber);

            return view('thanks');
        } catch (\Exception $e) {
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
            $subscriber->token  = generateToken($email);
            $subscriber->save();

            return view('confirm');
        } else {
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
            $subscriber = $this->subscriber->findSubscriber($data['email'], $data['token']);
            $subscriber->delete();
            return view('unsubscribe');
        } else {
            return view('invalid-token');
        }
    }
}
