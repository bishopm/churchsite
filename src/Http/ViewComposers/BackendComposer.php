<?php

namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\View\View;
use Bishopm\Churchsite\Models\Setting;
use JeroenNoten\LaravelAdminLte\AdminLte;

class BackendComposer
{
    /**
     * @var AdminLte
     */
    private $adminlte;

    public function __construct(
        AdminLte $adminlte
    ) {
        $this->adminlte = $adminlte;
    }

    public function compose(View $view)
    {
        $allsettings=Setting::all();
        $settings=array();
        foreach ($allsettings as $ts) {
            $settings[$ts->setting_key]=$ts->setting_value;
        }
        $view->with('settings', $settings);
        $view->with('adminlte', $this->adminlte);
    }
}
