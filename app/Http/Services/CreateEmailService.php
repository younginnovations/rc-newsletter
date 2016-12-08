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
        foreach ($subscribers as $subscriber) {
            $dataForEmail = [];

            $country_of_subscriber         = $subscriber->group->country;
            $corporate_group_of_subscriber = $subscriber->group->corporate_group;

            foreach ($published_contracts as $published_contract) {
                if (!($published_contract->sent_email)) {
                    $country_of_published_contract         = $published_contract->metadata->country->code;
                    $corporate_group_of_published_contract = $published_contract->metadata->company[0]->parent_company;

                    if (in_array($country_of_published_contract, $country_of_subscriber)) {
                        if (!array_key_exists($published_contract->metadata->open_contracting_id, $dataForEmail)) {
                            $dataForEmail[$published_contract->metadata->open_contracting_id] =
                                $published_contract;
                        }
                    }
                    if (in_array($corporate_group_of_published_contract, $corporate_group_of_subscriber)) {
                        if (!array_key_exists($published_contract->metadata->open_contracting_id, $dataForEmail)) {
                            $dataForEmail[$published_contract->metadata->open_contracting_id] =
                                $published_contract;
                        }
                    }
                }
                $data['sent_email']      = 1;
                $data['sent_email_date'] = date('Y-m-d');
                $published_contract      = PublishedContract::whereRaw(
                    "contract_id = ?",
                    [$published_contract->contract_id]
                )
                                                            ->first();
                $published_contract->update($data);
            }
            if (!empty($dataForEmail)) {
                $this->sendToQueue($subscriber->email, $dataForEmail, $subscriber->token);
            }
        }

        //published_contract loop
//        foreach ($published_contracts as $published_contract) {
//            if (!($published_contract->sent_email)) {
//                $country_of_published_contract         = $published_contract->metadata->country->code;
//                $corporate_group_of_published_contract = $published_contract->metadata->company[0]->parent_company;
//
//                foreach ($subscribers as $subscriber) {
//                    $country_of_subscriber         = $subscriber->group->country;
//                    $corporate_group_of_subscriber = $subscriber->group->corporate_group;
//
//                    if (in_array($country_of_published_contract, $country_of_subscriber)) {
//                        $this->sendToQueue(
//                            $subscriber->email,
//                            $published_contract->metadata->contract_name,
//                            $subscriber->token
//                        );
//                    }
//                    if (in_array($corporate_group_of_published_contract, $corporate_group_of_subscriber)) {
//                        $this->sendToQueue(
//                            $subscriber->email,
//                            $published_contract->metadata->contract_name,
//                            $subscriber->token
//                        );
//                    }
//                }
//                $data['sent_email'] = 1;
//                $data['sent_email_date'] = date('Y-m-d');
//                $published_contract = PublishedContract::whereRaw("contract_id = ?", [$published_contract->contract_id])
//                                                       ->first();
//                $published_contract->update($data);
//            }
//        }
    }

    public function sendToQueue($email, $dataForEmail, $token)
    {
//        $data = [
//            'email'         => $email,
//            'contract_name' => $contract_name,
//            'token'         => $token,
//        ];
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
