<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Video;
use App\Comment;

class CommentsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->video_id = $video->id;
        $comment->user_id = $request->user()->id;
        $comment->save();
        return redirect()->action('VideoController@show', $video->id);

    }
}
