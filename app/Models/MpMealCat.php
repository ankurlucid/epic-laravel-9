<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MpMealCat extends Model
{  
    protected $table = 'mpn_meal_cat';
    protected $guarded = [];

    public function mealCategories(){
        return $this->belongsTo('App\Models\MpMealCategory','cat_id','id');	
   }
}
