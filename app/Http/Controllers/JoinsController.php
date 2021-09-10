<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubReddit;

class JoinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(SubReddit $subReddit){
        //$subreddit=SubReddit::where("id","=",$subredditId)->first();
                
        return auth()->user()->joinedSubreddits()->toggle($subReddit);
    }
}
