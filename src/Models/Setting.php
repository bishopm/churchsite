<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{    
    protected $guarded = array('id');

    public function theme()
    {
        return $this->belongsTo('Bishopm\Churchsite\Models\Theme');
    }
}
