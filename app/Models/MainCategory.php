<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $guarded = [];

    public function subCategory(){
        return $this->hasMany('App\Models\SubCategory');
    }
}
