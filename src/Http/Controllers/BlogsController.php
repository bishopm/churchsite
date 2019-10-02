<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Blog;
use Bishopm\Churchsite\Http\ViewModels\BlogViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $viewModel = new BlogViewModel(Auth::user(),$blog);
        return view('churchsite::blogs.edit',$viewModel);
    }

    public function create()
    {
        $viewModel = new BlogViewModel(Auth::user());
        return view('churchsite::blogs.create', $viewModel);
    }

    public function show($slug)
    {
        $blog = Blog::whereSlug($slug)->with('tags')->first();
        $viewModel = new BlogViewModel(null,$blog);
        return view('churchsite::blogs.show', $viewModel);
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->title, '-');
        $request->request->add(['slug' => $slug]);
        $blog = Blog::create($request->except('_token','tags','author','files'));
        $blog->syncTagsWithType($request->tags, 'Blog');
        $blog->syncTagsWithType(array($request->author), 'Blogger');
        return redirect()->route('blogs.index')
            ->withSuccess('New blog post added');
    }
    
    public function update(Request $request)
    {
        $slug = Str::slug($request->title, '-');
        $request->request->add(['slug' => $slug]);
        $blog = Blog::find($request->id);
        $blog->update($request->except('_token','tags','author'));
        $blog->syncTagsWithType($request->tags, 'Blog');
        $blog->syncTagsWithType(array($request->author), 'Blogger');
        return redirect()->route('blogs.index')
            ->withSuccess('Blog post updated');
    }

    public function destroy()
    {

    }
}
