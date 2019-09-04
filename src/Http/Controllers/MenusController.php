<?php

namespace Bishopm\Churchsite\Http\Controllers;

use Bishopm\Churchsite\Models\Menu;
use Bishopm\Churchsite\ViewModels\MenuViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MenusController extends Controller {

	public function index()
	{
        $data['menus'] = Menu::all();
   		return view('churchsite::menus.index',$data);
	}

	public function edit($id)
    {
        $menu = Menu::find($id);
        $viewModel = new MenuViewModel(Auth::user(),$menu);
        return view('churchsite::menus.edit', $viewModel);
    }

    public function create()
    {
        return view('churchsite::menus.create');
    }

    public function store(Request $request)
    {
        Menu::create($request->all());
        return redirect()->route('menus.index')
            ->withSuccess('New menu added');
    }

    public function update(Request $request)
    {
        $this->menu->update($menu, $request->all());
        return redirect()->route('admin.menus.index')->withSuccess('Menu has been updated');
    }

}
