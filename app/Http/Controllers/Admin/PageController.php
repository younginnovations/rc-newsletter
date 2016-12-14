<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ContractService;
use App\Http\Services\SubscriberService;

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
        $subscribers = $this->subscriber->getSubscribers();
        return view('admin.page.dashboard', compact('subscribers'));
    }

    /**
     * Returns contracts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function published_contract()
    {
        $published_contracts = $this->contract->getContracts();
        return view('admin.page.published_contract', compact('published_contracts'));
    }
}
