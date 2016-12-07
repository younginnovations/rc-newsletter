<?php
namespace App\Http\Controllers;

use App\Http\Models\PublishedContract;
use Illuminate\Http\Request;
use App\Http\Models\Subscriber;
use App\Services\ConfirmationService;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Home Page
     *
     */
    public function home()
    {
        $corporate_groups = config('groups');
        $groups = array();
        foreach ($corporate_groups as $group) {
            $groups[$group['name']] = $group['name'];
        }
        asort($groups);

        $countries = config('country');
        asort($countries);

        return view(
            'index',
            compact(
                'countries',
                'groups'
            )
        );
    }

    public function subscribe(Request $request, ConfirmationService $confirm)
    {
        $data           = [];
        $data['email']  = $request->input('email');
        $data['token']  = $this->generateToken($data['email']);
        $data['source'] = $request->input('source');
        $data['status'] = 0;
        $data['group']  = [
            'country'         => ($request->input('country') == "" ? [] : $request->input('country')),
            'corporate_group' => ($request->input('corporate_group') == "" ? [] : $request->input('corporate_group')),
        ];

        try {
            $subscriber = Subscriber::create($data);
            $confirm->sendConfirmationEmail($subscriber);

            return view('thanks');
        } catch (\Exception $e) {
            return redirect()->route('home')->withInput()->with('message', 'This email is already subscribed !');
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
        $data                   = [];
        $data['contract_id']    = $request->input('contract_id');
        $data['metadata']       = $request->input('metadata');

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

    public function unsubscribe()
    {
        return view('unsubscribe');
//        $data           = [];
//        $data['email']  = $email;
//        $data['token']  = $token;
//        if ($this->isTokenValid($data['email'], $data['token'])) {
//            $subscriber = Subscriber::whereRaw("email = ?", [$data['email']])->first();
//            $subscriber->delete();
//            return view('unsubscribe');
//        } else {
//            return 'Invalid token';
//        }
    }

    public function setting($email, $token)
    {
        $corporate_groups = config('groups');
        $groups = array();
        foreach ($corporate_groups as $group) {
            $groups[$group['name']] = $group['name'];
        }
        asort($groups);

        $countries = config('country');
        asort($countries);

        if ($this->isTokenValid($email, $token)) {
            return view('setting', compact('countries', 'groups', 'email', 'token'));
        } else {
            return 'This request can not be processed';
        }
    }

    public function settingPost(Request $request)
    {
        $data           = [];
        $data['group']  = [
            'country'         => ($request->input('country') == "" ? [] : $request->input('country')),
            'corporate_group' => ($request->input('corporate_group') == "" ? [] : $request->input('corporate_group')),
        ];
        $email = $request->input('email');
        $token = $request->input('token');

        if ($this->isTokenValid($email, $token)) {
            $subscriber = Subscriber::whereRaw("email = ?", [$email])->first();
            $subscriber->update($data);
            return view('settingssaved', compact('email'));
        } else {
            return 'This request can not be processed';
        }
    }

}
