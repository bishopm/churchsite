<?php

namespace Bishopm\Churchsite\Http\ViewModels;

use Spatie\ViewModels\ViewModel;
use Bishopm\Churchsite\Http\Controllers\MenuitemsController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Page;
use Bishopm\Churchsite\Models\Menuitem;
use Illuminate\Database\Eloquent\Collection;
use DB;

class MenuitemViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->indexUrl = action([MenuitemsController::class, 'index']);
    }

    public function pages(): Collection
    {
        return Page::all();
    }

    public function itemsformenu()
    {
        return Menuitem::orderBy('parent_id', 'ASC')->get();
    }

    public function allMain()
    {
        return Menuitem::where('parent_id', 0)->get();
    }

    public function menuitems(): String
    {
        $items=Menuitem::where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $fin="<ol class=\"dd-list\">";
        foreach ($items as $item) {
            $fin.="<li class=\"dd-item\" data-id=\"" . $item->id . "\">\n";
            $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($item->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $item->id . "\"><i class=\"fa fa-times\"></i></a></div>";
            $fin.="<div class=\"dd-handle\">" . $item->title . "</div>\n";
            $children = Menuitem::where('parent_id', $item->id)->orderBy('position')->get();
            if (count($children)) {
                $fin.="<ol class=\"dd-list\">\n";
                foreach ($children as $child) {
                    $fin.="<li class=\"dd-item\" data-id=\"" . $child->id . "\">\n";
                    $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($child->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $child->id . "\"><i class=\"fa fa-times\"></i></a></div>";
                    $fin.="<div class=\"dd-handle\">" . $child->title . "</div>\n";
                    $grandchildren = Menuitem::where('parent_id', $child->id)->get();
                    if (count($grandchildren)) {
                        $fin.="<ol class=\"dd-list\">\n";
                        foreach ($grandchildren as $gchild) {
                            $fin.="<li class=\"dd-item\" data-id=\"" . $gchild->id . "\">\n";
                            $fin.="<div class=\"btn-group\" role=\"group\" aria-label=\"Action buttons\" style=\"display: inline\"><a class=\"btn btn-sm btn-info\" style=\"float:left;\" href=\"" . route('menuitems.edit', array($gchild->id)) . "\"><i class=\"fa fa-pencil\"></i></a><a class=\"btn btn-sm btn-danger jsDeleteMenuItem\" style=\"float:left; margin-right: 15px;\" data-item-id=\"" . $gchild->id . "\"><i class=\"fa fa-times\"></i></a></div>";
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
        $this->items=Menuitem::where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $menu="<ul class=\"navbar-nav mr-auto\">";
        foreach ($this->items as $item) {
            $children = Menuitem::where('parent_id', $item->id)->orderBy('position', 'ASC')->get();
            if (count($children)) {
                $menu = $menu . "<li class=\"nav-item dropdown\">";
                $menu = $menu . "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">{$item->title}</a>";
                $menu = $menu . "<div class=\"dropdown-menu\">";
                foreach ($children as $child) {
                    $menu = $menu . "<a class=\"dropdown-item\" href=\"{$child->url}\">{$child->title}</a>";
                    // Still need provision for grandchildren
                }
                $menu = $menu . "</div></li>";
            } else {
                $menu = $menu . "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . url('/') . "/{$item->url}\">{$item->title}</a></li>";
            }
        }
        return $menu . "</ul>";
    }

    public function makeFooter()
    {
        $items=Menuitem::where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $mainfooter=array();
        foreach ($items as $menu) {
            $children = Menuitem::where('parent_id', $menu->id)->orderBy('position', 'ASC')->get();
            foreach ($children as $child) {
                $mainfooter[$menu->title][]='<a class="footerlink" href="' . url('/') . '/page/' . $child->url . '">' . $child->title . '</a>';
            }
        }
        return $mainfooter;
    }

}
