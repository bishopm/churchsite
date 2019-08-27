<?php

namespace Bishopm\Churchsite\ViewModels;

use Spatie\ViewModels\ViewModel;
use Bishopm\Churchsite\Http\Controllers\BlogsController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Blog;
use DB;

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
    
    public function tags(): Collection
    {
        return Tag::canBeUsedBy($this->user)->get();
        return \DB::table('taggables')
   ->distinct()
   ->select('tag_id')
   ->where('taggable_type', YourModel::class)
   ->get()
   ->pluck('tag_id');
    }
}