<?php namespace App\Http\Repositories\Setting;

use App\Http\Models\Setting;

/**
 * Interface SettingRepositoryInterface
 * @package App\Http\Repositories\Contract
 */
interface SettingRepositoryInterface
{
    /**
     * Gets settings of admin
     * @return mixed
     */
    public function get();

    /**
     * Gets settings of admin
     *
     * @param $data
     *
     * @return mixed
     */
    public function update($data);
}
