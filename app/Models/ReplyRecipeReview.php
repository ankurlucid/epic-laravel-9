<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyRecipeReview extends Model
{
    protected $guarded = [];
    private $upvote_count = null;

    public function client(){
        return $this->belongsTo('App\Models\Clients','client_id','id');
    }

    // public function replyReviewUpvote(){
    //     return $this->hasMany('App\ReviewUpvote', 'review_id', 'id');
    //  }

     public function reviewUpvote(){
        return $this->hasMany('App\Models\ReviewUpvote', 'review_id', 'id')->where('type','Reply');
     }

    public function getUpvoteCount(){
        if ($this->upvote_count == null){
            $this->upvote_count = $this->ReviewUpvote()->count();
        }
        return $this->upvote_count;
     }

     public function checkLike($user_id){
        if ($this->reviewUpvote()->where('client_id', $user_id)->first()){
            return true;
        }else{
            return false;
        }
    }
}
