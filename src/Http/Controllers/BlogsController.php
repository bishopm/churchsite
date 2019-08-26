<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Blog;
use Bishopm\Churchsite\ViewModels\BlogViewModel;
use Illuminate\Http\Request;
use DB;
use Auth;

class BlogsController extends Controller
{

    public function index()
    {
        $blogs = Blog::orderBy('created_at')->get();
        return view('churchsite::blogs.index',compact('blogs'));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('churchsite::blogs.edit',compact('blog'));
    }

    public function create()
    {
        $viewModel = new BlogViewModel(Auth::user());
        return view('churchsite::blogs.create', $viewModel);
    }

    public function store(Request $request)
    {
        return Blog::create($request->except('_token','_method'));
    }
    
    public function update(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->update($request->except('_token','_method'));
        return $blog;
    }

    public function destroy()
    {

    }
}
