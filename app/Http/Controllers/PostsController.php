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
        return view("posts/createpost");
    }

    public function store()
    {
        $data=request()->validate([
            'title'=>'required',
            'description'=>'',
            'image'=>'image'
        ]);
        if(request('image')!=null)
            $imagePath=request('image')->store('uploads','public');
        else
            $imagePath=null;        
        
        auth()->user()->posts()->create([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'image'=>$imagePath,
        ]);

        return redirect("home");
    }
}
