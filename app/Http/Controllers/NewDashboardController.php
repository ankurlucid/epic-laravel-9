<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Clients;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\Parq;
use App\Models\Business;
use App\Models\Service;
use App\Models\Task;
use App\Models\TaskReminder;
use App\Models\StaffEventRepeat;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Auth;
use App\Http\Traits\HelperTrait;
use Input;
use App\Http\Traits\StaffEventsTrait;
use App\Models\StaffEventSingleService;
use App\Models\StaffEventClass;
use App\Models\StaffEventBusy;
use App\Models\Staff;
use App\Models\ChartSetting;
use App\Models\Clas;
use Config;
use DateTimeZone;
use DateTime;
use App\Models\Access\User\User;
use App\Models\TaskRepeat;
use App\Models\ClientAccountStatusGraph;
use App\Models\StaffEventHistory;
use Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewDashboardController extends Controller
{
  use StaffEventsTrait, HelperTrait;

   /**
   * Show dashboard view
   *
   * @param void
   * @return dashboard view
   */
  public function show()
  {
    $bussUsers = null;
    $eventRepeatIntervalOpt = null;
    $tc = null;
    $clients_chart = null;
    $sales_chart = null;
    if (Session::has('businessId')) {
      $business = Business::findOrFail(Session::get('businessId'));
      $countries = \Country::getCountryLists();
      $business->stateName = \Country::getStateName($business->country, $business->state);
      $business->currencyInFull = \Currency::$currencies[$business->currency];
      $default_completed_service = Service::defaultAndComplCount();


      $this->neverEndTaskRepeats();
      $taskcategories = TaskCategory::where('t_cat_business_id', $business->id)->orWhere('t_cat_business_id', 0)->orderBy('id', 'asc')->get();

      $personalCatId = $taskcategories->where('t_cat_business_id', 0)->where('t_cat_user_id', 0)->pluck('id')->first();
      $tasks = $this->categoryTask($personalCatId);

      $bussUsers = [];
      if (isSuperUser()) {
        $bussUsers = User::where('business_id', Session::get('businessId'))->whereIn('account_type', ['Admin', 'Staff'])->where('id', '!=', Auth::id())->get();
      }

      $newdata = [];
      $newdata = $this->getTc($taskcategories, $bussUsers);
      $tc = [];
      $tc = $newdata['tc'];
      $eventRepeatIntervalOpt = $newdata['eventRepeatIntervalOpt'];
    } else {
      $business = null;
      $countries = [];
      $default_completed_service = 0;
      $tasks = null;
      $taskcategories = null;
    }

    $MaxNumofClients = 0;
    if (Session::has("ifBussHasClients")) {
      //Start: pie chart 1
      
      $getAllCount = Clients::ofBusiness()
      ->selectRaw('count(IF(account_status = "Active", 1, null)) as count_active')
      ->selectRaw('count(IF(account_status = "Contra", 1, null)) as count_contra')
      ->selectRaw('count(IF(account_status = "Inactive", 1, null)) as count_inactive')
      ->selectRaw('count(IF(account_status = "On Hold", 1, null)) as count_onhold')
      ->selectRaw('count(IF(account_status = "Pending", 1, null)) as count_pending')
      ->selectRaw('count(IF(account_status = "Pre-Consultation", 1, null)) as count_pre_preconsult')
      ->selectRaw('count(IF(account_status = "Pre-Benchmarking", 1, null)) as count_pre_benchmark')
      ->selectRaw('count(IF(account_status = "Pre-Training", 1, null)) as count_pre_training')
      ->selectRaw('count(IF(account_status != "Active", 1, null) AND IF(account_status != "Contra", 1, null) AND IF(account_status != "Inactive", 1, null) AND IF(account_status != "On Hold", 1, null) AND IF(account_status != "Pending", 1, null)) as count_other')
      ->first();

      // dd($getAllCount);

      $count_active = (isset($getAllCount) && isset($getAllCount->count_active)) ? $getAllCount->count_active : 0; 
      $count_contra = (isset($getAllCount) && isset($getAllCount->count_contra)) ? $getAllCount->count_contra : 0; 
      $count_inactive = (isset($getAllCount) && isset($getAllCount->count_inactive)) ? $getAllCount->count_inactive : 0; 
      $count_onhold = (isset($getAllCount) && isset($getAllCount->count_onhold)) ? $getAllCount->count_onhold : 0; 
      $count_pending = (isset($getAllCount) && isset($getAllCount->count_pending)) ? $getAllCount->count_pending : 0; 
      $count_other = (isset($getAllCount) && isset($getAllCount->count_other)) ? $getAllCount->count_other : 0; 

      $totalclients = $count_active + $count_contra + $count_inactive + $count_onhold + $count_pending + $count_other;

      $totalclients = $count_active + $count_contra + $count_inactive + $count_onhold + $count_pending + $count_other;

      $total_active = $this->percentageCalculator($count_active, $totalclients);
      $total_contra = $this->percentageCalculator($count_contra, $totalclients);
      $total_inactive = $this->percentageCalculator($count_inactive, $totalclients);
      $total_onhold = $this->percentageCalculator($count_onhold, $totalclients);
      $total_pending = $this->percentageCalculator($count_pending, $totalclients);
      $total_other = $this->percentageCalculator($count_other, $totalclients);
      //End: pie chart 1

      //Start: pie chart 2
      $count_lead = (isset($getAllCount) && isset($getAllCount->count_pending)) ? $getAllCount->count_pending : 0; 
      $count_pre_preconsult = (isset($getAllCount) && isset($getAllCount->count_pre_preconsult)) ? $getAllCount->count_pre_preconsult : 0; 
      $count_pre_benchmark = (isset($getAllCount) && isset($getAllCount->count_pre_benchmark)) ? $getAllCount->count_pre_benchmark : 0; 
      $count_pre_training = (isset($getAllCount) && isset($getAllCount->count_pre_training)) ? $getAllCount->count_pre_training : 0; 

      // dd($count_pre_preconsult,$count_pre_benchmark,$count_pre_training);

      $totalclients2 = $count_lead + $count_pre_preconsult + $count_pre_benchmark + $count_pre_training;
      $total_lead = $this->percentageCalculator($count_lead, $totalclients);
      $total_pre_preconsult = $this->percentageCalculator($count_pre_preconsult, $totalclients);
      $total_pre_benchmark = $this->percentageCalculator($count_pre_benchmark, $totalclients);
      $total_pre_training = $this->percentageCalculator($count_pre_training, $totalclients);
      //End: pie chart 2

      //Start : Graph Chart

      $MaxNumofPerks = 0;
      for ($i = 0; $i < 12; $i++) {
        $current = Carbon::now();
        $getMonth = $current->subMonth($i);

        $startOfMonth = $getMonth->StartOfMonth()->toDateTimeString();
        $endOfMonth = $getMonth->EndOfMonth()->toDateTimeString();
          
        $getAllClientCount = ClientAccountStatusGraph::where('business_id', Session::get('businessId'))
          ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
          ->selectRaw('count(IF(account_status = "Inactive", 1, null)) as count_inactive_clients')
          ->selectRaw('count(IF(account_status = "On Hold", 1, null)) as count_onhold_clients')
          ->selectRaw('count(IF(account_status = "Active", 1, null)) as count_new_client')
          ->first();
            
        $count_inactive_clients[] = (isset($getAllClientCount) && isset($getAllClientCount->count_inactive_clients)) ? $getAllClientCount->count_inactive_clients : 0; 
        
        $count_onhold_clients[] = (isset($getAllClientCount) && isset($getAllClientCount->count_onhold_clients)) ? $getAllClientCount->count_onhold_clients : 0; 

        $count_new_client[] = (isset($getAllClientCount) && isset($getAllClientCount->count_new_client)) ? $getAllClientCount->count_new_client : 0; 
      }

      $MaxNumofClients = max(max($count_inactive_clients), max($count_new_client), max($count_onhold_clients));
      
      //End : Graph Chart

    } else {
      $count_active = $count_contra = $count_inactive = $count_onhold = $count_pending = $count_other = $totalclients = $total_active = $total_contra = $total_inactive = $total_onhold = $total_pending = $total_other = $count_lead = $count_pre_preconsult = $count_pre_benchmark = $count_pre_training = $totalclients2 = $total_lead = $total_pre_preconsult = $total_pre_benchmark = $total_pre_training =/*$MaxNumofClients=*/ 0;
      $count_inactive_clients = $count_onhold_clients = $count_new_client = [];
    }
    if (!$MaxNumofClients)
      $MaxNumofClients = 5;
    /*Start: ---- SALES and PRODUCTIVITY Stack bar ------ */

    $dt = Carbon::now();
    $ad = $dt->addDays(7)->toDateString();
    $dt = Carbon::now();
    $sd = $dt->subDays(6)->toDateString();

    $service_details = StaffEventSingleService::select('sess_id', 'sess_booking_status', 'sess_date', 'sess_price', 'sess_duration', 'sess_client_attendance')->where('sess_business_id', Session::get('businessId'))->where('sess_date', '>=', $sd)->where('sess_date', '<=', $ad)->orderBy('sess_date')->get();

    $class_details = StaffEventClass::with(/*array(*/'clients'/*=>function($query){$query->sele;})*/)->select('sec_id', 'sec_date', 'sec_price', 'sec_duration')->where('sec_business_id', Session::get('businessId'))->where('sec_date', '>=', $sd)->where('sec_date', '<=', $ad)->orderBy('sec_date')->get();

    $busyTime = StaffEventBusy::select('seb_duration', 'seb_date')->where('seb_business_id', Session::get('businessId'))->where('seb_date', '>=', $sd)->where('seb_date', '<=', $ad)->orderBy('seb_date')->get();

    $averageSale = StaffEventSingleService::where('sess_business_id', Session::get('businessId'))
      ->where('sess_client_attendance', 'Attended')
      ->avg('sess_price');
    $cd = Carbon::now();
    $last7daysAverageSale = StaffEventSingleService::where('sess_business_id', Session::get('businessId'))
      ->where('sess_client_attendance', 'Attended')
      ->where('sess_date', '>=', $sd)
      ->where('sess_date', '<=', $cd)
      ->avg('sess_price');

    $staff_working_hour = Staff::select('staff.id', 'sa_start_time', 'sa_end_time', 'edited_start_time', 'edited_end_time', 'sa_date')
      ->leftJoin('staff_attendences', function ($join) {
        $join->on('staff.id', '=', 'staff_attendences.sa_staff_id');
      })
      ->where('business_id', Session::get('businessId'))
      ->where('sa_status', '<>', 'unattended')
      ->where('sa_date', '>=', $sd)
      ->where('sa_date', '<=', $ad)
      ->get();


    $datewise_working_hour = [];
    if (count($staff_working_hour)) {
      foreach ($staff_working_hour as  $value) {
        if ($value->edited_start_time != null) {
          if (array_key_exists($value->sa_date, $datewise_working_hour))
            $datewise_working_hour[$value->sa_date] += ((strtotime($value->edited_end_time) - strtotime($value->edited_start_time)) / 60);
          else
            $datewise_working_hour[$value->sa_date] = ((strtotime($value->edited_end_time) - strtotime($value->edited_start_time)) / 60);
        } else {
          if (array_key_exists($value->sa_date, $datewise_working_hour))
            $datewise_working_hour[$value->sa_date] += ((strtotime($value->sa_end_time) - strtotime($value->sa_start_time)) / 60);
          else
            $datewise_working_hour[$value->sa_date] = ((strtotime($value->sa_end_time) - strtotime($value->sa_start_time)) / 60);
        }
      }
    }
    $week_working_hour = Staff::select('id', 'hr_day', /*DB::raw('SUM(TIMESTAMPDIFF(MINUTE, hr_start_time, hr_end_time)) AS workingTime'))*/ DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(hr_end_time, hr_start_time))/60) AS workingTime'))
      ->leftJoin('hours', function ($join) {
        $join->on('staff.id', '=', 'hours.hr_entity_id');
      })
      ->where('business_id', Session::get('businessId'))
      ->where('hr_entity_type', 'staff')
      ->groupBy('hr_day')
      ->get();
    /* End: fatch total working hour */

    /*Start: Loop for find no. of clients and multiplay with price*/
    $datewise_class_val = [];
    $datewise_cls_time = [];
    $date_exists = [];
    if (count($class_details)) {
      foreach ($class_details as $key => $value) {
        if (array_key_exists($value->sec_date, $datewise_cls_time))
          $datewise_cls_time[$value->sec_date] += $value->sec_duration;
        else
          $datewise_cls_time[$value->sec_date] = $value->sec_duration;
        $price = 0;
        foreach ($value->clients as $keys => $val) {
          if ($val->pivot->secc_reduce_rate != null) {
            $price += $val->pivot->secc_reduce_rate;
          } else {
            $price += $value->sec_price;
          }
        }
        if (array_key_exists($value->sec_date, $datewise_class_val))
          $datewise_class_val[$value->sec_date] += round($price);
        else
          $datewise_class_val[$value->sec_date] = round($price);
      }
    }

    /*Start: calculate busy time acording to date.*/
    $datewise_busy_time = [];
    if (count($busyTime)) {
      foreach ($busyTime as $key => $value) {
        $datewise_busy_time[$value->seb_date] = $value->seb_duration;
      }
    }
    /*End: calculate busy time acording to date.*/

    $confirmed_value = [];
    $pencil_value = [];
    $conf_time = [];
    $pencil_time = [];
    $attended_time = [];
    $conf_pre_val = [];
    $pencil_pre_val = [];
    $notshow_pre_val = [];
    $datewise_conf_val = [];
    $datewise_pencil_val = [];
    $datewise_conf_time = [];
    $datewise_pencil_time = [];
    $datewise_notshow_time = [];
    $datewise_attended_time = [];
    $notshow_time = [];
    $i = -1;
    $j = -1;
    $k = -1;
    $m = -1;
    if (count($service_details)) {
      foreach ($service_details as $key => $value) {
        if ($value->sess_booking_status == 'Confirmed') {
          if ($value->sess_client_attendance != 'Did not show') {
            if (array_key_exists($value->sess_date, $datewise_conf_val)) {
              $datewise_conf_val[$value->sess_date] += floor($value->sess_price);
            } else {
              $datewise_conf_val[$value->sess_date] = floor($value->sess_price);
            }

            if ($value->sess_client_attendance == 'Attended') {
              if (array_key_exists($value->sess_date, $datewise_attended_time)) {
                $datewise_attended_time[$value->sess_date] += $value->sess_duration;
              } else {
                $datewise_attended_time[$value->sess_date] = $value->sess_duration;
              }
            }
            if ($value->sess_client_attendance == 'Booked') {
              if (array_key_exists($value->sess_date, $datewise_conf_time)) {
                $datewise_conf_time[$value->sess_date] += $value->sess_duration;
              } else {
                $datewise_conf_time[$value->sess_date] = $value->sess_duration;
              }
            }
          } else {
            if (in_array($value->sess_date, $notshow_pre_val)) {
              $notshow_time[$k] += $value->sess_duration;
            } else {
              $k++;
              $notshow_time[$k] = $value->sess_duration;
              $notshow_pre_val[] = $value->sess_date;
            }
            $datewise_notshow_time[$value->sess_date] = $notshow_time[$k];
          }
        } elseif ($value->sess_booking_status == 'Pencilled-In') {
          if (in_array($value->sess_date, $pencil_pre_val)) {
            $pencil_value[$j] += floor($value->sess_price);
            $pencil_time[$j] += $value->sess_duration;
          } else {
            $j++;
            $pencil_value[$j] = floor($value->sess_price);
            $pencil_time[$j] = $value->sess_duration;
            $pencil_pre_val[] = $value->sess_date;
          }

          $datewise_pencil_val[$value->sess_date] = $pencil_value[$j];
          $datewise_pencil_time[$value->sess_date] = $pencil_time[$j];
        }
      }
    }

    $dt = date('Y-m-d');
    $md = date('Y-m-d', strtotime("$dt -6 day"));

    $cls_time = [];
    $busy_time = [];
    $attended_time = [];
    $notshow_time = [];
    $conf_time = [];
    $pen_time = [];
    $total_working_time = [];
    $final_conf = [];
    $final_pencil = [];
    $sd = $md;
    /* Start: fatch data datewise and store value in index array  */
    for ($i = 0; $i < 14; $i++) {
      /*------ for confirmed and class total sales value ------*/
      if (array_key_exists($sd, $datewise_conf_val) && array_key_exists($sd, $datewise_class_val)) {
        $final_conf[] = ($datewise_conf_val[$sd] + $datewise_class_val[$sd]);
      } elseif (array_key_exists($sd, $datewise_conf_val)) {
        $final_conf[] = $datewise_conf_val[$sd];
      } elseif (array_key_exists($sd, $datewise_class_val)) {
        $final_conf[] = $datewise_class_val[$sd];
      } else {
        $final_conf[] = 0;
      }
      /*------ for penciled-In total sales value -----*/
      if (array_key_exists($sd, $datewise_pencil_val)) {
        $final_pencil[] = $datewise_pencil_val[$sd];
      } else {
        $final_pencil[] = 0;
      }
      /*----- for confirmed total time -----*/
      if (array_key_exists($sd, $datewise_conf_time)) {
        $conf_time[] = $datewise_conf_time[$sd];
      } else {
        $conf_time[] = 0;
      }
      /*----- for penciled-in total time -------*/
      if (array_key_exists($sd, $datewise_pencil_time)) {
        $pen_time[$i] = $datewise_pencil_time[$sd];
      } else {
        $pen_time[] = 0;
      }
      /*------ for did not show total time ------ */
      if (array_key_exists($sd, $datewise_notshow_time)) {
        $notshow_time[] = $datewise_notshow_time[$sd];
      } else {
        $notshow_time[] = 0;
      }
      /*---- for attended total time ------*/
      if (array_key_exists($sd, $datewise_attended_time)) {
        $attended_time[] = $datewise_attended_time[$sd];
      } else {
        $attended_time[] = 0;
      }
      /*----------- for busy time ---------------*/
      if (array_key_exists($sd, $datewise_busy_time)) {
        $busy_time[] = $datewise_busy_time[$sd];
      } else {
        $busy_time[] = 0;
      }
      /*-------- for class time ------------*/
      if (array_key_exists($sd, $datewise_cls_time)) {
        $cls_time[] = $datewise_cls_time[$sd];
      } else {
        $cls_time[] = 0;
      }
      /* ----for daywise working hour -----*/
      if (array_key_exists($sd, $datewise_working_hour)) {
        $total_working_time[] = $datewise_working_hour[$sd];
      } elseif (count($week_working_hour)) {
        $day_name = date('l', strtotime($sd));
        $record = $week_working_hour->where('hr_day', $day_name)->first();
        if ($record) {
          $total_working_time[] = (int) $record->workingTime;
        } else {
          $total_working_time[] = 0;
        }
      } else {
        $total_working_time[] = 0;
      }
      /*---Increse one day in every cycle----*/
      $sd = date('Y-m-d', strtotime("$sd +1 day"));
    }
    /* End: fatch data datewise and store value in index array  */

    $maxTime = ceil(max($total_working_time) / 60);
    if ($maxTime <= 36)
      $maxTime = 36;
    $max_conf = max($final_conf);
    $max_pencil = max($final_pencil);
    $maxVal = $max_pencil + $max_conf;
    if (!$maxVal)
      $maxVal = 8;
    /*Start: get previous week total service peice */
    $last_14days_price = 0;
    $last_7days_price = 0;
    if (Session::has('businessId')) {
      $monday_date = date('Y-m-d', strtotime("previous monday"));
      $sales = DB::table('sales')->select('sal_id', 'sal_services', 'sal_total')
        ->where('sal_weekDate', $monday_date)
        ->where('sal_business_id', Session::get('businessId'))
        ->first();
      if ($sales !=null) {
        $last_7days_price = $sales->sal_services;
        $total_7days_price = $sales->sal_total;
      } else {
        $dt = Carbon::now();
        $last_14days = $dt->subDays(13)->toDateString();
        $dt = Carbon::now();
        $last_7days = $dt->subDays(6)->toDateString();
        $current_day = Carbon::now()->toDateString();

        $salesprice = StaffEventSingleService::select('sess_id', 'sess_price', 'sess_date')->where('sess_client_attendance', 'Attended')->where('sess_business_id', Session::get('businessId'))->where('sess_date', '>=', $last_14days)->where('sess_date', '<=', $current_day)->orderBy('sess_date')->get();

        foreach ($salesprice as $key => $value) {
          if ($value->sess_date < $last_7days) {
            $last_14days_price += $value->sess_price;
          } else {
            $last_7days_price += $value->sess_price;
          }
        }
        $data = [];
        $data['sal_business_id'] = Session::get('businessId');
        $data['sal_weekDate'] = $monday_date;
        $data['sal_services'] = $last_7days_price;
        $data['created_at'] = createTimestamp();;
        if (count($data))
          DB::table('sales')->insert($data);
      }
    }
    /*End: get previous week total service peice */
    /*End: ---- SALES Stack bar ------ */

    /* Start: chart setting */
    $chartsetting = ChartSetting::select('chart_type', 'chart_setting_data')->where('chart_business_id', Session::get('businessId'))->get();
    if (count($chartsetting)) {
      $clients_chart = $chartsetting->where('chart_type', 'clientsChart')->first();
      $sales_chart = $chartsetting->where('chart_type', 'salesProChart')->first();

      $clients_chart = $clients_chart->chart_setting_data;
      $sales_chart = $sales_chart->chart_setting_data;
    }

    /* Start: Business Users Limit */
    $usersLimitData = null;
    if ($business) {
      $adminUser = User::with('usersLimit')->find($business->user_id);
      if(isset($adminUser) && $adminUser->usersLimit != null) {
        $usersLimitData['usersLimit'] = $adminUser->usersLimit->maximum_users;
        $usersLimitData['price'] = $adminUser->usersLimit->price;
      }
    }
    /* End: Business Users Limit */

    if (isUserType(['Admin'])) {
      return view('dashboard.show', compact('count_active', 'count_contra', 'count_inactive', 'count_onhold', 'count_pending', 'count_other', 'totalclients', 'total_active', 'total_contra', 'total_inactive', 'total_onhold', 'total_pending', 'total_other', 'count_lead', 'count_pre_preconsult', 'count_pre_benchmark', 'count_pre_training', 'totalclients2', 'total_lead', 'total_pre_preconsult', 'total_pre_benchmark', 'total_pre_training', 'count_inactive_clients', 'count_onhold_clients', 'MaxNumofClients', 'count_new_client', 'business', 'countries', 'default_completed_service', 'tasks', 'taskcategories', 'bussUsers', 'eventRepeatIntervalOpt', 'tc', 'final_conf', 'final_pencil', 'maxVal', 'pen_time', 'conf_time', 'notshow_time', 'attended_time', 'busy_time', 'cls_time', 'last_14days_price', 'last_7days_price', 'total_working_time', 'averageSale', 'last7daysAverageSale', 'maxTime', 'clients_chart', 'sales_chart', 'usersLimitData'));
    } else {
      return view('dashboard.staffshow', compact('business', 'tasks', 'taskcategories', 'bussUsers', 'eventRepeatIntervalOpt', 'tc'));
    }
  }

  protected function categoryTask($catId = 0, $duedate = '', $ownerId = 0)
  {

    if (!$duedate)
      $duedate = Carbon::now()->toDateString();

    if (!$catId) {
      /*$commonCategory = TaskCategory::where('t_cat_user_id',0)->where('t_cat_business_id',0)->select('id')->first();
          $commonCategoryId = $commonCategory->id;*/

      $commonCategoryId = TaskCategory::where('t_cat_user_id', 0)->where('t_cat_business_id', 0)->pluck('id')->toArray();
      //$commonCategoryId = $commonCategory->id;
      DB::enableQueryLog();
      $query = Task::with('completer', 'reminders')->OfTasks($duedate);


      if (!isSuperUser()) {
        $query->where(function ($q) use ($commonCategoryId) {
          $q->whereNotIn('task_category', $commonCategoryId)
            ->orWhere(function ($qr) use ($commonCategoryId) {
              $qr->whereIn('task_category', $commonCategoryId)->where('task_user_id', Auth::id());
            });
        });
      }

      return $query->get();
      //dd(DB::getQueryLog());
    } else {
      $Category = TaskCategory::where('id', $catId)->first();

      if (($Category->t_cat_user_id == 0) && ($Category->t_cat_business_id == 0) && $Category->t_cat_name != 'Birthday') {
        $authId = ($ownerId) ? $ownerId : Auth::id();
        return Task::with('completer', 'reminders')->where('task_category', $catId)->where('task_user_id', $authId)->OfTasks($duedate)->get();
      } else {
        return Task::with('completer', 'reminders')->where('task_category', $catId)->OfTasks($duedate)->get();
      }
    }
  }

  protected function getTc($taskcategories, $bussUsers = [])
  {
    $eventRepeatIntervalOpt = [
      "" => "-- Select --", 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6,
      7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17,
      18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27,
      28 => 28, 29 => 29, 30 => 30, 31 => 31
    ];

    $tc = [];
    $tc[""] = "-- Select --";
    foreach ($taskcategories->sortBy('t_cat_name') as $categories) {
      $tc[$categories->id] = $categories->t_cat_name;
    }

    if (count($bussUsers)) {
      $commonCategory = $taskcategories->where('t_cat_user_id', 0)->where('t_cat_business_id', 0)->first();
      foreach ($bussUsers->sortBy('FullName') as $bussUser) {
        $tc[$commonCategory->id . '|' . $bussUser->id] = $bussUser->FullName . "'s " . $commonCategory->t_cat_name;
      }
    }

    //dd($tc);

    $data = [];
    $data['tc'] =  $tc;
    $data['eventRepeatIntervalOpt'] = $eventRepeatIntervalOpt;
    return $data;
  }

  protected function percentageCalculator($data1, $data2)
  {
    if ($data1)
      return number_format((($data1 / $data2) * 100), 2);
    else return 0;
  }

  function editChart(Request $request)
  {
    $msg = [];
    
    $inputData = $request->all();
    $chartSetting = ChartSetting::where('chart_business_id', Session::get('businessId'))->where('chart_type', $inputData['chart_type'])->first();

    $data = [];
    
    foreach ($inputData as $key => $value) {

      if ($value == '1') {
        $str = $key . 'Color';
        $data[$key] = $inputData[$str];
      }
    }
    $settingData = json_encode($data);
    $chartSetting->chart_type = $inputData['chart_type'];
    $chartSetting->chart_setting_data = $settingData;
    
    if ($chartSetting->save()) {
      $msg['status'] = 'updated';
      $msg['setting'] = $chartSetting;
    } else {
      $msg['status'] = 'error';
    }
    echo json_encode($msg);
  }

}
