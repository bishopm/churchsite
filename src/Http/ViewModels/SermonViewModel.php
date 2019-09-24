<?php

namespace Bishopm\Churchsite\Http\ViewModels;

use Spatie\ViewModels\ViewModel;
use Spatie\Tags\Tag;
use Bishopm\Churchsite\Http\Controllers\SermonsController;
use Bishopm\Churchsite\Models\User;
use Bishopm\Churchsite\Models\Sermon;
use Illuminate\Database\Eloquent\Collection;
use DB;

class SermonViewModel extends ViewModel
{
    public $indexUrl = null;

    public function __construct(User $user, $series, Sermon $sermon = null)
    {
        $this->user = $user;
        $this->sermon = $sermon;
        $this->series = $series;
        $this->indexUrl = action([SermonsController::class, 'show'], $series); 
    }
    
    public function sermon(): Sermon
    {
        return $this->sermon ?? new Sermon();
    }

    public function series() {
        return $this->series;
    }
    
    public function preacher(): String
    {
        if ($this->sermon) {
            $preacherarray = $this->sermon->tagsWithType('Preacher')->first();
            if ($preacherarray) {
                return $preacherarray->name;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function preachers(): Collection
    {
        return Tag::getWithType('Preacher');
    }
}