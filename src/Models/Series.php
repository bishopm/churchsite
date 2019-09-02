<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded = array('id');

    public function sermons()
    {
        return $this->hasMany('Bishopm\Churchsite\Models\Sermon')->orderBy('servicedate');
    }
}
