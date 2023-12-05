<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $guarded = [];

    private $like_count = null;
    private $comment_count = null;

    // public function social_post_image(){
    //     return $this->belongsTo('App\SocialPostImage','id','post_id');
    // }
     public function social_post_image(){
        return $this->hasMany('App\Models\SocialPostImage','post_id','id');
    }
    public function social_post_video(){
        return $this->belongsTo('App\Models\SocialPostVideo','id','post_id');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client','client_id','id');
    }
    public function goal_client(){
        return $this->belongsTo('App\Models\Client','goal_client_id','id');
    }
    public function soical_likes(){
        return $this->hasMany('App\Models\SocialPostLike', 'post_id', 'id');
    }

    public function soical_comments(){
        return $this->hasMany('App\Models\SocialPostComment', 'post_id', 'id');
    }
    public function getLikeCount(){
        if ($this->like_count == null){
            $this->like_count = $this->soical_likes()->count();
        }
        return $this->like_count;
    }

    public function checkLike($user_id){
        if ($this->soical_likes()->where('client_id', $user_id)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function getCommentCount(){
        if ($this->comment_count == null){
            $this->comment_count = $this->soical_comments()->count();
        }
        // dd($this->comment_count);
        return $this->comment_count;
    }


    public function checkOwner($user_id){
        dd($this->client_id);
        if ($this->client_id == $user_id)return true;
        return false;
    }


}
