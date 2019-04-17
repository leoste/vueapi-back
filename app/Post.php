<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public $fillable = [
      'title',
      'content',
    ];
    protected $appends = [
        'is_liked',
        'is_disliked',
        'score',
        'likes_count',
        'dislikes_count'
    ];
    protected $with = ['images'];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function getIsLikedAttribute()
    {
        $user = Auth::user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->where('value', 1)->exists();
        }
        return false;
    }
    public function getIsDislikedAttribute()
    {
        $user = Auth::user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->where('value', -1)->exists();
        }
        return false;
    }
    public function getScoreAttribute()
    {
        return (int) $this->likes()->select('value')->sum('value');
    }
    public function getLikesCountAttribute()
    {
        return $this->likes()->where('value', 1)->count();
    }
    public function getDislikesCountAttribute()
    {
        return $this->likes()->where('value', -1)->count();
    }
}
