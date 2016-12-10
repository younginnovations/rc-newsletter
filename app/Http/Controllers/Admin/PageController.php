<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\PublishedContract;
use App\Http\Models\Subscriber;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * Pages list
     *
     */
    public function index()
    {
        $subscribers = Subscriber::paginate(50);
        return view('admin.page.dashboard', compact('subscribers'));
    }

    public function published_contract()
    {
        $published_contracts = PublishedContract::paginate(25);
        return view('admin.page.published_contract', compact('published_contracts'));
    }
}
