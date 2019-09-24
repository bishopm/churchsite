<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Setting;
use Bishopm\Churchsite\Models\Theme;
use Bishopm\Churchsite\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThemesController extends Controller
{

    public function index()
    {
        $themes = Theme::orderBy('title')->get();
        return view('churchsite::themes.index',compact('themes'));
    }

    public function edit($id)
    {
        $data['theme'] = Theme::with('settings')->find($id);
        return view('churchsite::themes.edit',$data);
    }

    public function show($id)
    {
        $theme = Theme::with('sermons')->find($id);
        return view('churchsite::themes.show',compact('theme'));
    }

    public function create()
    {
        return view('churchsite::themes.create');
    }

    public function store(Request $request)
    {
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $theme = Theme::create($request->except('_token','_method'));
        return redirect()->route('themes.index')
            ->withSuccess('Theme created');
    }
    
    public function update($id, Request $request)
    {
        $theme = Theme::find($id);
        $theme->title = $request->title;
        $theme->description = $request->description;
        $theme->save();
        foreach ($request->all() as $key=>$field) {
            if (strpos($key,"id_") === 0) {
                $setting = Setting::find(substr($key,3));
                $setting->setting_value = $field;
                $setting->save();
            } 
        }
        return redirect()->route('themes.edit',$id)->withSuccess('Theme updated');
    }

    public function destroy()
    {

    }
}
