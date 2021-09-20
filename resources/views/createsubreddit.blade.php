@extends('layouts.app')

@section('content')

<div class="container pt-4">
    <form action="/subreddit" enctype="multipart/form-data" method="POST">
     @csrf

     <div class="form-group row">
        <div class="col-md-6">
            <p class="border-bottom">Create a Community</p>
        </div>
     </div>

     <div class="form-group row">
        <div class="col-md-6">
            <input id="name" name="name" type="text" class="form-control" placeholder="name your community">

            @error('name')
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