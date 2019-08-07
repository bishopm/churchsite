<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;

class ModelController extends Controller
{

    private $model;

    public function __construct($model)
    {
        $this->page = $model;
    }

    public function index()
    {
        $pages = $this->page->all();
        return view('churchnet::pages.index', compact('pages'));
    }

    public function edit()
    {

    }

    public function create()
    {

    }

    public function show()
    {

    }

    public function store()
    {

    }
    
    public function update()
    {

    }

    public function destroy()
    {

    }
}
