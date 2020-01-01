<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Blog;
use Bishopm\Churchsite\Models\Page;
use Bishopm\Churchsite\Models\Sermon;
use Spatie\Tags\Tag;

class WebController extends Controller
{

    public function show($model='page',$page=null) {
        if ($page) {
            $page = Page::where('slug',$page)->with('pagewidgets')->first();
        } else {
            $page = Page::where('slug','home')->with('pagewidgets')->first();
        }
        $data=array();
        foreach ($page->pagewidgets as $widget) {
            $zone = substr($widget->zone,1);
            $data[$zone][]=$widget;
        }
        if ($page->body) {
            $data['page'] = $page->body;
        }
        return view('churchsite::site.page',$data);
    }

    public function people($person) {
        $data['blogs'] = Blog::withAnyTags(array($person),'Blogger')->get();
        $data['sermons'] = Sermon::withAnyTags(array($person),'Preacher')->get();
        $data['person'] = $person;
        return view('churchsite::site.person',$data);
    }

    public function addimage(Request $request)
    {
        if ($request->file('uploadfile')) {
            $fullname = strval(time()) . "." . $request->file('uploadfile')->getClientOriginalExtension();
            $request->file('uploadfile')->move(base_path() . '/storage/app/public/' . $request->input('folder'), $fullname);
            return $fullname;
        }
    }

    public function subject($subject) {
        $data['blogs'] = Blog::withAnyTags(array($subject),'Blog')->get();
        $data['pages'] = Page::withAnyTags(array($subject),'Blog')->get();
        $data['subject'] = $subject;
        return view('churchsite::site.subject',$data);
    }

}
