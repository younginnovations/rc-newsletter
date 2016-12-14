<?php namespace App\Http\Services;

use App\Http\Models\Contract;

/**
 * Class ContractService
 * @package App\Http\Services
 */
Class ContractService
{
    /**
     * Returns contracts
     * @return mixed
     */
    public function get()
    {
        return Contract::get();
    }

    /**
     * Returns contracts
     * @return mixed
     */
    public function getContracts()
    {
        return Contract::paginate(25);
    }

    public function getContract($id)
    {
        return Contract::whereRaw("contract_id = ?", [$id])->first();
    }

    public function saveContract($data)
    {
        return Contract::create($data);
    }
}
