<?php

namespace Bishopm\Churchsite\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Churchsite\Models\Video;
use Bishopm\Churchsite\Http\ViewModels\VideoViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class VideosController extends Controller
{

    public function index()
    {
        $videos = Video::orderBy('created_at')->get();
        return view('churchsite::videos.index',compact('videos'));
    }

    public function edit($id)
    {
        $data['video'] = Video::find($id);
        return view('churchsite::videos.edit', $data);
    }

    public function create()
    {
        return view('churchsite::videos.create');
    }

    public function show($id)
    {
        $video = Video::find($id);
        return view('churchsite::videos.show', $video);
    }

    public function store(Request $request)
    {
        $video = Video::create($request->except('broadcasttime'));
        $video->broadcasttime = strtotime($request->broadcasttime);
        $video->save();
        return redirect()->route('videos.index')
            ->withSuccess('New video post added');
    }

    public function update(Request $request)
    {
        $video = Video::find($request->id);
        $video->update($request->except('broadcasttime'));
        $video->broadcasttime = strtotime($request->broadcasttime);
        $video->save();
        return redirect()->route('videos.index')
            ->withSuccess('Video post updated');
    }

    public function destroy()
    {

    }

    public function liveapp()
    {
        $now=time();
        $videos = Video::where('broadcasttime','>=',$now - 60 * 24)->orderBy('broadcasttime','ASC')->get();
        foreach ($videos as $video) {
            $video->readable = date('Y-m-d H:i:s',$video->broadcasttime);
            if ($video->broadcasttime + $video->duration < $now) {
                $video->status = "COMPLETED";
            } elseif ($video->broadcasttime < $now) {
                $video->status = "LIVE";
            } else {
                $video->status = "PENDING";
            }
            $video->broadcasttime = $video->broadcasttime * 1000;
            $data[] = $video;
        }
        return $data;
    }
}
