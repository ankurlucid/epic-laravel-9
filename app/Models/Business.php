<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Access\User\User;

class Business extends Model{
    protected $table = 'businesses';
    protected $fillable = ['trading_name', 'type', 'relationship', 'cp_first_name', 'cp_last_name', 'cp_web_url', 'description', 'currency', 'time_zone', 'logo', 'website', 'facebook', 'email', 'phone', 'address_line_one', 'address_line_two', 'city', 'country', 'state', 'postal_code', 'venue_location', 'billing_info','is_class_step_complete'];
    
    public function user(){
        return $this->belongsTo('App\Models\Access\User\User');
    }

    public function userChild(){
        return $this->hasOne('App\Models\Access\User\User', 'business_id');
    }
	
	static function getBusinessTypes($userId){
        return DB::table('business_types')->whereIn('bt_user_id', [0, $userId])->pluck('bt_value', 'bt_id')->toArray();
	}
	
	public function locations(){
        return $this->hasMany('App\Models\Location', 'business_id');
    }
    public function locationsWithTrashed(){
        return $this->locations()->withTrashed();
    }

	public function staffs(){
        return $this->hasMany('App\Models\Staff', 'business_id');
    }
	
	public function services(){
        return $this->hasMany('App\Models\Service', 'business_id');
    }

    public function completedServices(){
        return $this->services()->where('is_completed', 1);
    }

    public function classes(){
        return $this->hasMany('App\Models\Clas', 'cl_business_id');
    }

    public function sessionrole(){
        return $this->hasMany('App\Models\SessionRole', 'sr_businesses_id');
    }

    public function commissionrole(){
        return $this->hasMany('App\Models\CommissionRole', 'cr_businesses_id');
    }

    public function commissionsource(){
        return $this->hasMany('App\Models\CommissionSource', 'cr_businesses_id');
    }

    /*public function commissioncategory(){
        return $this->hasMany('App\Models\CommissionCategory', 'cc_businesses_id');
    }*/

    public function incomecategory(){
        return $this->hasMany('App\Models\IncomeCategory', 'business_id');
    }

    public function membershipcategory(){
        return $this->hasMany('App\Models\MemberShipCategory', 'mc_businesses_id');
    }

    public function membershipgroup(){
        return $this->hasMany('App\Models\MemberShipGroup', 'mg_businesses_id');
    }

    public function membershiptax(){
        return $this->hasMany('App\Models\MemberShipTax', 'mtax_business_id');
    }

    public function membership(){
        return $this->hasMany('App\Models\MemberShip', 'me_business_id');
    }

    public function classCats(){
        return $this->hasMany('App\Models\ClassCat', 'clcat_business_id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product', 'business_id');
    }

	public function clients(){
        return $this->hasMany('App\Models\Clients', 'business_id');
    }

    public function contacts(){
        return $this->hasMany('App\Models\Contact', 'business_id');
    }

    public function typeName(){
        return $this->belongsTo('App\Models\BusinessType', 'type');
    }

    public function salesToolsDiscounts(){
        return $this->hasMany('App\Models\SalesToolsDiscount', 'std_business_id');
    }

    public function resources(){
        return $this->hasMany('App\Models\Resource', 'res_business_id');
    }
    
    public function closedDates(){
        return $this->hasMany('App\Models\ClosedDate', 'cd_business_id');
    }

    public function calendarSetting(){
        return $this->hasOne('App\Models\CalendarSetting', 'cs_business_id')->where('cs_client_id', 0);
    }

    public function chartSetting(){
        return $this->hasOne('App\Models\ChartSetting', 'chart_business_id');
    }

    public function salestoolsInvoice(){
        return $this->hasOne('App\Models\SalesToolsInvoice', 'sti_business_id');
    }

    /*public function administrators(){
        return $this->hasMany('App\Administrator', 'admin_business_id');
    }*/

    static function administrators($bussId, $superUserId = 0){
        if($superUserId)
            return User::where('business_id', $bussId)->where('account_type', 'Admin')->where('id', '!=', $superUserId)->exists();
        else
            return User::join('businesses', 'businesses.id', '=', 'business_id')->where('account_type', 'Admin')->where('businesses.id', $bussId)->whereRaw('users.id != user_id')->exists();
    }

    static function phoneNumbExist($numb, $id=0){
        $query =  Business::where('phone', $numb);
        if($id)
            $query->where('id', '<>', $id);
        return $query->exists();
    }
}
