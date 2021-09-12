<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeUpvote($postId)
    {
        $vote=Vote::where(['post_id'=>$postId, 'user_id'=>auth()->user()->id])->first();
        if($vote ==null)
            return auth()->user()->votes()->create(['post_id'=>$postId, 'upvote'=> true, 'downvote' => false]);
        else if( $vote->upvote ==true)
            return $vote->delete();
        else if($vote->downvote == true)
            return $vote->update(['upvote'=> true, 'downvote' => false]);
    }

    public function storeDownvote($postId)
    {
        $vote=Vote::where(['post_id'=>$postId, 'user_id'=>auth()->user()->id])->first();
        if($vote==null)
            return auth()->user()->votes()->create(['post_id'=>$postId, 'upvote'=> false, 'downvote' => true]);
        else if( $vote->downvote ==true)
            return $vote->delete();
        else if($vote->upvote == true)
            return $vote->update(['upvote'=> false, 'downvote' => true]);
    }
}
