<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Subscriber;
use App\Services\ConfirmationService;
use Illuminate\Support\Facades\Hash;

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
            'TN' => 'Tunisia',
            'NP' => 'Nepal',
            'US' => 'USA',
        ];
        $corporate_groups = [
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
        $email           = $request->input('email');
        $country         = $request->input('country');
        $corporate_group = $request->input('corporate_group');
        $token           = Hash::make(str_random(8));

        $subscriber = new Subscriber();

        $subscriber->email           = $email;
        $subscriber->country         = $country;
        $subscriber->corporate_group = $corporate_group;
        $subscriber->status          = 0;
        $subscriber->token           = $token;

        try {
            $subscriber->save();
            $result = $confirm->sendConfirmationEmail($email, $token);
            dd($result);
            return view('thanks');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home')->withInput()->with('message', 'This email is already subscribed !');
        }
    }

}
