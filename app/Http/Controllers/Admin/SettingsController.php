<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Setting\SettingService;
use Illuminate\Http\Request;

/**
 * Class SettingsController
 * @property SettingService setting
 * @package App\Http\Controllers\Admin
 */
class SettingsController extends Controller
{
    /**
     * SettingsController constructor.
     *
     * @param SettingService $setting
     */
    public function __construct(SettingService $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Returns settings page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = $this->setting->getSettings();

        return view('admin.page.settings', compact('settings'));
    }

    /**
     * Saves settings
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['subject'] = $request->input('subject');
        $data['schedule'] = $request->input('schedule');
        $this->setting->save($data);

        return redirect()->route('admin.settings')->with('success', 'Successfully saved.');
    }
}
