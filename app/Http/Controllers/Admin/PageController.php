<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Subscriber\SubscriberService;

/**
 * Class PageController
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * PageController constructor.
     *
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     */
    public function __construct(SubscriberService $subscriber, ContractService $contract)
    {
        $this->middleware('user');
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
    }

    /**
     * Returns subscribers
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $subscribers = $this->subscriber->paginate();
        return view('admin.page.dashboard', compact('subscribers'));
    }

    /**
     * Returns contracts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contracts()
    {
        $contracts = $this->contract->paginate();
        return view('admin.contracts.index', compact('contracts'));
    }
}
