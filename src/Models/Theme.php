<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{    
    protected $guarded = array('id');

    public function settings()
    {
        return $this->hasMany('Bishopm\Churchsite\Models\Setting');
    }
}
