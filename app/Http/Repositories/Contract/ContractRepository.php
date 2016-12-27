<?php namespace App\Http\Repositories\Contract;

use App\Http\Models\Contract;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ContractRepository
 */
class ContractRepository implements ContractRepositoryInterface
{
    /**
     * @var Contract
     */
    protected $contract;

    /**
     * ContractRepository constructor.
     *
     * @param Contract $contract
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get all contracts
     * @return Collection
     */
    public function all()
    {
        return $this->contract->all();
    }

    /**
     * Paginate contracts
     * @return Collection
     */
    public function paginate()
    {
        return $this->contract->paginate(25);
    }

    /**
     * Get single contract
     *
     * @param $id
     *
     * @return Contract
     */
    public function find($id)
    {
        return $this->contract->where("contract_id",$id)->first();
    }

    /**
     * Saves contract
     *
     * @param $data
     *
     * @return Contract
     */
    public function save($data)
    {
        return $this->contract->create($data);
    }
}