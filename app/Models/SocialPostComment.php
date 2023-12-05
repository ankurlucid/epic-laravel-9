<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPostComment extends Model
{
   protected $guarded = [];

   public function client(){
      return $this->belongsTo('App\Models\Client','client_id','id');
  }

  public function social_post(){
     return $this->belongsTo('App\Models\SocialPost', 'post_id');
  }
    
}
