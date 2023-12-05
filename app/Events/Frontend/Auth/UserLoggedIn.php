<?php
namespace App\Events\Frontend\Auth;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Session;
use App\Models\Business;
use App\Models\LocationArea;
use App\Http\Traits\ChartSettingTrait;
use App\Http\Traits\SalesTools\Invoice\SalesToolsInvoiceTrait;
use App\Http\Traits\HelperTrait;
/**
 * Class UserLoggedIn
 * @package App\Events\Frontend\Auth
 */
class UserLoggedIn extends Event{
    use SerializesModels, SalesToolsInvoiceTrait, ChartSettingTrait, HelperTrait;

    public $user;

    public function __construct($user){
        $this->user = $user;
        //Session::put('userType', $this->user->account_type);

        $business =  Business::find($this->user->business_id);
        if($business){
            Session::put('businessId', $business->id);
            Session::put('hostname', 'crm');
            //Session::put('timeZone', $business->time_zone);

            if($business->locations()->exists())
                Session::put('ifBussHasLocations', true);

            if(LocationArea::join('locations', 'la_location_id', '=', 'id')->where('business_id', $business->id)->whereNull('locations.deleted_at')->whereNull('location_areas.deleted_at')->count())
                Session::put('ifBussHasAreas', true);

            if($business->staffs()->exists())
                Session::put('ifBussHasStaffs', true);

            if($business->services()->exists())
                Session::put('ifBussHasServices', true);

            if($business->classes()->exists())
                Session::put('ifBussHasClasses', true);

            if($business->products()->exists())
                Session::put('ifBussHasProducts', true);

            if($business->clients()->exists())
                Session::put('ifBussHasClients', true);

            if($business->contacts()->exists())
                Session::put('ifBussHasContacts', true);

            if($business->salesToolsDiscounts()->exists())
                Session::put('ifBussHasSalesToolsDiscounts', true);

            if($business->resources()->exists())
                Session::put('ifBussHasResources', true);

            if($business->closedDates()->exists())
                Session::put('ifBussHasClosedDates', true);

            /*if($business->administrators()->exists())
                Session::put('ifBussHasAdministrators', true);*/
            if($business->administrators($business->id, $business->user_id))
                Session::put('ifBussHasAdministrators', true);

            /*if($business->salesToolsInvoice()->exists())
                Session::put('ifBussHasSalesToolsInvoice', true);*/

            if($business->user_id == $this->user->id)
                Session::put('isSuperUser', true);
            else
                Session::put('isSuperUser', false);
            /*Start: check callender setting record in db or no if no its create callender setting.*/
            /*$calendarID = CalendarSetting::select('id')->where('cs_business_id',$business->id)->first();*/
            
            // if(!$business->calendarSetting()->exists())
            //     $this->createCalendarSettings();

            /*End: check callender setting record in db or no if no its create callender setting.*/

            if(!$business->salestoolsInvoice()->exists())
                $this->createInvoice();

            if(!$business->chartSetting()->exists())
                $this->createChartSetting();

            //$tz=$business->pluck('time_zone');
            Session::put('timeZone', $business->time_zone);
            $this->setTimeZone();


        }
    }
}
