<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    public function mainCategory(){
        return $this->belongsTo('App\Models\MainCategory');
    }
}
