@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <form action="{{ action('VideoController@store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="text" name="keywords" placeholder="Keywords">
                <input type="checkbox" name="private" value="1">Private<br>
                <select name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>

                @endforeach
                </select>
                <label>Video name:</label>
                <input type="text" name="name" value="{{ $video->name }}" placeholder="Video name">
                <input type="file" name="file">
                <input type="submit" value="Submit">
                </form>
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
