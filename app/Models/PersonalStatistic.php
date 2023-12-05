<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalStatistic extends Model
{
    use SoftDeletes;
    protected $table = 'personal_statistics';
    protected $guarded = [];

    // public function goalPersonalStatistics(){
    // 	return $this->belongsTo('App\GoalPersonalStatistic', 'personal_statistic_id', 'id');
    // }
}
 