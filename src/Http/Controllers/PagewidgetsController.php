<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Pagewidget;
use Bishopm\Churchsite\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagewidgetsController extends Controller
{

    public function index()
    {
        $pagewidgets = Page::orderBy('title')->get();
        return view('churchsite::pagewidgets.index',compact('pagewidgets'));
    }

    public function edit($id)
    {
        $data['page'] = Page::with('pagewidgets.widget')->find($id);
        $data['widgets'] = array();
        foreach ($data['page']->pagewidgets as $widget) {
            $data['widgets'][$widget->zone][] = $widget;
        }
        return view('churchsite::pagewidgets.edit',$data);
    }

    public function show($page, $id)
    {
        $pw = Pagewidget::with('widget')->find($id);
        $data = json_decode($pw->data);
        if (isset($data->folder)) {
            $data->files = scandir(public_path() . '/storage/' . $data->folder);
        }
        $pw->data=json_encode($data);
        return $pw;
    }

    public function create()
    {
        return view('churchsite::pagewidgets.create');
    }

    public function store($id, Request $request)
    {
        $others = Pagewidget::where('page_id',$id)->where('zone',$request->zone)->orderBy('row','DESC')->first();
        if ($others) {
            $row = $others->row + 1;
        } else {
            $row = 0;
        }
        $wid = Widget::find($request->widget);
        $widget = Pagewidget::create(['page_id'=>$id,'width'=>$wid->width,'widget_id'=>$wid->id,'zone'=>$request->zone,'col'=>0,'row'=>$row,'data'=>$wid->data]);
        $widget->widget = $wid;
        return $widget;
    }
    
    public function update($id, Request $request)
    {
        if (isset($request->items)) {
            $items = json_decode($request->items);
            foreach ($items as $item) {
                $pw=Pagewidget::find($item->id);
                $pw->row = $item->y;
                $pw->col = $item->x;
                $pw->width = $item->width;
                $pw->save();
            }
        } elseif (isset($request->delete)) {
            $pw = Pagewidget::find($request->delete);
            $pw->delete();
        } elseif (isset($request->data)) {
            $pw = Pagewidget::find($request->widget_id);
            $fields = explode("&",urldecode($request->data));
            $json = "{";
            foreach ($fields as $field) {
                if (substr($field,0,strpos($field,'='))=="images") {
                    $images = explode(",",substr($field,1+strpos($field,'=')));
                    $thisfield = '"images":[';
                    foreach ($images as $img){
                        $thisfield = $thisfield . '"' . $img . '",';
                    }
                    $thisfield = substr($thisfield,0,-1) . "],";
                } else {
                    $thisfield = '"' . substr($field,0,strpos($field,'=')) . '":"' . substr($field,1+strpos($field,'=')) . '",';
                }
                $json = $json . $thisfield;
            }
            $json = substr($json,0,-1) . "}";
            $pw->data = $json;
            $pw->save();
        }
        return "Widgets updated";
    }

    public function destroy()
    {

    }
}
