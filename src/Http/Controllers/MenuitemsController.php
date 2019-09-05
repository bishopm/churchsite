<?php

namespace Bishopm\Churchsite\Http\Controllers;

use Bishopm\Churchsite\Models\Menuitem;
use Bishopm\Churchsite\ViewModels\MenuitemViewModel;
use Bishopm\Churchsite\Models\Menu;
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

	public function index($menu)
	{
        $data['menuitems'] = $this->menuitem->all();
        $data['menu'];
   		return view('churchsite::menuitems.index',$data);
	}

	public function edit($menu,Menuitem $menuitem)
    {
        $data['pages']=$this->pages->all();
        $data['items']=$this->menuitem->all();
        $data['menuitem']=$menuitem;
        $data['menu']=$menu;
        return view('churchsite::menuitems.edit', $data);
    }

    public function create($id)
    {
        $menu=Menu::find($id);
        $viewModel = new MenuitemViewModel(Auth::user(),$menu);
        return view('churchsite::menuitems.create',$viewModel);
    }

    public function store(Request $request)
    {
        Menuitem::create($request->all());
        return redirect()->route('menus.edit',$request->menu_id)
            ->withSuccess('New menu item added');
    }

    public function update($menu, Menuitem $menuitem, UpdateMenuitemRequest $request)
    {
        $this->menuitem->update($menuitem, $request->all());
        return redirect()->route('admin.menus.edit',$menu)->withSuccess('Menuitem has been updated');
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

    public function destroy($menu, Menuitem $menuitem)
    {
        $this->menuitem->destroy($menuitem);

        return redirect()->route('admin.menus.edit',$menu)->withSuccess('Menu item has been deleted');
    }

}
