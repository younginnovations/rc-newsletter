<?php namespace App\Http\Services;


use App\Http\Models\PublishedContract;
use App\Http\Models\Subscriber;
use Illuminate\Contracts\Queue\Queue;

/**
 * @property  queue
 */
class CreateEmailService
{
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * write brief description
     */
    public function create()
    {
        $published_contracts = PublishedContract::get();
        $subscribers         = Subscriber::get();
        //Subscribers Table
        //$subscribers[0]->email
        //$subscribers[0]->group->country      this returns array
        //$subscribers[0]->group->corporate_group     this returns array
        //
        //
        //Published Contracts Table
        //$published_contracts[0]->metadata->country->code
        //$published_contracts[0]->metadata->company[0]->parent_company
        //$published_contracts[0]->metadata->contract_name
        //date('Y-m-d')

        foreach ($published_contracts as $published_contract) {
            if (!($published_contract->sent_email)) {
                $country_of_published_contract         = $published_contract->metadata->country->code;
                $corporate_group_of_published_contract = $published_contract->metadata->company[0]->parent_company;

                foreach ($subscribers as $subscriber) {
                    $country_of_subscriber         = $subscriber->group->country;
                    $corporate_group_of_subscriber = $subscriber->group->corporate_group;

                    if (in_array($country_of_published_contract, $country_of_subscriber)) {
                        $this->sendToQueue(
                            $subscriber->email,
                            $published_contract->metadata->contract_name,
                            $subscriber->token
                        );
                    }
                    if (in_array($corporate_group_of_published_contract, $corporate_group_of_subscriber)) {
                        $this->sendToQueue(
                            $subscriber->email,
                            $published_contract->metadata->contract_name,
                            $subscriber->token
                        );
                    }
                }
                $data['sent_email'] = 1;
                $data['sent_email_date'] = date('Y-m-d');
                $published_contract = PublishedContract::whereRaw("contract_id = ?", [$published_contract->contract_id])
                                                       ->first();
                $published_contract->update($data);
            }
        }
    }

    public function sendToQueue($email, $contract_name, $token)
    {
        $data = [
            'email'         => $email,
            'contract_name' => $contract_name,
            'token'         => $token,
        ];
        $this->queue->push(
            'App\Services\Queue\SendEmailQueue',
            $data,
            'send_email'
        );
    }

}
