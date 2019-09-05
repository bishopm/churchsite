<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bishopm\Churchsite\Http\ViewModels\SermonViewModel;
use DB;
use Auth;

class SermonsController extends Controller
{

    public function index()
    {
        $sermons = Sermon::orderBy('created_at')->get();
        return view('churchsite::sermons.index',compact('sermons'));
    }

    public function edit($id)
    {
        $sermon = Sermon::find($id);
        return view('churchsite::sermons.edit',compact('sermon'));
    }

    public function show($id)
    {
        return view('churchsite::sermons.show',compact('sermon'));
    }

    public function create($series)
    {
        $viewModel = new SermonViewModel(Auth::user(), $series);
        return view('churchsite::sermons.create', $viewModel);
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->title, '-');
        $request->request->add(['slug' => $slug]);
        $sermon = Sermon::create($request->except('_token','preacher'));
        $sermon->syncTagsWithType(array($request->preacher), 'Preacher');
        return redirect()->route('series.show', $request->series_id)
            ->withSuccess('New sermon added');
    }
    
    public function update(Request $request)
    {
        $sermon = Sermon::find($request->id);
        $sermon->update($request->except('_token','_method'));
        return redirect()->route('sermons.index')
            ->withSuccess('Sermon updated');
    }

    public function destroy()
    {

    }
}
