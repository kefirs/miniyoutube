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
                <div class="panel-heading">Edit</div>
                <form action="{{ action('VideoController@update', $video->id) }}" method="post" enctype="multipart/form-data">
                <input type="text" name="keywords" value="{{ $video->keywords }}" placeholder="Keywords">
                <input type="checkbox" name="private" {{ $video->private ? 'checked' : '' }} value="1">Private<br>
                <select name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $video->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>

                @endforeach
                </select>
                {{ csrf_field() }}
                <label>Video name:</label>
                <input type="text" name="name" value="{{ $video->name }}" placeholder="Video name">
                
                    <video width="320" height="240" controls>
                            <source src="/{{ $video->path }}" type="video/mp4">
                        </video> 
                
                <input type="file" name="file">
                <input type="submit" value="Submit">
                </form>
                <div class="panel-body">
                
                </div>
                <form action="{{ action('VideoController@destroy', $video->id) }}" method="post">
                    <input name="_method" value="DELETE" type="hidden">
                    <input type="submit" value="Delete">
               {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
