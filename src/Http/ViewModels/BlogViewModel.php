<?php

namespace Bishopm\Churchsite\Http\ViewModels;

use Spatie\ViewModels\ViewModel;
use Spatie\Tags\Tag;
use Bishopm\Churchsite\Http\Controllers\BlogsController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Blog;
use Bishopm\Churchsite\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use DB;

class BlogViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user = null, Blog $blog = null)
    {
        $this->user = $user;
        $this->blog = $blog;
        
        $this->indexUrl = action([BlogsController::class, 'index']); 
    }
    
    public function blog(): Blog
    {
        return $this->blog ?? new Blog();
    }

    public function relatedBlogs()
    {
        if ($this->blog) {
            return Blog::where('id','<>',$this->blog->id)->withAnyTags($this->blog->tags)->orderBy('publicationdate', 'desc')->get();      
        }
    }

    public function relatedPages()
    {
        if ($this->blog) {
            return Page::withAnyTags($this->blog->tags)->get();      
        }
    }
    
    public function subjecttags(): Array
    {
        if ($this->blog) {
            $tags = $this->blog->tagsWithType('Blog');
            $stags = array();
            foreach ($tags as $tag) {
                $stags[$tag->slug]=$tag->name;
            }
            return $stags;
        } else {
            return [];
        }
    }

    public function author(): String
    {
        if ($this->blog) {
            $authorarray = $this->blog->tagsWithType('Blogger')->first();
            if ($authorarray) {
                return $authorarray->name;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function subjects(): Collection
    {
        return Tag::getWithType('Blog');
    }

    public function bloggers(): Collection
    {
        return Tag::getWithType('Blogger');
    }
}