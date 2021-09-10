@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/post" enctype="multipart/form-data" method="POST">
     @csrf

     <div class="form-group row">
        <div class="col-md-6 mt-3">
            <p class="border-bottom">Create a post</p>
        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <select class="form-select" id="inputGroupSelect" name="sub_reddit_id">
                <option selected value="">Choose a Community</option>
                
                <option value="">u/{{$user->name}}</option>
                
                @foreach ($user->joinedSubreddits as $subReddit)
                    <option value="{{$subReddit->id}}">r/{{$subReddit->name}}</option>
                @endforeach
              
            </select>

        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <input id="title" name="title" type="text" class="form-control" placeholder="Title">

            @error('title')
                    <strong>{{ $message }}</strong>
            @enderror
        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <textarea class="form-control" name="description" placeholder="Text(optional)" rows="4" cols="50"></textarea>
        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <input id="image" type="file" name="image" class="form-control-file">
            @error('image')
                    <strong>{{ $message }}</strong>
            @enderror
        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <button class="btn btn-primary">Post</button>
        </div>
     </div>

    </form>
    <a href="/home"> <button class="btn btn-secondary">Back</button> </a>
</div>

@endsection