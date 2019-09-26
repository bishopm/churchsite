<?php

namespace Bishopm\Churchsite\Http\ViewModels;

use Spatie\ViewModels\ViewModel;
use Spatie\Tags\Tag;
use Bishopm\Churchsite\Http\Controllers\PagesController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Page;
use Bishopm\Churchsite\Models\Widget;
use Illuminate\Database\Eloquent\Collection;
use DB;

class PageViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user, Page $page = null)
    {
        $this->user = $user;
        $this->page = $page;
        
        $this->indexUrl = action([PagesController::class, 'index']); 
    }
    
    public function page(): Page
    {
        return $this->page ?? new Page();
    }
    
    public function widgets() {
        $widgets['1header'] = array();
        $widgets['2body'] = array();
        $widgets['3footer'] = array();
        if ($this->page) {
            foreach ($this->page->pagewidgets as $widget) {
                $widgets[$widget->zone][] = $widget;
            }
        }
        return $widgets;
    }

    public function widgetnames() {
        return Widget::orderBy('widget')->get();
    }

    public function subjecttags(): Array
    {
        if ($this->page) {
            $tags = $this->page->tagsWithType('Blog');
            $stags = array();
            foreach ($tags as $tag) {
                $stags[]=$tag->name;
            }
            return $stags;
        } else {
            return [];
        }
    }

    public function subjects(): Collection
    {
        return Tag::getWithType('Blog');
    }

}