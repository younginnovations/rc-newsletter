<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Subscriber;
use Illuminate\Support\Facades\DB;

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
        $subscribers = Subscriber::get();
        return view('admin.page.dashboard', compact('subscribers'));
    }

}
