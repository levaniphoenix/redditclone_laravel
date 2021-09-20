<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\SubReddit;
use App\Models\Post;
use App\Models\User;


class SubredditController extends Controller
{

    public function show($name)
    {
        $subReddit=SubReddit::where("name",'=', $name )->firstOrFail();

        //$posts=Post::where('sub_reddit_id','=',$subReddit->id)->get();

        $posts=DB::select('select posts.*, users.name from posts join users ON posts.user_id=users.id where posts.sub_reddit_id='. $subReddit->id);
                    

        $isJoined=(auth()->user()) ? auth()->user()->joinedSubreddits->contains($subReddit->id) : false;

        return view("showsubreddit",[
            'subreddit'=>$subReddit,
            'isJoined'=>$isJoined,
            'posts'=>$posts,
        ]);
    }

    public function create()
    {
        return view("createsubreddit");
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
