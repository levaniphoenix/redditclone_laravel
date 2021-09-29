<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        //$posts=DB::select('select posts.*, users.name from posts join users ON posts.user_id=users.id where posts.user_id=users.id order by rating DESC');
        $posts=Post::with('user','votes')->get();
        //dd($posts);
        return view('home',[
            'posts'=>$posts,
        ]);
    }

}
