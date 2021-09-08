<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\SubReddit;


class SubredditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($name)
    {
        $subreddit=SubReddit::where("name",'=', $name )->firstOrFail();

        return view("subreddits\showsubreddit",[
            'subreddit'=>$subreddit,
        ]);
    }

    public function create()
    {
        return view("subreddits\createsubreddit");
    }

    public function store()
    {
        $data=request()->validate([
            'name'=>'required|max:21',
            'description'=>'',
            'image'=>'image'
        ]);
        
        $imagePath=null;
        if(request('image')!=null)
            $imagePath=request('image')->store('uploads','public');

        if(SubReddit::where("name",'=', $data['name'] )->first() !=null)
            throw ValidationException::withMessages(['name' => 'subreddit with this name already exists']);

        auth()->user()->subreddits()->create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'image'=>$imagePath,
        ]);

        return redirect("home");
    }
}
