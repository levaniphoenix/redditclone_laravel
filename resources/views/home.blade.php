@extends('layouts.app')

@section('content')
<div class="container pt-4" >
    
    <div id="create_post " class="mb-2 rounded" style="background: #fff">
        <img class="rounded-circle pr-2" style="height: 50px;" src="https://i.redd.it/9n242vp9u7r31.png">
        <a href="/post/create"> <input type="text" placeholder="Create Post" ></a>
    </div>
    
    @foreach ($posts as $post)

    <div class="d-flex pt-4 my-3" style="background: #fff">
        <div>
            @guest
                <vote-buttons post-id="{{$post->id}}" is-upvoted="" rating={{$post->rating}}></vote-buttons>
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
        <div id="post_title">
            <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
            <h1 style="font-size:small" class="text-bold pt-1 d-inline">
                @php
                    $subReddit=App\Models\SubReddit::where("id","=",$post->sub_reddit_id)->first();
                @endphp
                @if($subReddit==null)
                    u/{{$post->user->name}}
                @else
                   <a style="color: inherit; font-weight: bold;" href="{{route('reddit.show',['name' => $subReddit->name ])}}"> r/{{$subReddit->name}} </a> <i class="fas fa-circle" style="font-size: 3px; vertical-align: middle;"></i>
                @endif
            </h1>
            
            <p class="d-inline">posted by u/{{$post->user->name}} {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </p>
            <div>
                <a style="color: inherit;" href="{{route('post.show',['post' => $post->id ])}}"> <h1 class="medium-text">{{ $post->title }}</h1> </a>
            </div>
            @if( $post->image !=null)
            <a href="{{route('post.show',['post' => $post->id ])}}"> <img class="w-100 mb-4" src="{{ Storage::url($post->image) }}" style="max-height: 700px"> </a>
            @endif
        </div>
    </div>

    @endforeach

</div>
@endsection
