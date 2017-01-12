<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Video;
use Illuminate\Http\Request;
use App\Category;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function show(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        //$videos = \App\Video::where('id', $id )
              // ->get();
        $categories = Category::get();

        return view('video.show')->with('video', $video)->with('categories', $categories);

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            abort(403);
        }
        $video = new Video();
        $categories = Category::get();
        return view('video.create')->with('video', $video)->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            abort(403);
        }
        $video = new Video();
        $messages = [ 
            'name.max' => 'Video name must be less than 255 characters long! yARRRRR',
            'name.required' => 'Video name is required! yARRRRR',
            'file.required' => 'Video file is required! yARRRRR',
            'file.mimetypes' => 'Uploaded File must be a video! yARRRRR'
        ];
        $validate = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'file' => 'required|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
        ], $messages);

        if ($validate->fails()) {
            $video->name = $request->input('name');
                    $categories = Category::get();
            return view('video.edit')->with('video', $video)->with('errors', $validate->errors())->with('categories', $categories);;
        }

        $category = $request->input('category_id');
        $category = Category::findOrFail($category);
        $video->name = $request->input('name');
        $path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $path = 'videos/' . $name;
            $file = $request->file('file')->move(public_path('videos'), $name);
        }
        $keywords = $request->input('keywords');
        $video->keywords = $keywords;
        $private = $request->input('private');
        $video->private = (bool) $private;
        $video->user_id = $request->user()->id;
        $video->category_id = $category->id;
        $video->path = $path;
        $video->save();

        /* work in progress */
        return redirect()->action('VideoController@show', $video->id);
    }
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $video = Video::findOrFail($id);
        if (!$user || $user->id != $video->user_id) {
            abort(403);
        }
        //$videos = \App\Video::where('id', $id )
              // ->get();
        $categories = Category::get();

        return view('video.edit')->with('video', $video)->with('categories', $categories);

    }
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $video = Video::findOrFail($id);
        if (!$user || $user->id != $video->user_id) {
            abort(403);
        }
        $video = Video::findOrFail($id);
        $messages = [ 
            'name.max' => 'Video name must be less than 255 characters long',
            'name.required' => 'Video name is required! yARRRRR',
            'file.required' => 'Video file is required! yARRRRR',
            'file.mimetypes' => 'Uploaded File must be a video!'
        ];
        $validate = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'file' => 'required|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
        ], $messages);

        if ($validate->fails()) {
            $video->name = $request->input('name');
                    $categories = Category::get();
            return view('video.edit')->with('video', $video)->with('errors', $validate->errors())->with('categories', $categories);
        }
        $category = $request->input('category_id');
        $category = Category::findOrFail($category);
        $video->name = $request->input('name');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $video->path = 'videos/' . $name;
            $file = $request->file('file')->move(public_path('videos'), $name);
        }
        $keywords = $request->input('keywords');
        $video->keywords = $keywords;
        $private = $request->input('private');
        $video->private = (bool) $private;
        $video->category_id = $category->id;
        $video->save();

        return redirect()->action('VideoController@show', $video->id);

    }
    public function index(Request $request)
    { 
        $videos = Video::get();
        $categories = Category::get();
        return view('video.index')->with('videos', $videos)->with('categories', $categories)->with('user', $request->user);
    }
    public function search(Request $request)
    {
        $categories = Category::get();
        $user_id = $request->user()->id;
        $name = DB::connection()->getPdo()->quote('%'.strtolower($request->input('name').'%'));
        $videos= Video::where(function($query) use ($name){
            $query->where(DB::raw('LOWER(name)'), 'LIKE', DB::raw($name))
            ->orWhere(DB::raw('LOWER(keywords)'), 'LIKE', DB::raw($name)); /* LOL FUNNYY rofl stupid */
        })->where(function($query) use ($user_id) {
            $query->where('user_id', '=', $user_id)
            ->orWhere('private', False);
        })
        ->get();

        return view('video.index')->with('videos', $videos)->with('categories', $categories)->with('user', $request->user);
    }

    public function myVideos(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            abort(403);
        }
        $videos = Video::where('user_id', $request->user()->id)->get();
        $categories = Category::get();
        return view('video.index')->with('videos', $videos)->with('categories', $categories)->with('user', $request->user);
    }
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $video = Video::findOrFail($id);
        if (!$user || $user->id != $video->user_id) {
            abort(403);
        }
        $video->delete();

        return redirect()->action('VideoController@index');
    }
}
