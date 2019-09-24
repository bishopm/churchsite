<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{    
    protected $guarded = array('id');

    public function pagewidgets()
    {
        return $this->hasMany('Bishopm\Churchsite\Models\Pagewidget');
    }
}
