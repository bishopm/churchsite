<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;

class Sitemenu extends Model
{

    protected $guarded = array('id');

    public function menuitems()
    {
        return $this->hasMany('Bishopm\Churchsite\Models\Menuitem')->orderBy('position');
    }
}
