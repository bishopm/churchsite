<?php

namespace Bishopm\Churchsite\Traits;

trait CrudTrait
{

    public function getModel($model)
    {
        return '/Bishopm/Churchsite/Models/' + $model;
    }

}
