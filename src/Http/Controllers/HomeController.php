<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function admin()
    {
        return view('churchsite::dashboard');
    }
}
