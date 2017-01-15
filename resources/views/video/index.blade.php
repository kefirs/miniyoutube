@extends('layouts.app')

@section('content')

<div class="container-fluid text-center">    
  <div class="row content">
                <div class="col-sm-2 sidenav">
                    @foreach($categories as $category)
                        <p><a href="{{ action('CategoryController@videos', $category->id) }}"> {{ $category->name }} </a></p>
                    @endforeach
                </div>

        <div class="col-sm-8 text-left">
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>
                <ul>
                @foreach($videos as $video)
                    <div class="container-fluid bg-3 text-center">
                    <div class="col-sm-3">
                    <a href="{{ !$user || $video->user_id != $user->id ? action('VideoController@show', $video->id) : action('VideoController@edit', $video->id) }}"> 
                    {{ $video->name }} </a>
                    </div>
                    </div>
                    <video width="320" height="240" controls>
                            <source src="/{{ $video->path }}" type="video/mp4">
                        </video>
                @endforeach
                </ul>
                <div class="panel-body">
                    
                </div>

            </div>
        </div>
                   <div class="col-sm-2 sidenav">
                        <div class="well">
                             <img src="images/Logomakr_6q54Pd.jpg" href="{{ url('/') }}" class="img-rounded" alt="miniYoutube" width="150" height="200">
                             <p></p>
                             <p>
                             Darbu izstrādāja:
                             Dzintars Lapiņš
                             un
                             Valērija Šahtjora
                             </p>
                        </div>
                   </div>
    </div>
</div>
@endsection
