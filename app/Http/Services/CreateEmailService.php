<?php namespace App\Http\Services;

/**
 * Class CreateEmailService
 * @package App\Http\Services
 */
class CreateEmailService
{
    /**
     * @var SubscriberService
     */
    protected $subscriber;
    /**
     * @var ContractService
     */
    protected $contract;

    /**
     * CreateEmailService constructor.
     *
     * @param SendToEmailQueueService $sendToEmailQueue
     * @param SubscriberService       $subscriber
     * @param ContractService         $contract
     *
     * @internal param Queue $queue
     */
    public function __construct(
        SendToEmailQueueService $sendToEmailQueue,
        SubscriberService $subscriber,
        ContractService $contract
    ) {
        $this->sendToEmailQueue = $sendToEmailQueue;
        $this->subscriber       = $subscriber;
        $this->contract         = $contract;
    }

    /**
     * Creates and sends Email
     */
    public function send()
    {
        $published_contracts = $this->contract->all();
        $subscribers         = $this->subscriber->all();
        $this->createEmailReport($subscribers, $published_contracts);
    }

    /**
     * Generates aggregated email
     *
     * @param $subscribers
     * @param $published_contracts
     */
    public function createEmailReport($subscribers, $published_contracts)
    {
        foreach ($subscribers as $subscriber) {
            $this->checkEveryContracts($subscriber, $published_contracts);
        }
    }

    /**
     * Checks every contracts and sends email
     *
     * @param $subscriber
     * @param $published_contracts
     */
    public function checkEveryContracts($subscriber, $published_contracts)
    {
        $dataForEmail = collect([]);
        $country_of_subscriber         = $subscriber->group->country;
        $corporate_group_of_subscriber = $subscriber->group->corporate_group;
        $source_of_subscriber          = $subscriber->source;

        foreach ($published_contracts as $published_contract) {
            $published_contract_source = $published_contract->metadata->category[0];

            if ($this->emailNotSent($published_contract->sent_email) && ($published_contract_source ==
                    $source_of_subscriber)
            ) {
                $country_of_published_contract         = $published_contract->metadata->country->code;
                $corporate_group_of_published_contract = $published_contract->metadata->company[0]->parent_company;

                $this->addInEmailReport($published_contract, $country_of_published_contract, $country_of_subscriber,
                $dataForEmail);
                $this->addInEmailReport($published_contract, $corporate_group_of_published_contract, $corporate_group_of_subscriber,
                $dataForEmail);
            }

            $data['sent_email']      = 1;
            $data['sent_email_date'] = date('Y-m-d');
            $published_contract      = $this->contract->find($published_contract->contract_id);
            $published_contract->update($data);
        }

        $this->sendEmailReport($subscriber, $dataForEmail);
    }

    /**
     * Sends aggregated email
     *
     * @param $subscriber
     * @param $dataForEmail
     */
    public function sendEmailReport($subscriber, $dataForEmail)
    {
        if (!is_null(json_decode($dataForEmail)) && !empty(json_decode($dataForEmail))) {
            $this->sendToEmailQueue->send($subscriber->email, $dataForEmail, $subscriber->token);
        }
    }

    /**
     * Checks if email is already sent
     *
     * @param $status
     *
     * @return bool
     */
    public function emailNotSent($status)
    {
        return !$status;
    }

    /**
     * Adds data in email report
     *
     * @param $published_contract
     * @param $data_of_published_contract
     * @param $data_of_subscriber
     * @param $dataForEmail
     */
    public function addInEmailReport($published_contract, $data_of_published_contract, $data_of_subscriber, $dataForEmail)
    {
        if (in_array($data_of_published_contract, $data_of_subscriber) or ($data_of_subscriber[0] == "ALL")
        ) {
            if (!($dataForEmail->contains($published_contract))) {
                $dataForEmail[] = $published_contract;
            }
        }
    }
}
