@extends('layouts.app')

@section('content')
<div class="container pt-4">
    
    <div id="create_post">
        <img class="rounded-circle pr-2" style="height: 50px;" src="https://i.redd.it/9n242vp9u7r31.png">
        <a href="/post/create"> <input type="text" placeholder="Create Post" ></a>
    </div>
    
    
    <div class="d-flex pt-4">
        <div>
            <button class="btn btn-primary">upvote</button>
            <p class="align-text-bottom">15k</p>
            <button class="btn btn-primary">downvote</button>
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
            <button class="btn btn-primary">upvote</button>
            <p class="align-text-bottom">9k</p>
            <button class="btn btn-primary">downvote</button>
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
            <button class="btn btn-primary">upvote</button>
            <p class="align-text-bottom">9k</p>
            <button class="btn btn-primary">downvote</button>
        </div>
        <div id="post_title">
            <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
            <h1 style="font-size:small" class="text-bold pt-1 d-inline">r/hollowknight</h1>
            <p class="pl-2 d-inline">posted by u/{{$user->name}} 21 hours ago </p>
            <div>
                <h1 class="medium-text">{{ $post->title }}</h1>
            </div>
            <img class="w-100" src="storage/{{ $post->image }}" style="max-height: 700px">
        </div>
    </div>

    @endforeach
    
    <svg style="max-height: 72px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="_30bZQzX8IR92H3gw3vlaLF"><path d="M16.5,2.924,11.264,15.551H9.91L15.461,2.139h.074a9.721,9.721,0,1,0,.967.785ZM8.475,8.435a1.635,1.635,0,0,0-.233.868v4.2H6.629V6.2H8.174v.93h.041a2.927,2.927,0,0,1,1.008-.745,3.384,3.384,0,0,1,1.453-.294,3.244,3.244,0,0,1,.7.068,1.931,1.931,0,0,1,.458.151l-.656,1.558a2.174,2.174,0,0,0-1.067-.246,2.159,2.159,0,0,0-.981.215A1.59,1.59,0,0,0,8.475,8.435Z"></path></svg>
</div>
@endsection
