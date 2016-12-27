<?php namespace App\Http\Services;

use App\Http\Models\Contract;
use App\Http\Repositories\Contract\ContractRepositoryInterface;

/**
 * Class ContractService
 * @package App\Http\Services
 */
Class ContractService
{
    /**
     * ContractService constructor.
     *
     * @param ContractRepositoryInterface $contract
     */
    public function __construct(ContractRepositoryInterface $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get All contracts
     * @return mixed
     */
    public function all()
    {
        return $this->contract->all();
    }

    /**
     * Pagination
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate()
    {
        return $this->contract->paginate();
    }

    /**
     * Get single contract
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->contract->find($id);
    }

    /**
     * Saves contract
     *
     * @param $data
     *
     * @return Contract|ContractService
     */
    public function save($data)
    {
        return $this->contract->save($data);
    }
}
