<?php

namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\View\View;
use Bishopm\Churchsite\Models\Sermon;

class LatestsermonComposer
{
    public function compose(View $view)
    {
        $sermon = Sermon::with('series')->orderBy('servicedate', 'desc')->first();
        $view->with('sermon', $sermon);
    }
}
