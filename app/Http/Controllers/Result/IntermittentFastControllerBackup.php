<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parq;
use App\PersonalMeasurement;
use App\Clients;
use App\IntermittentFast;
use App\FastingClockModel;
use Auth;

class IntermittentFastController extends Controller
{
    public function show()
    {
        $client_id = Auth::User()->account_id;
        $measurement =  PersonalMeasurement::select('id','client_id','height','weight','weightUnit','heightUnit')
                        ->where('client_id',$client_id)
                        ->orderBy('id','desc')
                        ->whereNull('deleted_at')
                        ->first();
        // $data =  Parq::select('id','client_id','gender')
        //                 ->where('client_id',$client_id)
        //                 ->orderBy('id','desc')
        //                 ->first();
        $personal_detail =  Clients::select('id','birthday','gender')
                        ->where('id',$client_id)
                        ->first();
        $fastingData = IntermittentFast::select('id','client_id','achieve','date_of_birth',
                        'gender','experience','height','weight','protocol','protocol_other')
                         ->where('client_id', $client_id)
                         ->orderBy('id','desc')
                         ->first();
        return view("Result.fasting.fasting-form",compact('measurement','personal_detail','fastingData'));
    }

    public function store(Request $request)
    {    
        $reqData = $request['data'];
        $client_id = Auth::User()->account_id;
        if($reqData['protocol'] == 'Other'){
             $protocol_other = [];
             $protocol_other['days'] = $reqData['days'];
             $protocol_other['fasting_hours'] = $reqData['fasting_hours'];
        }
        $fastingStore = IntermittentFast::updateOrCreate(
            ['id'=> $reqData['id']],
            ['client_id'=> $client_id,
            'achieve'=> $reqData['achieve'],
            'gender'=> $reqData['gender'],
            'experience'=> $reqData['experience'],
            'protocol'=> $reqData['protocol'],
            'protocol_other'=>$protocol_other ? json_encode($protocol_other) : null,
            'date_of_birth'=> $reqData['date_of_birth'],
            'weight'=> $reqData['weight'],
            'height'=> $reqData['height'],
        ]);

        $response = [
            'status' => 'ok',
            'data' => $fastingStore,
        ];
        return response()->json($response);
    }

    public function fastingHistory()
    {
         $client_id = Auth::User()->account_id;
         $todayDate = date("Y-m-d");
         $date1 = date("Y-m-d", strtotime('monday this week', strtotime($todayDate)));
         $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($todayDate)));
         $variable1 = strtotime($date1);
         $variable2 = strtotime($date2);
        //  $next_day;
         $fastArray = [];
         for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) 
          {   
            $eatingProgresBar = 0;
            $progresBar = 0; 
            $hour = "0";
            $minute = "0";
            $store = date('Y-n-j', $currentDate);   
            /*  */
            $nextLoopDate =date('Y-n-j', strtotime('+1 day', strtotime($store))); // fast end date
            $preLoopDate =date('Y-n-j', strtotime('-1 day', strtotime($store))); // fast start date
           /*  */
            $timestamp = strtotime($store);
            $date = date('d', $timestamp);
            $month =  date('M', $timestamp);
            $weekFastEat = FastingClockModel::where('client_id',$client_id)
                                ->where('start_fast', 'like', '%'.$store.'%')
                                ->orderBy('id', 'DESC')
                                ->first();
             $startTime = new \DateTime($weekFastEat->start_fast);
             $startDate = $startTime->format('Y-m-d');
             $startTime = $startTime->format('H:i:s');
             if(!empty($weekFastEat->end_fast)){
                $endTime = new \DateTime($weekFastEat->end_fast);
                $endDate = $endTime->format('Y-m-d');
                $endTime = $endTime->format('H:i:s');

                if( $startDate == $endDate){
                    $start_time = new \DateTime($startTime);
                    $end_time = new \DateTime($endTime);
                    $difference_time = $end_time->diff($start_time);
                    $hour = $difference_time->format("%h");
                    $minute = $difference_time->format("%i"); 
                   /* eating  */
                    $eatingTime = $difference_time->format('%H:%I:%S');
                    $totalTime = "24:00:00";
                    $time1 = new \DateTime($eatingTime);
                    $time2 = new \DateTime($totalTime);
                    $interval =  $time2->diff($time1);
                    $eating_hour = $interval->format("%h");
                    $eating_minute = $interval->format("%i");
                    /* eating end */
                 } else {   
                    $start_date = new \DateTime($startDate);
                    $end_date = new \DateTime($endDate);
                    $difference_date = $end_date->diff($start_date);
                    $diff = $difference_date->format("%a");
                    $totalTime = "24:00:00";
                    if($diff == "1"){
                        $time1 = new \DateTime($startTime);
                        $time2 = new \DateTime($totalTime);
                        $interval =  $time2->diff($time1);
                        $hour = $interval->format("%h");
                        $minute = $interval->format("%i");
                        $startTime = $startTime->format('H:i:s');
                    }
                    dd( $diff , $start_time ,  $end_time);

                    
                    // $next_day = ;
                 }
              } else {
                // dd('hi');
              } 

              switch ($hour) {
                case 0:
                    $progresBar = "0";
                   break;
                case 1:
                    $progresBar = "5";
                  break;
                case 2:
                    $progresBar = "10";
                  break;
                case 3:
                    $progresBar = "15";
                  break;
                case 4:
                    $progresBar = "20";
                    break;
                case 5:
                    $progresBar = "25";
                    break;
                case 6:
                    $progresBar = "30";
                    break;
                case 7:
                    $progresBar = "35";
                    break;
                case 8:
                    $progresBar = "40";
                     break;
                case 9:
                    $progresBar = "45";
                    break;
                case 10:
                    $progresBar = "50";
                    break;
                case 11:
                    $progresBar = "55";
                    break;
                case 12:
                    $progresBar = "60";
                    break;
                case 13:
                    $progresBar = "65";
                    break;
                case 14:
                    $progresBar = "70";
                    break;
                case 15:
                    $progresBar = "75";
                    break;
                case 16:
                    $progresBar = "80";
                    break;
                case 17:
                    $progresBar = "85";
                    break;
                case 18:
                    $progresBar = "90";
                    break;
                case 19:
                    $progresBar = "95";
                    break;
                case 20:
                    $progresBar = "100";
                    break;
                case ($hour > 20):
                    $progresBar = "100";
                    break;
                default:
                   $progresBar = "100";    
              }

              switch ($minute) {
                case 0:
                    $progresBar = $progresBar;
                    break;
                case ($minute > 0 && $minute <= 6):
                    $progresBar = $progresBar+".5";
                    break;
                case ($minute > 6 && $minute <= 12):
                    $progresBar = $progresBar+"1";
                    break;
                case ($minute > 12 && $minute <= 18):
                    $progresBar = $progresBar+"1.5";
                    break;
                case ($minute > 18 && $minute <= 24):
                    $progresBar = $progresBar+"2";
                    break;
                case ($minute > 24 && $minute <= 30):
                     $progresBar = $progresBar+"2.5";
                     break;
                case ($minute > 30 && $minute <= 36):
                     $progresBar = $progresBar+"3";
                     break;
                case ($minute > 36 && $minute <= 42):
                     $progresBar = $progresBar+"3.5";
                     break;
                case ($minute > 42 && $minute <= 48):
                     $progresBar = $progresBar+"4";
                     break;
                case ($minute > 48 && $minute <= 54):
                    $progresBar = $progresBar+"4.5";
                    break;
                case ($minute > 54 && $minute <= 60):
                     $progresBar = $progresBar+"5";
                     break;
                default:
                   $progresBar = $progresBar;    
              }   

              switch ($eating_hour) {
                case 0:
                    $eatingProgresBar = "0";
                   break;
                case 1:
                    $eatingProgresBar = "5";
                  break;
                case 2:
                    $eatingProgresBar = "10";
                  break;
                case 3:
                    $eatingProgresBar = "15";
                  break;
                case 4:
                    $eatingProgresBar = "20";
                    break;
                case 5:
                    $eatingProgresBar = "25";
                    break;
                case 6:
                    $eatingProgresBar = "30";
                    break;
                case 7:
                    $eatingProgresBar = "35";
                    break;
                case 8:
                    $eatingProgresBar = "40";
                     break;
                case 9:
                    $eatingProgresBar = "45";
                    break;
                case 10:
                    $eatingProgresBar = "50";
                    break;
                case 11:
                    $eatingProgresBar = "55";
                    break;
                case 12:
                    $eatingProgresBar = "60";
                    break;
                case 13:
                    $eatingProgresBar = "65";
                    break;
                case 14:
                    $eatingProgresBar = "70";
                    break;
                case 15:
                    $eatingProgresBar = "75";
                    break;
                case 16:
                    $eatingProgresBar = "80";
                    break;
                case 17:
                    $eatingProgresBar = "85";
                    break;
                case 18:
                    $eatingProgresBar = "90";
                    break;
                case 19:
                    $eatingProgresBar = "95";
                    break;
                case 20:
                    $eatingProgresBar = "100";
                    break;
                case ($eating_hour > 20):
                    $eatingProgresBar = "100";
                    break;
                default:
                   $eatingProgresBar = "100";    
              }

              switch ($eating_minute) {
                case 0:
                    $eatingProgresBar = $eatingProgresBar;
                    break;
                case ($eating_minute > 0 && $eating_minute <= 6):
                    $eatingProgresBar = $eatingProgresBar+".5";
                    break;
                case ($eating_minute > 6 && $eating_minute <= 12):
                    $eatingProgresBar = $eatingProgresBar+"1";
                    break;
                case ($eating_minute > 12 && $eating_minute <= 18):
                    $eatingProgresBar = $eatingProgresBar+"1.5";
                    break;
                case ($eating_minute > 18 && $eating_minute <= 24):
                    $eatingProgresBar = $eatingProgresBar+"2";
                    break;
                case ($eating_minute > 24 && $eating_minute <= 30):
                     $eatingProgresBar = $eatingProgresBar+"2.5";
                     break;
                case ($eating_minute > 30 && $eating_minute <= 36):
                     $eatingProgresBar = $eatingProgresBar+"3";
                     break;
                case ($eating_minute > 36 && $eating_minute <= 42):
                     $eatingProgresBar = $eatingProgresBar+"3.5";
                     break;
                case ($eating_minute > 42 && $eating_minute <= 48):
                     $eatingProgresBar = $eatingProgresBar+"4";
                     break;
                case ($eating_minute > 48 && $eating_minute <= 54):
                    $eatingProgresBar = $eatingProgresBar+"4.5";
                    break;
                case ($eating_minute > 54 && $eating_minute <= 60):
                     $eatingProgresBar = $eatingProgresBar+"5";
                     break;
                default:
                   $eatingProgresBar = $eatingProgresBar;    
              }   
              $fastArray[$store]['progresBar'] =  $progresBar;
              $fastArray[$store]['eatingProgresBar'] =  $eatingProgresBar;
              $fastArray[$store]['fastingHour'] =  $hour;
              $fastArray[$store]['fastingMinute'] =  $minute;
            //   $fastArray[$store]['day'] = $day;
              $fastArray[$store]['short_date'] = $date;
              $fastArray[$store]['month'] = $month;
              $fastArray[$store]['date'] = $store;
              $fastArray[$store]['eatingHour'] = $eating_hour;
              $fastArray[$store]['eatingMinute'] = $eating_minute;
          
         }
              dd($fastArray);
         return view("Result.fasting.fasting-history",compact('fastArray','date1','date2'));
     }

   
}
