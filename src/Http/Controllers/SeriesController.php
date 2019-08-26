<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Series;
use Illuminate\Http\Request;
use DB;

class SeriessController extends Controller
{

    public function index()
    {
        $series = Series::orderBy('created_at')->get();
        return view('churchsite::series.index',compact('series'));
    }

    public function edit($id)
    {
        $series = Series::find($id);
        return view('churchsite::series.edit',compact('series'));
    }

    public function create($model)
    {
        return view('churchsite::series.create');
    }

    public function store(Request $request)
    {
        return Series::create($request->except('_token','_method'));
    }
    
    public function update(Request $request)
    {
        $series = Series::find($request->id);
        $series->update($request->except('_token','_method'));
        return $series;
    }

    public function destroy()
    {

    }
}
