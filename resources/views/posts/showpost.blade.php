@extends('layouts.app')

@section('content')

<div class="d-flex pt-4 container mt-5" style="background: #fff">
    <div>
        @guest
            <vote-buttons post-id="{{$post->id}}" is-upvoted="" is-downvoted="" rating={{$post->rating}}></vote-buttons>
        @else
            @php
                $isUpvoted=false;
                $isDownvoted=false;
                $vote=auth()->user()->votes->where("post_id","=",$post->id)->first();
                if($vote !=null)
                    if($vote->upvote == true)
                        $isUpvoted=true;
                    else if($vote->downvote==true)
                        $isDownvoted=true;
            @endphp
            <vote-buttons post-id="{{$post->id}}" is-upvoted="{{$isUpvoted}}" is-downvoted="{{$isDownvoted}}" rating={{$post->rating}}></vote-buttons>
        @endguest
        
    </div>
    <div id="post">
        
        <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
        <h1 style="font-size:small" class="text-bold pt-1 d-inline">
            @if(App\Models\SubReddit::where("id","=",$post->sub_reddit_id)->first()==null)
                u/{{$poster->name}}
            @else
                r/{{App\Models\SubReddit::where("id","=",$post->sub_reddit_id)->first()->name}}
            @endif
        </h1>
        
        <p class="d-inline">posted by u/{{$poster->name}} {{ $post->created_at->diffForHumans()}} </p>
        <div>
            <h1 class="medium-text">{{ $post->title }}</h1>
        </div>
        
        @if( $post->image !=null)
            <img class="w-100 pb-3" src="{{ Storage::url($post->image) }}" style="max-height: 700px">
        @endif
    </div>
</div>

@endsection