<?php

namespace Bishopm\Churchsite\ViewModels;

use Spatie\ViewModels\ViewModel;
use Bishopm\Churchsite\Http\Controllers\MenusController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Menu;
use Bishopm\Churchsite\Models\Page;
use Bishopm\Churchsite\Models\Menuitem;
use Illuminate\Database\Eloquent\Collection;
use DB;

class MenuitemViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user, Menu $menu = null)
    {
        $this->user = $user;
        $this->menu = $menu;
        $this->indexUrl = action([MenusController::class, 'index']); 
    }
    
    public function menu(): Menu
    {
        return $this->menu ?? new Menu();
    }
    
    public function pages(): Collection
    {
        return Page::all();
    }

    public function itemsformenu()
    {
        return Menuitem::where('menu_id', $this->menu->id)->orderBy('parent_id', 'ASC')->get();
    }

    public function allMain()
    {
        return Menuitem::where('menu_id', $this->menu->id)->where('parent_id', 0)->get();
    }

    public function menuitems(): String
    {
        $items=Menuitem::where('menu_id', $this->menu->id)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $fin="<ol class=\"dd-list\">";
        foreach ($items as $item) {
            $fin.="<li class=\"dd-item\" data-id=\"" . $item->id . "\">\n";
            $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($this->menu->id,$item->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $item->id . "\"><i class=\"fa fa-times\"></i></a></div>";
            $fin.="<div class=\"dd-handle\">" . $item->title . "</div>\n";
            $children = Menuitem::where('parent_id', $item->id)->orderBy('position')->get();
            if (count($children)) {
                $fin.="<ol class=\"dd-list\">\n";
                foreach ($children as $child) {
                    $fin.="<li class=\"dd-item\" data-id=\"" . $child->id . "\">\n";
                    $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($this->menu->id,$child->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $child->id . "\"><i class=\"fa fa-times\"></i></a></div>";
                    $fin.="<div class=\"dd-handle\">" . $child->title . "</div>\n";
                    $grandchildren = $this->model->where('parent_id', $child->id)->get();
                    if (count($grandchildren)) {
                        $fin.="<ol class=\"dd-list\">\n";
                        foreach ($grandchildren as $gchild) {
                            $fin.="<li class=\"dd-item\" data-id=\"" . $gchild->id . "\">\n";
                            $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($this->menu->id,$gchild->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $gchild->id . "\"><i class=\"fa fa-times\"></i></a></div>";
                            $fin.="<div class=\"dd-handle\">" . $gchild->title . "</div>\n";
                            $fin.="</li>";
                        }
                        $fin.="</ol>\n";
                    }
                    $fin.="</li>";
                }
                $fin.="</ol>\n";
            }
            $fin.="</li>\n";
        }
        return $fin;
    }

    public function makeMenu()
    {
        $this->items=Menuitem::where('menu_id', $this->menu->id)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
        dd($this->items);
        Menu::create($this->menu->menu, function ($menu) {
            $menu->setPresenter(\Bishopm\Churchsite\Presenters\Bootstrap4Presenter::class);
            foreach ($this->items as $item) {
                $this->children = $this->model->where('parent_id', $item->id)->orderBy('position', 'ASC')->get();
                if (!count($this->children)) {
                    if ($item->url) {
                        $menu->url(url(strtolower($item->url)), $item->title);
                    } else {
                        $menu->url('#', $item->title);
                    }
                } else {
                    $menu->dropdown($item->title, function ($sub) {
                        foreach ($this->children as $child) {
                            if ($child->url) {
                                $sub->url(url(strtolower($child->url)), $child->title);
                            } else {
                                $sub->url('#', $child->title);
                            }
                        }
                    });
                }
            }
        });
        return Menu::get($this->menu->menu);
    }

    public function makeFooter()
    {
        $items=$this->model->where('menu_id', $this->menu->id)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $mainfooter=array();
        foreach ($items as $menu) {
            $children = $this->model->where('parent_id', $menu->id)->orderBy('position', 'ASC')->get();
            foreach ($children as $child) {
                $mainfooter[$menu->title][]='<a href="' . url('/') . '/' . $child->url . '">' . $child->title . '</a>';
            }
        }
        return $mainfooter;
    }

}