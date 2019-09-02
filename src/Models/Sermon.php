<?php

namespace Bishopm\Churchsite\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Sermon extends Model
{
    use HasTags;
    
    protected $guarded = array('id');

    public function series()
    {
        return $this->belongsTo('Bishopm\Churchsite\Models\Series');
    }

    public function getPreacherAttribute() {
        return $this->tagsWithType('Preacher')->first()->name;
    }
}
