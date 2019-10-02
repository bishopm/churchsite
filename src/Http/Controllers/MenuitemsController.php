<?php

namespace Bishopm\Churchsite\Http\Controllers;

use Bishopm\Churchsite\Models\Menuitem;
use Bishopm\Churchsite\Http\ViewModels\MenuitemViewModel;
use Bishopm\Churchsite\Models\Sitemenu;
use Bishopm\Churchsite\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MenuitemsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        $viewModel = new MenuitemViewModel(Auth::user());
        return view('churchsite::menuitems.index', $viewModel);
	}

	public function edit($id)
    {
        $data['pages']=Page::orderBy('title')->get();
        $data['menuitem']=Menuitem::find($id);
        $data['items']=Menuitem::all();
        return view('churchsite::menuitems.edit', $data);
    }

    public function create()
    {
        $viewModel = new MenuitemViewModel(Auth::user());
        return view('churchsite::menuitems.create',$viewModel);
    }

    public function store(Request $request)
    {
        Menuitem::create($request->all());
        return redirect()->route('menuitems.index')
            ->withSuccess('New menu item added');
    }

    public function update($id, Request $request)
    {
        $menuitem = Menuitem::find($id);
        $menuitem->update($request->all());
        return redirect()->route('menuitems.index')->withSuccess('Menuitem has been updated');
    }

    public function reorder(Request $request)
    {
        $items=json_decode($request->menu);
        foreach ($items as $key=>$item){
            $item1=$this->menuitem->find($item->id);
            $item1->parent_id=0;
            $item1->position=$key;
            $item1->save();
            if (isset($item->children)){
                foreach ($item->children as $key2=>$child){
                    $item2=$this->menuitem->find($child->id);
                    $item2->parent_id=$item->id;
                    $item2->position=$key2;
                    $item2->save();
                    if (isset($child->children)){
                        foreach ($child->children as $key3=>$grandchild){
                            $item3=$this->menuitem->find($grandchild->id);
                            $item3->parent_id=$child->id;
                            $item3->position=$key3;
                            $item3->save();
                        }
                    }
                }
            }
        }
        print "Done!";
    }

    public function destroy($id)
    {
        $menuitem = Menuitem::find($id);
        $menuitem->delete();
        return redirect()->route('menuitems.index')->withSuccess('Menu item has been deleted');
    }

}
