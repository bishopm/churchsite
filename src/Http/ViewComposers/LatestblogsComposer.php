<?php

namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\View\View;
use Bishopm\Churchsite\Models\Blog;

class LatestblogsComposer
{
    public function compose(View $view)
    {
        $view->with('blogs', Blog::orderBy('publicationdate', 'desc')->limit(5)->get());
    }
}
