<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\API\APIService;
use App\Http\Services\Contract\ContractService;
use App\Http\Services\Subscriber\SubscriberService;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Exception;

/**
 * Class SiteController
 * @property APIService        api
 * @property SubscriberService subscriber
 * @property ContractService   contract
 * @property LoggerInterface   logger
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
     * @param LoggerInterface   $logger
     */
    public function __construct(
        APIService $api,
        SubscriberService $subscriber,
        ContractService $contract,
        LoggerInterface $logger
    ) {
        $this->api        = $api;
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
        $this->logger     = $logger;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(Request $request)
    {
        try {
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
        } catch(Exception $e) {
            $this->logger->error($e->getMessage());
        }
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
                $this->logger->info("Contract published from admin successfully saved.");
            } catch (Exception $e) {
                $this->logger->error("Could not save published contract from admin. ".$e->getMessage());
                return 0;
            }
        } else {
            $this->logger->info("Already published contract from admin was published again.");
        }

        return 1;
    }
}
