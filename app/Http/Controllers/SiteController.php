<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Subscriber;

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

    public function subscribe(Request $request)
    {
        $email           = $request->input('email');
        $country         = $request->input('country');
        $corporate_group = $request->input('corporate_group');

        $subscriber = new Subscriber();

        $subscriber->email           = $email;
        $subscriber->country         = $country;
        $subscriber->corporate_group = $corporate_group;
        $subscriber->status          = 1;

        try {
            $subscriber->save();
            return view('thanks');
        }
        catch (\Exception $e)
        {
            return redirect()->route('home')->withInput()->with('message', 'This email is already subscribed !');
        }
    }

}
