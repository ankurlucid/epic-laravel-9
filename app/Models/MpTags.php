<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MpTags extends Model{

    protected $table = 'mpn_tags';
    protected $primaryKey = 'id';
    protected $fillable = ['mp_tag_name','mp_type'];
	 
}
