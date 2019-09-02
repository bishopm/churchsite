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
        return view('churchsite::site.page',compact('page'));
    }
    
}
