<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Page;

class WebController extends Controller
{

    public function show($page=null) {
        if ($page) {
            $page = Page::where('slug',$page)->with('pagewidgets')->first();
        } else {
            $page = Page::where('slug','home')->with('pagewidgets')->first();
        }
        $data=array();
        foreach ($page->pagewidgets as $widget) {
            $data[$widget->zone][]=$widget;
        }
        if ($page->body) {
            $data['page'] = $page->body;
        }
        return view('churchsite::site.page',$data);
    }
    
}
