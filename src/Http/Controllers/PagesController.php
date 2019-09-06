<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{

    public function index()
    {
        $pages = Page::orderBy('title')->get();
        return view('churchsite::pages.index',compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::with('pagewidgets')->find($id);
        return view('churchsite::pages.edit',compact('page'));
    }

    public function show($id)
    {
        $page = Page::with('sermons')->find($id);
        return view('churchsite::pages.show',compact('page'));
    }

    public function create()
    {
        return view('churchsite::pages.create');
    }

    public function store(Request $request)
    {
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $page = Page::create($request->except('_token','_method'));
        return redirect()->route('pages.index')
            ->withSuccess('Page created');
    }
    
    public function update(Request $request)
    {
        $page = Page::find($request->id);
        if ($request->file('pagesimage')) {
            $file = $request->file('pagesimage');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $request->request->add(['image' => $filename]);      
            $file->move(base_path() . '/storage/app/sermons/',$filename);  
        }
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $page->update($request->except('_token','_method','pagesimage'));
        return redirect()->route('pages.index')
            ->withSuccess('Page updated');
    }

    public function destroy()
    {

    }
}
