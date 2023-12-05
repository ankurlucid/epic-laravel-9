<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MpMealMainCategory extends Model
{
    protected $guarded = [];
    protected $table ='mpn_meal_main_categories';

    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory');
    }

}

