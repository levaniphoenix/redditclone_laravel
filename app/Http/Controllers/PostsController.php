<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    public function create()
    {
        $user=auth()->user();

        return view("posts/createpost",[
            'user'=>$user,
        ]);
    }

    public function index(User $user)
    {
        
        return view('users/userposts',[
            'user'=>$user,
        ]);
    }

    public function show(Post $post)
    {
        $userName=DB::select('select users.name from users where users.id = '. $post->user_id);
        
        return view("posts/showpost",[
            'post'=>$post,
            'poster'=>$userName[0],
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
