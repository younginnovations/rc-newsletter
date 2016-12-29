<?php namespace App\Http\Services\Setting;

use App\Http\Models\Setting;

/**
 * Class SettingService
 * @package App\Http\Services\Setting
 */
class SettingService
{
    /**
     * SettingService constructor.
     *
     * @param Setting $setting
     *
     * @internal param $Setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Gets saved settings
     */
    public function getSettings()
    {
        $settings = $this->setting->all();

        return $settings;
    }

    /**
     * Saves Setting
     *
     * @param $data
     *
     * @return void
     */
    public function save($data)
    {
        foreach ($data as $key => $value) {
            $this->setting->where('key', $key)->update(['value' => $value]);
        }

        return;
    }

    /**
     * Returns saved config of admin
     */
    public function getConfig()
    {
        $config = [];
        $settings = $this->getSettings();

        foreach ($settings as $setting) {
            $config[$setting->key] = $setting->value;
        }

        return $config;
    }
}
