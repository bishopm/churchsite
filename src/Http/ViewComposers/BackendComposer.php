<?php

namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\View\View;
use JeroenNoten\LaravelAdminLte\AdminLte;

class BackendComposer
{
    /**
     * @var AdminLte
     */
    private $adminlte;

    public function __construct(
        AdminLte $adminlte
    ) {
        $this->adminlte = $adminlte;
    }

    public function compose(View $view)
    {
        $view->with('adminlte', $this->adminlte);
    }
}
