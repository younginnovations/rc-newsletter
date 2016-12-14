<?php namespace App\Http\Services;

use Illuminate\Contracts\Queue\Queue;

/**
 * @property  queue
 */
class CreateEmailService
{
    /**
     * @var SubscriberService
     */
    private $subscriber;
    /**
     * @var ContractService
     */
    private $contract;

    /**
     * CreateEmailService constructor.
     *
     * @param Queue             $queue
     * @param SubscriberService $subscriber
     * @param ContractService   $contract
     */
    public function __construct(Queue $queue, SubscriberService $subscriber, ContractService $contract)
    {
        $this->queue      = $queue;
        $this->subscriber = $subscriber;
        $this->contract   = $contract;
    }

    /**
     * write brief description
     */
    public function create()
    {
        $published_contracts = $this->contract->get();
        $subscribers         = $this->subscriber->get();
        foreach ($subscribers as $subscriber) {
            $dataForEmail = collect([]);

            $country_of_subscriber         = $subscriber->group->country;
            $corporate_group_of_subscriber = $subscriber->group->corporate_group;
            $source_of_subscriber          = $subscriber->source;

            foreach ($published_contracts as $published_contract) {
                if (!($published_contract->sent_email) && ($published_contract->metadata->category[0] ==
                        $source_of_subscriber)
                ) {
                    $country_of_published_contract         = $published_contract->metadata->country->code;
                    $corporate_group_of_published_contract = $published_contract->metadata->company[0]->parent_company;

                    if (in_array($country_of_published_contract, $country_of_subscriber) or ($country_of_subscriber[0]
                            == "ALL")
                    ) {
                        if (!($dataForEmail->contains($published_contract))) {
                            $dataForEmail[] =
                                $published_contract;
                        }
                    }
                    if (in_array(
                            $corporate_group_of_published_contract,
                            $corporate_group_of_subscriber
                        ) or ($corporate_group_of_subscriber[0] == "ALL")
                    ) {
                        if (!($dataForEmail->contains($published_contract))) {
                            $dataForEmail[] =
                                $published_contract;
                        }
                    }
                }
                $data['sent_email']      = 1;
                $data['sent_email_date'] = date('Y-m-d');
                $published_contract      = $this->contract->getContract($published_contract->contract_id);
                $published_contract->update($data);
            }

            if (!is_null(json_decode($dataForEmail)) && !empty(json_decode($dataForEmail))) {
                $this->sendToQueue($subscriber->email, $dataForEmail, $subscriber->token);
            }
        }
    }

    public function sendToQueue($email, $dataForEmail, $token)
    {
        $data = [
            'email'               => $email,
            'published_contracts' => $dataForEmail,
            'token'               => $token,
        ];
        $this->queue->push(
            'App\Services\Queue\SendEmailQueue',
            $data,
            'send_email'
        );
    }

}
