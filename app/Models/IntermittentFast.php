<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntermittentFast extends Model
{
    protected $table = "intermittent_fasting";
    protected $guarded = [];

    public function fastingClockModel(){
        return $this->hasMany('App\Models\FastingClockModel', 'client_id', 'client_id')->orderBy('id', 'DESC')->take(1);
    }

}
