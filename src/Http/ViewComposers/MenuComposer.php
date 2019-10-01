<?php namespace Bishopm\Churchsite\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Bishopm\Churchsite\Http\ViewModels\MenuitemViewModel;
use Bishopm\Churchsite\Models\User;

class MenuComposer
{

    public function compose(View $view)
    {
        $viewModel = new MenuitemViewModel(User::find(1));
        $view->with('webmenu', $viewModel->makeMenu());
        $view->with('webfooter', $viewModel->makeFooter());
    }
}
