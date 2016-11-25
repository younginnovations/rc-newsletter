<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
        return view('admin.page.dashboard');
    }

}
