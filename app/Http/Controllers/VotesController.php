<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Post;

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
        {
            self::addRating($postId);
            return auth()->user()->votes()->create(['post_id'=>$postId, 'upvote'=> true, 'downvote' => false]);
        }
        else if( $vote->upvote ==true)
        {
            self::substractRating($postId);
            return $vote->delete();
        }
        else if($vote->downvote == true)
        {
            //adding the rating twice to cancel out the first downvote
            self::addRating($postId);
            self::addRating($postId);
            return $vote->update(['upvote'=> true, 'downvote' => false]);
        }
    }

    public function storeDownvote($postId)
    {
        $vote=Vote::where(['post_id'=>$postId, 'user_id'=>auth()->user()->id])->first();
        if($vote==null)
        {
            self::substractRating($postId);
            return auth()->user()->votes()->create(['post_id'=>$postId, 'upvote'=> false, 'downvote' => true]);
        }
        else if( $vote->downvote ==true)
        {
            self::addRating($postId);
            return $vote->delete();
        }
        else if($vote->upvote == true)
        {
            //substracting twice to cancel out the upvote
            self::substractRating($postId);
            self::substractRating($postId);
            return $vote->update(['upvote'=> false, 'downvote' => true]);
        }
        
    }

    private function addRating($postId)
    {
        $post=Post::find($postId);
        return $post->update(['rating'=>($post->rating)+1]);
    }

    private function substractRating($postId)
    {
        $post=Post::find($postId);
        return $post->update(['rating'=>$post->rating-1]);
    }
}
