<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Http\ViewModels\PageViewModel;
use Bishopm\Churchsite\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class PagesController extends Controller
{

    public function index()
    {
        $pages = Page::orderBy('title')->get();
        return view('churchsite::pages.index',compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::with('pagewidgets.widget')->find($id);
        $viewModel = new PageViewModel(Auth::user(),$page);
        return view('churchsite::pages.edit',$viewModel);
    }

    public function show($id)
    {
        $page = Page::with('sermons')->find($id);
        return view('churchsite::pages.show',compact('page'));
    }

    public function create()
    {
        $viewModel = new PageViewModel(Auth::user());
        return view('churchsite::pages.create',$viewModel);
    }

    public function store(Request $request)
    {
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $page = Page::create($request->except('_token','tags','_method'));
        $page->syncTagsWithType($request->tags, 'Blog');
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
        $page->update($request->except('_token','_method','pagesimage','tags'));
        $page->syncTagsWithType($request->tags, 'Blog');
        return redirect()->route('pages.index')
            ->withSuccess('Page updated');
    }

    public function destroy()
    {

    }
}
