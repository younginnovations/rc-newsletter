<?php
namespace App\Http\Controllers;

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
        $countries = array(
            'TN' => 'Tunisia',
            'NP' => 'Nepal',
            'US' => 'USA'
         );
        $corporate_groups = array('John Inc', 'Congo Minerals', 'Tango Waters');

        return view('index', compact(
            'countries',
            'corporate_groups'
        ));
    }

    public function subscribe()
    {
        
    }

}
