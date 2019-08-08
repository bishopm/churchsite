<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Form;
use Illuminate\Http\Request;

class ModelController extends Controller
{

    private function setup($model)
    {
        $this->eloquent = '\\Bishopm\\Churchsite\\Models\\' . ucfirst($model);
        $this->data['model'] = $model;
        $this->data['forms'] = Form::where('table',$model)->first();
    }

    public function index($model)
    {
        $this->setup($model);
        $rows = $this->eloquent::all();
        foreach (explode(',',$this->data['forms']['listview']) as $header) {
            $this->data['headers'][] = $header;
        }
        foreach ($rows as $row) {
            $dum = array();
            foreach ($this->data['headers'] as $header) {
                $dum[$header] = $row->$header;
            }
            $dum['id'] = $row->id;
            $this->data['rows'][]=$dum;
        }
        return view('churchsite::models.index',$this->data);
    }

    public function edit($model, $id)
    {
        $this->setup($model);
        $item = $this->eloquent::find($id);
        foreach (explode(',',$this->data['forms']['editview']) as $field) {
            $this->data['fields'][$field] = $item[$field];
        }
        $this->data['fields']['id'] = $item['id'];
        return view('churchsite::models.edit',$this->data);
    }

    public function create($model)
    {
        $this->setup($model);
        foreach (explode(',',$this->data['forms']['editview']) as $field) {
            $this->data['fields'][] = $field;
        }
        return view('churchsite::models.create',$this->data);
    }

    public function show()
    {

    }

    public function store()
    {

    }
    
    public function update(Request $request)
    {
        dd($request->all());
    }

    public function destroy()
    {

    }
}
