@extends('layouts.app')

@section('content')

<!--   <p> {{$subreddit}} </p> -->
    <a href="/r/{{$subreddit->name}}">
        <div style="background: rgb(45, 151, 229); height: 64px;">
        </div>
    </a>
    <div class>
        <div style="margin-top: -14px; margin-bottom: 12px;" class="container d-flex">
            <div class="d-flex">
                <svg style="height: 72px; border: 4px solid #fff; border-radius: 100%; fill:#0079D3; background:#fff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="_30bZQzX8IR92H3gw3vlaLF"><path d="M16.5,2.924,11.264,15.551H9.91L15.461,2.139h.074a9.721,9.721,0,1,0,.967.785ZM8.475,8.435a1.635,1.635,0,0,0-.233.868v4.2H6.629V6.2H8.174v.93h.041a2.927,2.927,0,0,1,1.008-.745,3.384,3.384,0,0,1,1.453-.294,3.244,3.244,0,0,1,.7.068,1.931,1.931,0,0,1,.458.151l-.656,1.558a2.174,2.174,0,0,0-1.067-.246,2.159,2.159,0,0,0-.981.215A1.59,1.59,0,0,0,8.475,8.435Z"></path></svg>
                <div>
                    <h1 class="pt-4 pl-2" style="font-size: 28px; font-weight:bold;">{{$subreddit->name}}</h1>
                    <h2 class="pl-2" style="font-size: 14px; color:#7c7c7c; margin-top: -5px;"> r/{{$subreddit->name}}</h2>
                </div>
                <div>
                    <join-button subreddit-id="{{$subreddit->id}}" is-joined="{{$isJoined}}"></join-button>
                </div>
            </div>
        </div>
        
        <div class="container pt-2" id="create_post">
            <img class="rounded-circle pr-2" style="height: 50px;" src="https://i.redd.it/9n242vp9u7r31.png">
            <a href="/post/create"> <input type="text" placeholder="Create Post" ></a>
        </div>

        @foreach($posts as $post)
            
        <div class="d-flex pt-4 container">
            <div>
                <button class="btn mr-2"> <i class="fas fa-arrow-up"></i></button>
                <p class="align-text-bottom mb-0 mr-2" style="text-align: center;">15k</p>
                <button class="btn mr-2"><i class="fas fa-arrow-down"></i></button>
            </div>
            <div id="post_title">
                <img class="rounded-circle pr-2" style="height: 25px;" src="https://i.redd.it/9n242vp9u7r31.png">
                @php
                    $user=APP\Models\User::find($post->user_id);   
                @endphp
                <p class=" d-inline">posted by u/{{$user->name}} {{$post->created_at->diffForHumans()}} </p>
                <div>
                    <h1 class="medium-text"> {{$post->title}} </h1>
                </div>
                @if($post->image !=null)
                    <img class="w-100" src="{{ Storage::url($post->image) }}" style="max-height: 700px">
                @endif
            </div>
        </div>

        @endforeach
        
    </div>

@endsection