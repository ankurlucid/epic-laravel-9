<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SleepJournal;
use Carbon\Carbon;
use Auth;
use DB;
use View;

class SleepController extends Controller
{
    public function sleep(Request $request)
    {
        $clientId = Auth::User()->account_id;
        if($request->date){
            $eventDate =$request->date;
        } else{
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
  
        $sleepData = [];
        $sleepJournal = SleepJournal::where('client_id',$clientId)->where('event_date',$eventDate)->first();
        //    $sleepJournal = SleepJournal::where('client_id',$clientId)
        //                     ->where('event_date','<=', $eventDate)
        //                      ->orderBy('event_date', 'DESC')
        //                     ->orderBy('id', 'DESC')
        //                     ->first();
             
        if($sleepJournal){
            $sleepData = $sleepJournal->toArray();
        }
        /*  */
        /*  start */
        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($eventDate)));
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($eventDate)));
        // Declare an empty array
        $sleepArray = array();
        // Use strtotime function
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);
        // Use for loop to store dates into array
        // 86400 sec = 24 hrs = 60*60*24 = 1 day
        $avgAmoutSleepArray = [];
        $avgGoToSleep = [];
        $avgWakeUp = [];
        $avgGoToBed = [];
        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) 
           {                               
                $store = date('Y-m-d', $currentDate);
                // $progresBar = "0";
                // $hour = "0";
                // $minute = "0";
                $timestamp = strtotime($store);
                $day = date('D', $timestamp);
                $weekSleepJournal = SleepJournal::where('client_id',$clientId)
                       ->whereDate( 'event_date', '=', $store)
                       ->orderBy('event_date', 'DESC')
                       ->orderBy('id', 'DESC')
                       ->first();
                $sleepArray[$store]['sleep'] = $weekSleepJournal;
                $go_to_sleep = $weekSleepJournal['go_to_sleep'];
                if($go_to_sleep){
                    array_push($avgGoToSleep, $go_to_sleep);
                  }
                $go_to_bed = $weekSleepJournal['go_to_bed'];
                if($go_to_bed){
                    array_push($avgGoToBed, $go_to_bed);
                 }
                $go_to_sleep  = date('h:i:s a', strtotime($go_to_sleep));
                $formatTime1  = date('a', strtotime($go_to_sleep));
                $wake_up = $weekSleepJournal['wake_up'];
                if($wake_up){
                    array_push($avgWakeUp, $wake_up);
                 }
                $wake_up =  date('h:i:s a', strtotime($wake_up));
                $formatTime2  = date('a', strtotime($wake_up));
                /*  */
                 $time1 = new \DateTime($go_to_sleep);
                 $time2 = new \DateTime($wake_up);
                 $interval = $time2->diff($time1);
                 if($formatTime1 == 'pm' && $formatTime2 == 'am'){
                     $hour = $interval->format("%h");
                     $hour = 24-$hour;
                     $minute = $interval->format("%i");
      
                    if($minute > 0){
                         $hour =   $hour-1;
                        $minute = 60-$minute;
                    } 
                 }else {
                    $hour = $interval->format("%h");
                    $minute = $interval->format("%i");
                 }
               
                 switch ($hour) {
                    case 0:
                        $progresBar = "0";
                       break;
                    case 1:
                        $progresBar = "10";
                      break;
                    case 2:
                        $progresBar = "20";
                      break;
                    case 3:
                        $progresBar = "30";
                      break;
                    case 4:
                        $progresBar = "40";
                        break;
                    case 5:
                        $progresBar = "50";
                        break;
                    case 6:
                        $progresBar = "60";
                        break;
                    case 7:
                        $progresBar = "70";
                        break;
                    case 8:
                        $progresBar = "80";
                         break;
                    case 9:
                        $progresBar = "90";
                        break;
                    case 10:
                        $progresBar = "100";
                        break;
                    case ($hour > 10):
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
                        $progresBar = $progresBar+"1";
                      break;
                    case ($minute > 6 && $minute <= 12):
                        $progresBar = $progresBar+"2";
                      break;
                    case ($minute > 12 && $minute <= 18):
                        $progresBar = $progresBar+"3";
                        break;
                    case ($minute > 18 && $minute <= 24):
                        $progresBar = $progresBar+"4";
                        break;
                    case ($minute > 24 && $minute <= 30):
                        $progresBar = $progresBar+"5";
                         break;
                    case ($minute > 30 && $minute <= 36):
                        $progresBar = $progresBar+"6";
                        break;
                    case ($minute > 36 && $minute <= 42):
                        $progresBar = $progresBar+"7";
                        break;
                    case ($minute > 42 && $minute <= 48):
                        $progresBar = $progresBar+"8";
                        break;
                    case ($minute > 48 && $minute <= 54):
                        $progresBar = $progresBar+"9";
                        break;
                    case ($minute > 54 && $minute <= 60):
                            $progresBar = $progresBar+"10";
                          break;
                    default:
                       $progresBar = $progresBar;    
                  }   
                if($weekSleepJournal){
                    $avgAmoutSleepArray[] =  $hour.':'.$minute;
                } 
                $sleepArray[$store]['progresBar'] =  $progresBar;
                $sleepArray[$store]['hour'] =  $hour;
                $sleepArray[$store]['minute'] =  $minute;
                $sleepArray[$store]['day'] = $day;
                $sleepArray[$store]['date'] = $store;
                // $array[] = $Store;
           
          }
         $avgAmoutSleep = $this->averageTime($avgAmoutSleepArray);
         if($avgGoToSleep){
            $avgAmoutGoToSleep = $this->totalTime($avgGoToSleep);
        } else {
            $avgAmoutGoToSleep = '' ;
        }
        if($avgWakeUp){
            $avgAmoutWakeUp = $this->totalTime($avgWakeUp);
        } else {
            $avgAmoutWakeUp = '' ;
        }
        if($avgGoToBed){
            $avgAmoutGoToBed = $this->totalTime($avgGoToBed);
        } else {
            $avgAmoutGoToBed = '' ;
        }
         return view('Result.dailydiary.sleep',compact('sleepData','eventDate','sleepArray','date1','date2','avgAmoutSleep','avgAmoutGoToSleep','avgAmoutWakeUp','avgAmoutGoToBed'));
    }

    function averageTime($avgAmoutSleep) {
            $sum = strtotime('00:00');
            $totaltime = 0;
        foreach( $avgAmoutSleep as $element ) {
            // Converting the time into seconds
            $timeinsec = strtotime($element) - $sum; 
            // Sum the time with previous value
            $totaltime = $totaltime + $timeinsec;
        }
       
        $h = intval($totaltime / 3600);
        $totaltime = $totaltime - ($h * 3600);
        // Minutes is obtained by dividing
        // remaining total time with 60
        $m = intval($totaltime / 60);
        $total = $h.':'. $m;
        // $count = 7;
        $count = count($avgAmoutSleep);
        $rounding = 0;
        $total = explode(":", strval($total));
        if (count($total) !== 2) return false;
        $sum = $total[0]*60*60 + $total[1]*60;
        $average = $sum/(float)$count;
        $hours = floor($average/3600);
        $minutes = floor(fmod($average,3600)/60);
        // $seconds = number_format(fmod(fmod($average,3600),60),(int)$rounding);
        if($hours < 10){
            $hours = '0'.$hours;   
        }
        if($minutes < 10){
            $minutes = '0'.$minutes;   
        }
        if(is_nan($hours)){
            $hours = '00';
        }
        if(is_nan($minutes)){
            $minutes = '00';
        }
        return $hours.":".$minutes;
    }

    public function totalTime($timeArray){
        // $count = count($timeArray);
        $sum = strtotime('00:00:00');
        $total = 0;
       foreach( $timeArray as $element){
            $temp = explode(":", $element);
            $total+= (int) $temp[0] * 3600;
            $total+= (int) $temp[1] * 60;
            $total+= (int) $temp[2];
       }
      // Format the seconds back into HH:MM:SS
        $formatted = sprintf('%02d:%02d:%02d',($total / 3600),($total / 60 % 60),$total % 60);
        $totalTime = $formatted;
        $count =  count($timeArray);
        $rounding = 0;
        $totalTime = explode(":", strval($totalTime));
        if (count($totalTime) !== 3) return false;
        $sum = $totalTime[0]*60*60 + $totalTime[1]*60 + $totalTime[2];
        $average = $sum/(float)$count;
        $hours = floor($average/3600);
        $minutes = floor(fmod($average,3600)/60);
        $seconds = number_format(fmod(fmod($average,3600),60),(int)$rounding);
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        //  dd($hours.":".$minutes.":".$seconds);
    }
    public function storeSleepData(Request $request){
        $requestData = $request->all();
        $clientId = Auth::User()->account_id;
         DB::beginTransaction();
         $dbStatus = true;
         $sleepJournal = SleepJournal::updateOrCreate([
                'client_id' => $clientId,
                'event_date' => $requestData['event_date']
                ],['go_to_bed' => $requestData['go_to_bed'],
                'go_to_sleep' => $requestData['go_to_sleep'],
                'wake_up' => $requestData['wake_up'],
                'morning_woke_up' => $requestData['morning_woke_up'],
                'end_of_day' => $requestData['end_of_day'],
                'general_notes' => $requestData['general_notes']
            ]);
            if(!$sleepJournal){
               $dbStatus = false;
                                      
           }
         if($dbStatus)
           {
                 DB::commit();
                  $response = [
                     'status' => 'ok',
                     'message' => 'Data saved successfully'
                                 ];
            return response()->json($response);
        }
        else{
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
            return response()->json($response);
        }
    }

    public function filterSleepGraph(Request $request){
        $clientId = Auth::User()->account_id;
        $date = $request['date'];
        if($request['type'] == "next-btn"){
            $eventDate =date('Y-m-d', strtotime('+1 day', strtotime($date)));
        } elseif ($request['type'] == "pre-btn"){
            $eventDate =date('Y-m-d', strtotime('-1 day', strtotime($date))); 
        }
        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($eventDate)));
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($eventDate)));
        // Declare an empty array
        $sleepArray = array();
        // Use strtotime function
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);
        // Use for loop to store dates into array
        // 86400 sec = 24 hrs = 60*60*24 = 1 day
        $avgAmoutSleepArray = [];
        $avgGoToSleep = [];
        $avgWakeUp = [];
        $avgGoToBed = [];
        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) 
           {                               
                $store = date('Y-m-d', $currentDate);
               
                $timestamp = strtotime($store);
                $day = date('D', $timestamp);
                $weekSleepJournal = SleepJournal::where('client_id',$clientId)
                       ->whereDate( 'event_date', '=', $store)
                       ->orderBy('event_date', 'DESC')
                       ->orderBy('id', 'DESC')
                       ->first();
                $sleepArray[$store]['sleep'] = $weekSleepJournal;
                $go_to_sleep = $weekSleepJournal['go_to_sleep'];
                if($go_to_sleep){
                    array_push($avgGoToSleep, $go_to_sleep);
                  }
                $go_to_bed = $weekSleepJournal['go_to_bed'];
                if($go_to_bed){
                    array_push($avgGoToBed, $go_to_bed);
                 }
                $go_to_sleep  = date('h:i:s a', strtotime($go_to_sleep));
                $formatTime1  = date('a', strtotime($go_to_sleep));
                $wake_up = $weekSleepJournal['wake_up'];
                if($wake_up){
                    array_push($avgWakeUp, $wake_up);
                 }
                $wake_up =  date('h:i:s a', strtotime($wake_up));
                $formatTime2  = date('a', strtotime($wake_up));
                /*  */
                 $time1 = new \DateTime($go_to_sleep);
                 $time2 = new \DateTime($wake_up);
                 $interval = $time2->diff($time1);
                 if($formatTime1 == 'pm' && $formatTime2 == 'am'){
                     $hour = $interval->format("%h");
                     $hour = 24-$hour;
                     $minute = $interval->format("%i");
      
                    if($minute > 0){
                         $hour =   $hour-1;
                        $minute = 60-$minute;
                    } 
                 }else {
                    $hour = $interval->format("%h");
                    $minute = $interval->format("%i");
                 }
                 switch ($hour) {
                    case 0:
                        $progresBar = "0";
                       break;
                    case 1:
                        $progresBar = "10";
                      break;
                    case 2:
                        $progresBar = "20";
                      break;
                    case 3:
                        $progresBar = "30";
                      break;
                    case 4:
                        $progresBar = "40";
                        break;
                    case 5:
                        $progresBar = "50";
                        break;
                    case 6:
                        $progresBar = "60";
                        break;
                    case 7:
                        $progresBar = "70";
                        break;
                    case 8:
                        $progresBar = "80";
                         break;
                    case 9:
                        $progresBar = "90";
                        break;
                    case 10:
                        $progresBar = "100";
                        break;
                    case ($hour > 10):
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
                        $progresBar = $progresBar+"1";
                      break;
                    case ($minute > 6 && $minute <= 12):
                        $progresBar = $progresBar+"2";
                      break;
                    case ($minute > 12 && $minute <= 18):
                        $progresBar = $progresBar+"3";
                        break;
                    case ($minute > 18 && $minute <= 24):
                        $progresBar = $progresBar+"4";
                        break;
                    case ($minute > 24 && $minute <= 30):
                        $progresBar = $progresBar+"5";
                         break;
                    case ($minute > 30 && $minute <= 36):
                        $progresBar = $progresBar+"6";
                        break;
                    case ($minute > 36 && $minute <= 42):
                        $progresBar = $progresBar+"7";
                        break;
                    case ($minute > 42 && $minute <= 48):
                        $progresBar = $progresBar+"8";
                        break;
                    case ($minute > 48 && $minute <= 54):
                        $progresBar = $progresBar+"9";
                        break;
                    case ($minute > 54 && $minute <= 60):
                            $progresBar = $progresBar+"10";
                          break;
                    default:
                       $progresBar = $progresBar;    
                  }             
            /*  */
                if($weekSleepJournal){
                    $avgAmoutSleepArray[] =  $hour.':'.$minute;
                } 
                $sleepArray[$store]['progresBar'] =  $progresBar;
                $sleepArray[$store]['hour'] =  $hour;
                $sleepArray[$store]['minute'] =  $minute;
                $sleepArray[$store]['day'] = $day;
                $sleepArray[$store]['date'] = $store;
                // $array[] = $Store;
           
          }
        $avgAmoutSleep = $this->averageTime($avgAmoutSleepArray);
        if($avgGoToSleep){
            $avgAmoutGoToSleep = $this->totalTime($avgGoToSleep);
        } else {
            $avgAmoutGoToSleep = '' ;
        }
        if($avgWakeUp){
            $avgAmoutWakeUp = $this->totalTime($avgWakeUp);
        } else {
            $avgAmoutWakeUp = '' ;
        }
        if($avgGoToBed){
            $avgAmoutGoToBed = $this->totalTime($avgGoToBed);
        } else {
            $avgAmoutGoToBed = '' ;
        }
        $html = View::make('Result.dailydiary.sleep-graph', compact('sleepArray','date1','date2','avgAmoutSleep','avgAmoutGoToSleep','avgAmoutWakeUp','avgAmoutGoToBed'));
        $response['html'] = $html->render();
        $response['status'] = 'ok';
        return response()->json($response);

    }
}
