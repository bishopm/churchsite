<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Pagewidget extends Model
{    
    protected $guarded = array('id');

    public function widget()
    {
        return $this->belongsTo('Bishopm\Churchsite\Models\Widget');
    }
}
