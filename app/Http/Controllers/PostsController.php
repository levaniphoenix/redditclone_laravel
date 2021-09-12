<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $user=auth()->user();

        return view("posts/createpost",[
            'user'=>$user,
        ]);
    }

    public function store()
    {
        $data=request()->validate([
            'title'=>'required',
            'description'=>'',
            'sub_reddit_id'=>'',
            'image'=>'image'
        ]);
        if(request('image')!=null)
            $imagePath=request('image')->store('uploads','public');
        else
            $imagePath=null;        
        //dd($data);
        auth()->user()->posts()->create([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'sub_reddit_id'=>$data['sub_reddit_id'],
            'image'=>$imagePath,
            'rating'=>0,
        ]);

        return redirect("home");
    }
}
