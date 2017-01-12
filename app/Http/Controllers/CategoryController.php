<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
    public function videos(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::get();
        $videos = $category->videos;
        return view('video.index')->with('videos', $videos)->with('categories', $categories)->with('user', $request->user);
    }
}
