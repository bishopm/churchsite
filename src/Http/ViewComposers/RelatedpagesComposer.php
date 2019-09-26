<?php

namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\View\View;
use Bishopm\Churchsite\Models\Blog;
use Bishopm\Churchsite\Models\Page;
use Route;

class RelatedpagesComposer
{
    public function compose(View $view)
    {
        $page=Page::with('tags')->where('slug',Route::current()->parameters('page')['page'])->first();
        $blogs = Blog::withAnyTags($page->tags)->orderBy('publicationdate', 'desc')->get();
        $pages = Page::withAnyTags($page->tags)->where('id','<>',$page->id)->get();
        $view->with('blogs', $blogs);
        $view->with('pages', $pages);
    }
}
