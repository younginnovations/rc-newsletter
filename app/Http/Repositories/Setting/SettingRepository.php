<?php namespace App\Http\Repositories\Setting;

use App\Http\Models\Setting;

/**
 * Class SettingRepository
 * @package App\Http\Repositories\Setting
 */
class SettingRepository implements SettingRepositoryInterface
{
    /**
     * @var setting
     */
    protected $setting;

    /**
     * SettingRepository constructor.
     *
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Save Option
     *
     * @param      $key
     * @param      $value
     *
     * @return Setting
     */
    public function update($key, $value)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        $option = $this->isKeyUnique($key);

        if (!$option) {
            $update = $this->setting->where('key', $key)->update(['value' => $value]);
            return $update;
        }

        return $this->setting->create(
            [
                'key'   => $key,
                'value' => $value,
            ]
        );
    }
}
