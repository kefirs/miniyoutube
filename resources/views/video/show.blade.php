@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="panel-heading">Dashboard</div>
                <label>Video name:</label>
                <div>
                    {{ $video->name }}
                </div>
                    <video width="320" height="240" controls>
                            <source src="/{{ $video->path }}" type="video/mp4">
                    </video> 
                    <form action ="{{ action('CommentsController@create', $video->id) }}" method="post">
                    {{ csrf_field() }}
                        <textarea name="text"></textarea>
                        <input type="submit" value="Submit">
                        </form>
                    @foreach ($video->comments as $comment)
                        <div> {{ $comment->text }}</div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
