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
    protected $appends = ['is_liked'];

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

}
