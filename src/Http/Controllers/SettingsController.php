<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Setting;
use Bishopm\Churchsite\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::orderBy('setting_key')->get();
        return view('churchsite::settings.index',compact('settings'));
    }

    public function edit($id)
    {
        $data['setting'] = Setting::with('theme')->find($id);
        return view('churchsite::settings.edit',$data);
    }

    public function show($id)
    {
        $setting = Setting::with('sermons')->find($id);
        return view('churchsite::settings.show',compact('setting'));
    }

    public function create()
    {
        return view('churchsite::settings.create');
    }

    public function store(Request $request)
    {
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $setting = Setting::create($request->except('_token','_method'));
        return redirect()->route('settings.index')
            ->withSuccess('Setting created');
    }
    
    public function update(Request $request)
    {
        $setting = Setting::find($request->id);
        if ($request->file('settingsimage')) {
            $file = $request->file('settingsimage');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $request->request->add(['image' => $filename]);      
            $file->move(base_path() . '/storage/app/sermons/',$filename);  
        }
        $request->request->add(['slug' => Str::slug($request->title, '-')]);
        $setting->update($request->except('_token','_method','settingsimage'));
        return redirect()->route('settings.index')
            ->withSuccess('Setting updated');
    }

    public function destroy()
    {

    }
}
