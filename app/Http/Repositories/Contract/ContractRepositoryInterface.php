<?php namespace App\Http\Repositories\Contract;

use App\Http\Models\Contract;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ContractRepositoryInterface
 */
interface ContractRepositoryInterface
{

    /**
     * Get all contracts
     * @return Collection
     */
    public function all();

    /**
     * Paginate contracts
     * @return Collection
     */
    public function paginate();

    /**
     * Get single contract
     *
     * @param $id
     *
     * @return Contract
     */
    public function find($id);

    /**
     * Saves contract
     *
     * @param $data
     *
     * @return Contract
     */
    public function save($data);
}
