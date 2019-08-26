<?php

namespace Bishopm\Churchsite\ViewModels;

use Spatie\ViewModels\ViewModel;
use Bishopm\Churchsite\Http\Controllers\BlogsController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Blog;

class BlogViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user, Blog $blog = null)
    {
        $this->user = $user;
        $this->blog = $blog;
        
        $this->indexUrl = action([BlogsController::class, 'index']); 
    }
    
    public function blog(): Blog
    {
        return $this->blog ?? new Blog();
    }
    
    /*public function authors(): Collection
    {
        return Category::canBeUsedBy($this->user)->get();
    }*/
}