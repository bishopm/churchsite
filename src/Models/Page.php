<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Page extends Model
{    
    use HasTags;

    protected $guarded = array('id');

    public function pagewidgets()
    {
        return $this->hasMany('Bishopm\Churchsite\Models\Pagewidget')->orderBy('zone')->orderBy('row')->orderBy('col');
    }
}
