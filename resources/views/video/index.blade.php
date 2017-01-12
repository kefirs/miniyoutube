@extends('layouts.app')

@section('content')
                <ul>
                @foreach($categories as $category)
                <li><a href="{{ action('CategoryController@videos', $category->id) }}"> {{ $category->name }} </a></li>
                @endforeach
         
                </ul>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <ul>
                @foreach($videos as $video)
                    <li><a href="{{ !$user || $video->user_id != $user->id ? action('VideoController@show', $video->id) : action('VideoController@edit', $video->id) }}"> {{ $video->name }} </a>
                    <video width="320" height="240" controls>
                            <source src="/{{ $video->path }}" type="video/mp4">
                        </video> </li>
                @endforeach
                </ul>
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
