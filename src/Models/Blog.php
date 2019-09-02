<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Blog extends Model
{
    use HasTags;
    
    protected $guarded = array('id');

    public function getAuthorAttribute() {
        return $this->tagsWithType('Blogger')->first()->name;
    }
}
