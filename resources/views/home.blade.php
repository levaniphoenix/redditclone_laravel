@extends('layouts.app')

@section('content')
<div class="container pt-4">
    
    <div id="create_post">
        <img class="rounded-circle pr-2" style="height: 50px;" src="https://i.redd.it/9n242vp9u7r31.png">
        <a href="/post/create"> <input type="text" placeholder="Create Post" ></a>
    </div>
    
    
    <div class="d-flex pt-4">
        <div>
            <vote-buttons></vote-buttons>
        </div>
        <div id="post_title">
            <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
            <h1 style="font-size:small" class="text-bold pt-1 d-inline">r/hollowknight</h1>
            <p class="pl-2 d-inline">posted by u/LevanPhoenix 9 hours ago </p>
            <div>
                <h1>Post Title</h1>
            </div>
            <img class="w-100" src="https://preview.redd.it/pd910v2mjfl71.png?width=640&crop=smart&auto=webp&s=676bcb51de0eedb0473287b483af60a07dcae46e">
        </div>
    </div>

    <div class="d-flex pt-4">
        <div>
            <button class="btn"> <i class="fas fa-arrow-up"></i></button>
            <p class="align-text-bottom mb-0" style="text-align: center;">15k</p>
            <button class="btn"><i class="fas fa-arrow-down"></i></button>
        </div>
        <div id="post_title">
            <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
            <h1 style="font-size:small" class="text-bold pt-1 d-inline">r/hollowknight</h1>
            <p class="pl-2 d-inline">posted by u/KeiDraw 21 hours ago </p>
            <div>
                <h1 class="medium-text">This one boss you just can't defeat</h1>
            </div>
            <img class="w-100" src="https://preview.redd.it/er2ugqhvacl71.png?width=640&crop=smart&auto=webp&s=e312c7fd425832364b94d0270ec8e08540c337eb">
        </div>
    </div>
    @foreach ($user->posts as $post)

    <div class="d-flex pt-4">
        <div>
            @guest
                <vote-buttons post-id="{{$post->id}}" is-upvoted=""></vote-buttons>
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
                @if(App\Models\SubReddit::where("id","=",$post->sub_reddit_id)->first()==null)
                    u/{{$user->name}}
                @else
                    r/{{App\Models\SubReddit::where("id","=",$post->sub_reddit_id)->first()->name}}
                @endif
            </h1>
            
            <p class="d-inline">posted by u/{{$user->name}} {{ $post->created_at->diffForHumans()}} </p>
            <div>
                <h1 class="medium-text">{{ $post->title }}</h1>
            </div>
            @if( $post->image !=null)
                <img class="w-100" src="{{ Storage::url($post->image) }}" style="max-height: 700px">
            @endif
        </div>
    </div>

    @endforeach

</div>
@endsection
