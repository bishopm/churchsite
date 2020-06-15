<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Series;
use Bishopm\Churchsite\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class SeriesController extends Controller
{

    public function index()
    {
        $series = Series::orderBy('created_at')->get();
        return view('churchsite::series.index',compact('series'));
    }

    public function allseries()
    {
        $series = Series::orderBy('created_at')->get();
        return view('churchsite::site.sermons',compact('series'));
    }

    public function edit($id)
    {
        $series = Series::find($id);
        return view('churchsite::series.edit',compact('series'));
    }

    public function show($id)
    {
        $series = Series::with('sermons')->find($id);
        return view('churchsite::series.show',compact('series'));
    }

    public function create()
    {
        return view('churchsite::series.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('seriesimage');
        $filename = time() . "." . $file->getClientOriginalExtension();
        $request->request->add(['image' => $filename]);
        $file->move(base_path() . '/storage/app/sermons/',$filename);
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $series = Series::create($request->except('_token','_method','seriesimage'));
        return redirect()->route('series.show',$series->id)
            ->withSuccess('Series created');
    }
    
    public function update(Request $request)
    {
        $series = Series::find($request->id);
        if ($request->file('seriesimage')) {
            $file = $request->file('seriesimage');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $request->request->add(['image' => $filename]);      
            $file->move(base_path() . '/storage/app/sermons/',$filename);
        }
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $series->update($request->except('_token','_method','seriesimage'));
        return redirect()->route('series.index')
            ->withSuccess('Series updated');
    }

    public function destroy()
    {

    }
}
