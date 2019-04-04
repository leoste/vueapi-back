<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function undislikePost($id){
        return $this->removeLike($id);
    }
    public function unlikePost($id){
        return $this->removeLike($id);
    }

    private function removeLike($id){
        $user = Auth::user();
        $post = Post::where('id', $id)->with('images')->first();
        $like = $post->likes()->where('user_id', $user->id)->first();
        $like->delete();
        return $post;
    }

    public function likePost($id){
        return $this->saveLike(1, $id);
    }
    public function dislikePost($id){
        return $this->saveLike(-1, $id);
    }

    private function saveLike($value, $id){
        $user = Auth::user();
        $post = Post::where('id', $id)->with('images')->first();
        if($user && $post){
            $like = $user->likes()->where('post_id', $id)->first();
            if($like){
                $like->value = $value;
            } else {
                $like = new Like(['value' => $value]);
                $like->post()->associate($post);
                $like->user()->associate($user);
            }
            $like->save();
        }
        return $post;
    }


}
