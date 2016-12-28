<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\API\APIService;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Subscriber\SubscriberService;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @property APIService        api
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * SiteController constructor.
     *
     * @param APIService        $api
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     */
    public function __construct(
        APIService $api,
        SubscriberService $subscriber,
        ContractService $contract
    ) {
        $this->api        = $api;
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(Request $request)
    {
        $email     = $request->input('email');
        $source    = $request->input('source');
        $groups    = $this->api->corporate_group();
        $countries = $this->api->getCountryList();

        return view(
            'index',
            compact(
                'countries',
                'groups',
                'email',
                'source'
            )
        );
    }

    /**
     * Saves published contracts from NRGI admin
     *
     * @param Request $request
     *
     * @return int
     */
    public function publishPost(Request $request)
    {
        $data                = [];
        $data['contract_id'] = $request->input('contract_id');
        $data['metadata']    = $request->input('metadata');
        $published_contract  = $this->contract->find($data['contract_id']);

        if (is_null($published_contract)) {
            try {
                $this->contract->save($data);
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 1;
    }
}
