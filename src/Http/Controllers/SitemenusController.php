<?php

namespace Bishopm\Churchsite\Http\Controllers;

use Bishopm\Churchsite\Models\Sitemenu;
use Bishopm\Churchsite\Http\ViewModels\MenuitemViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SitemenusController extends Controller {

	public function index()
	{
        $data['menus'] = Sitemenu::all();
   		return view('churchsite::menus.index',$data);
	}

	public function edit($id)
    {
        $menu = Sitemenu::find($id);
        $viewModel = new MenuitemViewModel(Auth::user(),$menu);
        return view('churchsite::menus.edit', $viewModel);
    }

    public function create()
    {
        return view('churchsite::menus.create');
    }

    public function store(Request $request)
    {
        Sitemenu::create($request->all());
        return redirect()->route('menus.index')
            ->withSuccess('New menu added');
    }

    public function update($id, Request $request)
    {
        $menu=Sitemenu::find($id);
        $menu->menu=$request->menu;
        $menu->description=$request->description;
        $menu->save();
        return redirect()->route('menus.index')->withSuccess('Menu has been updated');
    }

}
