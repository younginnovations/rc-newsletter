<?php
namespace App\Http\Controllers;

use App\Http\Models\PublishedContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Models\Subscriber;
use App\Services\ConfirmationService;
use Illuminate\Support\Facades\DB;

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
        $countries        = [
            'ALL' => 'All',
            'TN'  => 'Tunisia',
            'NP'  => 'Nepal',
            'US'  => 'USA',
        ];
        $corporate_groups = [
            'All',
            'John Inc',
            'Congo Minerals',
            'Tango Waters',
        ];

        return view(
            'index',
            compact(
                'countries',
                'corporate_groups'
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
            'country'         => $request->input('country'),
            'corporate_group' => $request->input('corporate_group'),
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
            return 'Invalid token';
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

        try {
            PublishedContract::create($data);

            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function unsubscribe()
    {

    }

    public function setting($email, $token)
    {
        if ($subscriber = $this->isTokenValid($email, $token)) {
            return view('setting');
        } else {
            return 'This request can not be processed';
        }
    }

}
