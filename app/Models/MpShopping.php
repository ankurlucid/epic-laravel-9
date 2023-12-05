<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class MpShopping extends Model
{

    protected $table = 'mp_shopping';
    protected $primaryKey = 'id';
    protected $fillable = ['created_date','shopping_guid','user_id'];
    
}