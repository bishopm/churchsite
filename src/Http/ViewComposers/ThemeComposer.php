<?php namespace Bishopm\Churchsite\Http\ViewComposers;

use Bishopm\Churchsite\Models\Setting;
use Bishopm\Churchsite\Models\Theme;
use Illuminate\Contracts\View\View;

class ThemeComposer
{

    public function compose(View $view)
    {
        $setting=Setting::where('setting_key','theme')->first()->setting_value;
        $theme=Theme::with('settings')->where('title',$setting)->first();
        $settings=array();
        foreach ($theme->settings as $ts) {
            $settings[$ts->setting_key]=$ts->setting_value;
        }
        $view->with('settings', $settings);
    }
}
