<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPostLike extends Model
{
    protected $guarded = [];

    public function social_post(){
        return $this->belongsTo('App\Models\SocialPost', 'post_id');
    }


    public function client(){
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
