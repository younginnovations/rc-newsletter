<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $subscribers = json_decode (DB::table('subscribers')->get());
        return view('admin.page.dashboard', compact('subscribers'));
    }

}
