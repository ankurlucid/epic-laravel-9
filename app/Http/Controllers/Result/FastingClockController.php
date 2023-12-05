<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;
use App\Models\FastingClockModel;
use App\Models\IntermittentFast;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class FastingClockController extends Controller
{
    //

    function saveFastClockStart(Request $request){
        
        $getIntermittentFastData = IntermittentFast::where([
            'client_id' => Auth::User()->account_id,

        ])->update(['auto_diy'=>$request->auto_diy]);

        FastingClockModel::create([
            'client_id' => Auth::User()->account_id,
            'start_fast' => $request->start_date
        ]);
    }

    function fastingCycleEnd(Request $request){

        setDefaultTimezone();

        if(isset($request->cycle_status) && $request->cycle_status == 'yes'){
            $getFastClockData= FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
            $getFastClockData->update(['end_fast'=>$request->current_time,
                                       'status'=>'Show']);
             $fastingData = IntermittentFast::select('id','client_id','status','timezone')
                            ->where('client_id', Auth::User()->account_id)
                            ->orderBy('id','desc')
                            ->first();
            $fastingData->update(['status'=>'Yes']);
            return response()->json(['url'=>url('/fasting')]);
        }
        
        $getFastClockData= FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
        if($request->mode == 'eating'){

            $getFastClockData->update(['end_eat'=>$request['current_time']]);
            $getFastClockDataPreviousData = $getFastClockData;
            $getFastClockData= FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
            if($getFastClockData){
                if($getFastClockData->end_eat != null || trim($getFastClockData->end_fast) != ''){
                    $getIntermittentFastData= IntermittentFast::select('id','client_id','auto_diy','protocol_other','protocol','timezone')
                                                ->where('client_id', Auth::User()->account_id)
                                                ->orderBy('id','desc')
                                                ->first();
                     if($getIntermittentFastData->auto_diy == 'AUTO' ){
                        //   $now=date('Y-m-d H:i:s');
                          $now=date('Y-n-j H:i:s');
                          FastingClockModel::create([
                            'client_id'=>Auth::User()->account_id,
                            'start_fast'=>$request['current_time'],
                            'protocol'=>$getIntermittentFastData->protocol,
                            'protocol_other'=>$getIntermittentFastData->protocol_other,
                            'auto_diy'=>$getIntermittentFastData->auto_diy,
                            ]);
                          $getFastClockData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
                          \Session::put('fasting_clock_id',$getFastClockDataPreviousData->id);
                          return response()->json(['url'=>url('/load-eating-summary')]);
                          //   return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_fast,'mode'=>'fasting']);
                      }else{

                           FastingClockModel::create([
                                'client_id'=> Auth::User()->account_id,
                                'start_fast'=> $request['current_time'],
                                'protocol'=>$getIntermittentFastData->protocol,
                                'protocol_other'=>$getIntermittentFastData->protocol_other,
                                'auto_diy'=>$getIntermittentFastData->auto_diy,
                            ]);

                          \Session::put('fasting_clock_id',$getFastClockDataPreviousData->id);
                          return response()->json(['url'=>url('/load-eating-summary')]);

                           // return response()->json(['url'=>url('/fasting-clock-controller')]);
                        }
                    // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_fast,'mode'=>'fasting']);
                }

              }
        }else{
            
            $intermediateData = \App\Models\IntermittentFast::where('client_id',\Auth::user()->account_id)->first();

            if (isset($intermediateData) && $intermediateData->protocol == 'Other') {
                
               $getFastClockData->update(['end_fast'=>$request->current_time]);
               $intermediateData->update(['status'=>'Yes']);
               
               return response()->json(['url'=>url('/fasting')]);

            }

            if($getFastClockData->end_fast == null || trim($getFastClockData->end_fast) == ''){

                $getFastClockData->update(['end_fast'=>$request->current_time,'start_eat'=>$request->current_time]);
            }
            else{
                
                $getFastClockData->insert([
                    'client_id'=>Auth::User()->account_id,
                    'start_fast'=>$request->current_time,
                    'protocol'=>$intermediateData->protocol,
                    'protocol_other'=>$intermediateData->protocol_other,
                    'auto_diy'=>$intermediateData->auto_diy,

                ]);
            }
            $getFastClockData= FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();

            if($getFastClockData){
                if($getFastClockData->end_fast == null || trim($getFastClockData->end_fast) == ''){
                    return response()->json(['url'=>url('/fasting-clock-controller')]);
                    // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_fast,'mode'=>'fasting']);
                }
                else{
                    return response()->json(['url'=>url('/load-fasting-summary')]);
                    // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->end_fast,'mode'=>'eating']);
                }
                
              }
       }
        // FastingClockModel::insert([
        //     'client_id' => Auth::User()->account_id,
        //     'start_fast' => $request->start_date
        // ]);
    }


    public function fastingClockHit(){

        setDefaultTimezone();
        $getIntermittentFastData= IntermittentFast::select('id','client_id','auto_diy','protocol','is_diy_past_run','protocol_other','timezone')
         ->where('client_id', Auth::User()->account_id)
         ->orderBy('id','desc')
         ->first();

        if($getIntermittentFastData->auto_diy == 'AUTO' ){
            $getFastClockData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();

            if(!empty($getFastClockData) && $getFastClockData->status != "Show"){

               return FastingClockController::fastingClockHitAuto();
            } else {
                return view('Result.fasting.fasting-datetime-start'); 
            }
        }else{

            $getFastClockData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
            $start_eating = $getFastClockData->start_eat;
            
            if ($getIntermittentFastData->protocol !='Other' && $getIntermittentFastData->auto_diy == 'DIY' && $getIntermittentFastData->is_diy_past_run == 'No') {
                
                return FastingClockController::fastingClockHitDIY();

            }else{
                    
                if ($getIntermittentFastData->protocol == 'Other') {
                    
                    if($getFastClockData->status != "Auto"){

                        $protocolOther = json_decode($getIntermittentFastData->protocol_other);
                        $otherDays = $protocolOther->days;
                        $otherHours = $protocolOther->fasting_hours;
                        $totalHours = $otherDays * 24 + $otherHours;
                        $endFastDateHours =  date("Y-m-d H:i:s", strtotime("+".$totalHours." hours", strtotime($getFastClockData->start_fast )));
                        $getFastClockData->update([
                                'end_fast' => $endFastDateHours,
                                'status'=>'Auto'
                          ]);
                    }
                    
                    $fastingClockModels = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
                    return view('Result.fasting.fasting-clock', ['cycle_start'=>$fastingClockModels->start_fast,'esti_cycle_end'=>$fastingClockModels->end_fast,'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);

                }

                if($getFastClockData){
                    if($getFastClockData->end_fast == null || trim($getFastClockData->end_fast) == ''){

                        return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_fast,'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
                    } else{
                        if(!emtpy($getFastClockData->start_eat)){
                            $start_eating = date("Y-m-d H:i:s");
                            $getEatingData =  $getFastClockData->update(['start_eat'=>$start_eating]);
                        }
                        $getFastClockData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First(); 
                        if($getFastClockData->end_eat == null || trim($getFastClockData->end_eat) == ''){
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_eat,'mode'=>'eating','cmode'=>'DIY', 'fastingData'=>$getIntermittentFastData]);
                        } else {
                            // $start_fasting = date("Y-m-d H:i:s");
                            $start_fasting = date("Y-m-d H:i:s");
                            FastingClockModel::create([
                                'client_id'=> Auth::User()->account_id,
                                'start_fast'=> $start_fasting,
                                'protocol'=>$getIntermittentFastData->protocol,
                                'protocol_other'=>$getIntermittentFastData->protocol_other,
                                'auto_diy'=>$getIntermittentFastData->auto_diy,
                            ]);
                            $getFastClockData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First(); 
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->start_fast,'mode'=>'fasting','cmode'=>'DIY', 'fastingData'=>$getIntermittentFastData]);
                        }
                        // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getFastClockData->end_fast,'mode'=>'eating','cmode'=>'DIY', 'fastingData'=>$getIntermittentFastData]);
                    }
                    
                }

                return view('Result.fasting.fasting-datetime-start');
            }

        } 
    }

    
    public function fastingClockHitAuto(){

        setDefaultTimezone();

        // $nowww = date('Y-m-d H:i:s');
        $now = getdate();

        $currentDay = $now['mday'];
        $currentMonth = $now['mon'];
        $currentYear = $now['year'];
        $currentHour = $now['hours'];
        $currentMinute = $now['minutes'];
        $currentSecond = $now['seconds'];

        $currentDateMk = mktime($currentHour,$currentMinute,$currentSecond,$currentMonth,$currentDay,$currentYear);
        
        $currentDate = date("Y-m-d H:i:s", $currentDateMk);

        $currentDatevar = strtotime($currentDate);
        
        $startTime=''; // get latest starttime of this clientid
        $endTime='';// get latest endtime

        $getData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
        $startTime = $getData->start_fast;
        $endTime = $getData->end_fast;
        Log::info('EndTime: '.$endTime);

        $getIntermittentFastData= IntermittentFast::select('id','client_id','protocol','protocol_other','auto_diy','timezone')
         ->where('client_id', Auth::User()->account_id)
         ->orderBy('id','desc')
         ->first();

        if($getIntermittentFastData->protocol == 'Other' ){
            if($getData->status != "Auto"){


                $protocolOther = json_decode($getIntermittentFastData->protocol_other);
                $otherDays = $protocolOther->days;
                $otherHours = $protocolOther->fasting_hours;
                $totalHours = $otherDays * 24 + $otherHours;
                $endFastDateHours =  date("Y-m-d H:i:s", strtotime("+".$totalHours." hours", strtotime( $startTime )));


                // OVERRIDE START DATA  
                $compareOverrideStartTime = strtotime($getData->start_fast);
                $compareOverrideEndTime = strtotime($endFastDateHours);
                $startDate = date('Y-m-d',strtotime($getData->start_fast));
                $endDate = date('Y-m-d',strtotime($endFastDateHours));
                
                $overrideFastingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->where(function($query) use($startDate,$endDate){

                                $query->whereBetween('start_fast',[$startDate,$endDate])
                                    ->orWhereBetween('end_fast',[$startDate,$endDate])
                                    ->orWhereBetween('start_eat',[$startDate,$endDate])
                                    ->orWhereBetween('end_eat',[$startDate,$endDate])
                                    ->orWhere('start_fast', 'like', '%'.$endDate.'%')
                                    ->orWhere('end_fast', 'like', '%'.$endDate.'%')
                                    ->orWhere('start_eat', 'like', '%'.$endDate.'%')
                                    ->orWhere('end_eat', 'like', '%'.$endDate.'%')
                                    ->orWhere('start_fast', 'like', '%'.$startDate.'%')
                                    ->orWhere('end_fast', 'like', '%'.$startDate.'%')
                                    ->orWhere('start_eat', 'like', '%'.$startDate.'%')
                                    ->orWhere('end_eat', 'like', '%'.$startDate.'%');
                            })
                            ->where('id','!=',$getData->id)
                            ->orderBy('id', 'ASC')
                            ->get();

                $deletedData = [];
                
                if (isset($overrideFastingData) && !$overrideFastingData->isEmpty()) {

                    foreach($overrideFastingData as $keyOverride=>$dataOverride){


                        $fStart = $dataOverride->start_fast;
                        $fEnd = $dataOverride->end_fast;

                        $eStart = $dataOverride->start_eat;
                        $eEnd = $dataOverride->end_eat;

                        if ($fStart !=null && $fEnd !=null && $eStart !=null && $eEnd !=null) {
                        
                            if (strtotime($fStart) >= $compareOverrideStartTime && 
                                strtotime($fEnd) >= $compareOverrideStartTime && 
                                strtotime($eStart) >= $compareOverrideStartTime && 
                                strtotime($eEnd) >= $compareOverrideStartTime &&
                                strtotime($fStart) <= $compareOverrideEndTime && 
                                strtotime($fEnd) <= $compareOverrideEndTime && 
                                strtotime($eStart) <= $compareOverrideEndTime && 
                                strtotime($eEnd) <= $compareOverrideEndTime 
                            ) {
                                    
                                    $dataOverride->delete();

                            }elseif (strtotime($fStart) <= $compareOverrideStartTime && 
                                    strtotime($fEnd) >= $compareOverrideStartTime && 
                                    strtotime($eStart) >= $compareOverrideStartTime  && 
                                    strtotime($eEnd) >= $compareOverrideStartTime) {

                                    $dataOverride->end_fast = $getData->start_fast;
                                    $dataOverride->start_eat = null;
                                    $dataOverride->end_eat = null;
                                    $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideStartTime && 
                                    strtotime($fEnd) <= $compareOverrideStartTime && 
                                    strtotime($eStart) <= $compareOverrideStartTime  && 
                                    strtotime($eEnd) >= $compareOverrideStartTime) {

                                    $dataOverride->end_eat = $getData->start_fast;
                                    $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideEndTime && 
                                        strtotime($fEnd) >= $compareOverrideEndTime && 
                                        strtotime($eStart) >= $compareOverrideEndTime  && 
                                        strtotime($eEnd) >= $compareOverrideEndTime) {
                                        
                                        $dataOverride->start_fast = $endFastDateHours;
                                        $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideEndTime && 
                                    strtotime($fEnd) <= $compareOverrideEndTime && 
                                    strtotime($eStart) <= $compareOverrideEndTime  && 
                                    strtotime($eEnd) >= $compareOverrideEndTime) {
                                    
                                    $dataOverride->end_eat = $endFastDateHours;
                                    $dataOverride->save();
                            }


                        }elseif($fStart !=null && $fEnd !=null && $eStart == null && $eEnd == null){

                            if (strtotime($fStart) <= $compareOverrideStartTime && strtotime($fEnd) <= $compareOverrideStartTime) {
                                    
                                $dataOverride->delete();

                            }else if(strtotime($fStart) <= $compareOverrideStartTime && strtotime($fEnd) >= $compareOverrideStartTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->save();

                            }else if(strtotime($fStart) <= $compareOverrideEndTime && strtotime($fEnd) <= $compareOverrideEndTime) {    

                                $dataOverride->delete();
                            }

                        }else if ($fStart !=null && $fEnd ==null && $eStart == null && $eEnd == null) {

                            $dataOverride->delete(); 

                        }else if ($fStart !=null && $fEnd !=null && $eStart != null && $eEnd == null) {
                            
                            if (strtotime($eStart) <= $compareOverrideStartTime) {

                                $dataOverride->end_eat = $getData->start_fast;
                                $dataOverride->save();

                            }elseif(strtotime($fStart) <= $compareOverrideStartTime &&
                                    strtotime($fEnd) >= $compareOverrideStartTime 
                                ){

                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->start_eat = null;
                                $dataOverride->end_eat = null;
                                $dataOverride->save();

                            }
                        }
                    }   
                }

                // OVERRIDE END DATA 

                $getData->update([
                        'end_fast' => $endFastDateHours,
                        'status'=>'Auto'
                  ]);
               
                
            }
            $fastingClockModels = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
            return view('Result.fasting.fasting-clock', ['cycle_start'=>$fastingClockModels->start_fast,'esti_cycle_end'=>$fastingClockModels->end_fast,'mode'=>'fasting','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
        } else {
        $fastingWindow = explode('/',$getIntermittentFastData->protocol)[0];

        // Log::info('Fasting window:'.$fastingWindow);

        $eatingWindow = strval(24 - ((int)$fastingWindow) );

        // Log::info('Fasting window:'.$eatingWindow);
        
        $startTimeVar = strtotime($startTime);
        Log::info('StartTimeVar: '.$startTimeVar);

        $startTimePlus = strtotime("+".$fastingWindow." hours", $startTimeVar);

        if($endTime ==''){
           
            if($startTimeVar <= $currentDatevar && $currentDatevar < $startTimePlus){
                //  return startTime as COUNTUP TIME
                // return $startTimeVar;
                $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $startTimeVar));
                
                return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$startTimeVar),'esti_cycle_end'=>$estiEndCycle,'mode'=>'fasting','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
            }
            else if($startTimeVar <= $currentDatevar && $currentDatevar > $startTimePlus){

                $headTimePlus = $startTimePlus;

                $compareOverrideTime = strtotime($getData->start_fast);
                $store = date('Y-m-d',strtotime($getData->start_fast));
                
                $overrideFastingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->where(function($query) use($store){

                                $query->whereDate('start_fast', '>=', $store)
                                ->orWhereDate('end_fast', '>=', $store)
                                ->orWhereDate('start_eat', '>=', $store)
                                ->orWhereDate('end_eat', '>=', $store);
                            })
                            ->where('id','!=',$getData->id)
                            ->orderBy('id', 'ASC')
                            ->get();

                $deletedData = [];

                if (isset($overrideFastingData) && !$overrideFastingData->isEmpty()) {

                    foreach($overrideFastingData as $keyOverride=>$dataOverride){


                        $fStart = $dataOverride->start_fast;
                        $fEnd = $dataOverride->end_fast;

                        $eStart = $dataOverride->start_eat;
                        $eEnd = $dataOverride->end_eat;

                        if ($fStart !=null && $fEnd !=null && $eStart !=null && $eEnd !=null) {
                            
                            if (strtotime($fStart) >= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime && strtotime($eStart) >= $compareOverrideTime && strtotime($eEnd) >= $compareOverrideTime) {
                                    
                                    // $deletedData[] = $dataOverride->id;
                                    $dataOverride->delete();

                            }elseif (strtotime($fStart) <= $compareOverrideTime && strtotime($fEnd) <= $compareOverrideTime && strtotime($eStart) <= $compareOverrideTime  && strtotime($eEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_eat = $getData->start_fast;
                                $dataOverride->save();

                            }elseif ($compareOverrideTime >= strtotime($fStart) && $compareOverrideTime <= strtotime($fEnd) && $compareOverrideTime <= strtotime($eStart) && strtotime($eEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->start_eat = null;
                                $dataOverride->end_eat = null;
                                $dataOverride->save();

                            }


                        }elseif($fStart !=null && $fEnd !=null && $eStart == null && $eEnd == null){

                            if (strtotime($fStart) >= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime) {
                                    
                                $dataOverride->delete();

                            }else if(strtotime($fStart) <= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->save();

                            }else{

                                $dataOverride->delete();
                            }

                        }else if ($fStart !=null && $fEnd ==null && $eStart == null && $eEnd == null) {
                            
                            $dataOverride->delete(); 

                        }else if ($fStart !=null && $fEnd !=null && $eStart != null && $eEnd == null) {
                            
                            $dataOverride->delete(); 
                        }
                    }
                } 

                // dd($deletedData);           

                while($headTimePlus < $currentDatevar){
                    // # now
                    // # headtime and headtimeplus
                    // save headtimeplus as endtime
                    // check if headtimeplsu + eating window < currenttime
                    //     yes : save headtimeplsu + eating window as startime
                    //            headtimeplsu+= 24
                    //            if now currenttime < heaadtimePlus : return (headtimeplsu - fasting window)
                    //     no : return headtimeplsu // we actually are breaking out of the loop
                    // 
                    $getData->update(array('end_fast' => date('Y-m-d H:i:s',$headTimePlus),'start_eat'=>date('Y-m-d H:i:s',$headTimePlus)));
                    $tempTime = strtotime("+".$eatingWindow." hours", $headTimePlus);
                    if($tempTime <= $currentDatevar){
                            
                        $getData->update(array('end_eat' => date('Y-m-d H:i:s',$tempTime)));

                        $getData=FastingClockModel::create([
                            'client_id'=>Auth::User()->account_id,
                            'start_fast'=>date('Y-m-d H:i:s',$tempTime),
                            'protocol'=>$getIntermittentFastData->protocol,
                            'protocol_other'=>$getIntermittentFastData->protocol_other,
                            'auto_diy'=>$getIntermittentFastData->auto_diy,
                        ]);
                        $headTimePlus = strtotime("+24 hours", $headTimePlus);
                        if($currentDatevar < $headTimePlus){
                            $headTimePlus =strtotime("-".$fastingWindow." hours", $headTimePlus);
                            //return view with date
                            $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $headTimePlus));
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'esti_cycle_end'=>$estiEndCycle,'mode'=>'fasting','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
                        }
                    }
                    else{
                        $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $headTimePlus));
                        return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'esti_cycle_end'=>$estiEndCycle,'mode'=>'eating','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
                    }


                }
                // below seems not applicable anymore
                // if you have come out of this loop na, you must be not have returned. If you are not using return, use flags.
                // now headtimeplus is not grater than currentime. so simply just return headtime NOT HEADTIMEPLUS 
                // headtime = headTimePlsu - fasting window
                //  this all imple assumes that you are returning time less than currenttime FOR COUNTUP NOT COUNTDOWN

            } else {
                $getData=FastingClockModel::where('client_id',Auth::User()->account_id)
                        ->orderBy('id','desc')
                        ->first();
                $estiEndCycle = date('Y-m-d H:i',strtotime("+".$fastingWindow." hours", $startTimeVar));
                return view('Result.fasting.fasting-clock', ['cycle_start'=>$getData->start_fast,'esti_cycle_end'=>$estiEndCycle,'mode'=>'fasting','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);

            }


        }
        else{

            //  now here endtime is not null. means we already have both start and end time.
            //  means user had already started eating when last.
            // $endTimePlus=''; // endTime + eating window


            $endTimeVar = strtotime($endTime);
            Log::info('EndTimeVar in date : '.date('Y-m-d H:i:s',$endTimeVar));

            $endTimePlus = strtotime("+".$eatingWindow." hours", $endTimeVar);

            if($currentDatevar < $endTimePlus){
                //  simply return endTime as COUNTUP time
                $getEatingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->orderBy('id','desc')
                            ->first();
                $endTimeVar = strtotime($getEatingData->start_eat);
                $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $endTimeVar));
                // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getEatingData->start_eat,'esti_cycle_end'=>$estiEndCycle,'mode'=>'eating','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
                return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$endTimeVar),'esti_cycle_end'=>$estiEndCycle,'mode'=>'eating','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
            }
            else if($currentDatevar > $endTimePlus){
                Log::info("currentDateVar is greater than endtimplus");
                $headTimePlus = $endTimePlus;

                $getData->update(['end_eat'=>date('Y-m-d H:i:s',$headTimePlus)]);

                while($headTimePlus < $currentDatevar){
                    Log::info("headtimeplus is less than currentDateVar : ".$headTimePlus." < ".$currentDatevar);
                    //  now you should save headtimeplus as startime 
                    // check if headTimePLsu  + fasting windwo < currentime
                    //     yes: save headtimeplus + fasting window as endtime
                    //          headtimeplsu += 24
                    //     no : return headtimeplsu

                    $getData=FastingClockModel::create([
                        'client_id'=>Auth::User()->account_id,
                        'start_fast'=>date('Y-m-d H:i:s',$headTimePlus),
                        'protocol'=>$getIntermittentFastData->protocol,
                        'protocol_other'=>$getIntermittentFastData->protocol_other,
                        'auto_diy'=>$getIntermittentFastData->auto_diy,
                        ]);

                    // create new row with headtimplus as row
                    $tempTime = strtotime("+".$fastingWindow." hours", $headTimePlus);
                    if($tempTime <= $currentDatevar){
                        
                        $getData->update(array('end_fast' => date('Y-m-d H:i:s',$tempTime)));
                        $headTimePlus = strtotime("+24 hours", $headTimePlus);
                        if($currentDatevar < $headTimePlus){
                            $headTimePlus =strtotime("-".$eatingWindow." hours", $headTimePlus);
                            //return view with date
                            $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $headTimePlus));
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'esti_cycle_end'=>$estiEndCycle,'mode'=>'eating','cmode'=>'AUTO', 'fastingData'=>$getIntermittentFastData]);
                        }
                    }
                    else{
                        $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $headTimePlus));
                        return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'esti_cycle_end'=>$estiEndCycle,'mode'=>'fasting','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
                    }
                }
                // return similar to above
                // headime = headtimplsu - eating window
            }
        }
      }
      /* end else */
    }


    public function fastingClockHitDIY(){

        setDefaultTimezone();

        $now = getdate();

        $currentDay = $now['mday'];
        $currentMonth = $now['mon'];
        $currentYear = $now['year'];
        $currentHour = $now['hours'];
        $currentMinute = $now['minutes'];
        $currentSecond = $now['seconds'];

        $currentDateMk = mktime($currentHour,$currentMinute,$currentSecond,$currentMonth,$currentDay,$currentYear);
        
        $currentDate = date("Y-m-d H:i:s", $currentDateMk);

        $currentDatevar = strtotime($currentDate);
        
        $startTime=''; // get latest starttime of this clientid
        $endTime='';// get latest endtime

        $getData = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
        $startTime = $getData->start_fast;
        $endTime = $getData->end_fast;

        Log::info('EndTime: '.$endTime);

        $getIntermittentFastData= IntermittentFast::select('id','client_id','protocol','protocol_other','auto_diy','timezone')
         ->where('client_id', Auth::User()->account_id)
         ->orderBy('id','desc')
         ->first();

        // $getIntermittentFastData->update(['is_diy_past_run'=>'Yes']); 

        if($getIntermittentFastData->protocol == 'Other' ){
            if($getData->status != "Auto"){
                $protocolOther = json_decode($getIntermittentFastData->protocol_other);
                $otherDays = $protocolOther->days;
                $otherHours = $protocolOther->fasting_hours;
                $totalHours = $otherDays * 24 + $otherHours;
                $endFastDateHours =  date("Y-m-d H:i:s", strtotime("+".$totalHours." hours", strtotime( $startTime )));


                // OVERRIDE START DATA  
                $compareOverrideStartTime = strtotime($getData->start_fast);
                $compareOverrideEndTime = strtotime($endFastDateHours);
                $startDate = date('Y-m-d',strtotime($getData->start_fast));
                $endDate = date('Y-m-d',strtotime($endFastDateHours));
                
                $overrideFastingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->where(function($query) use($startDate,$endDate){

                                $query->whereBetween('start_fast',[$startDate,$endDate])
                                    ->orWhereBetween('end_fast',[$startDate,$endDate])
                                    ->orWhereBetween('start_eat',[$startDate,$endDate])
                                    ->orWhereBetween('end_eat',[$startDate,$endDate])
                                    ->orWhere('start_fast', 'like', '%'.$endDate.'%')
                                    ->orWhere('end_fast', 'like', '%'.$endDate.'%')
                                    ->orWhere('start_eat', 'like', '%'.$endDate.'%')
                                    ->orWhere('end_eat', 'like', '%'.$endDate.'%')
                                    ->orWhere('start_fast', 'like', '%'.$startDate.'%')
                                    ->orWhere('end_fast', 'like', '%'.$startDate.'%')
                                    ->orWhere('start_eat', 'like', '%'.$startDate.'%')
                                    ->orWhere('end_eat', 'like', '%'.$startDate.'%');
                            })
                            ->where('id','!=',$getData->id)
                            ->orderBy('id', 'ASC')
                            ->get();

                $deletedData = [];
                
                if (isset($overrideFastingData) && !$overrideFastingData->isEmpty()) {

                    foreach($overrideFastingData as $keyOverride=>$dataOverride){


                        $fStart = $dataOverride->start_fast;
                        $fEnd = $dataOverride->end_fast;

                        $eStart = $dataOverride->start_eat;
                        $eEnd = $dataOverride->end_eat;

                        if ($fStart !=null && $fEnd !=null && $eStart !=null && $eEnd !=null) {
                        
                            if (strtotime($fStart) >= $compareOverrideStartTime && 
                                strtotime($fEnd) >= $compareOverrideStartTime && 
                                strtotime($eStart) >= $compareOverrideStartTime && 
                                strtotime($eEnd) >= $compareOverrideStartTime &&
                                strtotime($fStart) <= $compareOverrideEndTime && 
                                strtotime($fEnd) <= $compareOverrideEndTime && 
                                strtotime($eStart) <= $compareOverrideEndTime && 
                                strtotime($eEnd) <= $compareOverrideEndTime 
                            ) {
                                    
                                    $dataOverride->delete();

                            }elseif (strtotime($fStart) <= $compareOverrideStartTime && 
                                    strtotime($fEnd) >= $compareOverrideStartTime && 
                                    strtotime($eStart) >= $compareOverrideStartTime  && 
                                    strtotime($eEnd) >= $compareOverrideStartTime) {

                                    $dataOverride->end_fast = $getData->start_fast;
                                    $dataOverride->start_eat = null;
                                    $dataOverride->end_eat = null;
                                    $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideStartTime && 
                                    strtotime($fEnd) <= $compareOverrideStartTime && 
                                    strtotime($eStart) <= $compareOverrideStartTime  && 
                                    strtotime($eEnd) >= $compareOverrideStartTime) {

                                    $dataOverride->end_eat = $getData->start_fast;
                                    $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideEndTime && 
                                        strtotime($fEnd) >= $compareOverrideEndTime && 
                                        strtotime($eStart) >= $compareOverrideEndTime  && 
                                        strtotime($eEnd) >= $compareOverrideEndTime) {
                                        
                                        $dataOverride->start_fast = $endFastDateHours;
                                        $dataOverride->save();

                            }elseif (strtotime($fStart) <= $compareOverrideEndTime && 
                                    strtotime($fEnd) <= $compareOverrideEndTime && 
                                    strtotime($eStart) <= $compareOverrideEndTime  && 
                                    strtotime($eEnd) >= $compareOverrideEndTime) {
                                    
                                    $dataOverride->end_eat = $endFastDateHours;
                                    $dataOverride->save();
                            }


                        }elseif($fStart !=null && $fEnd !=null && $eStart == null && $eEnd == null){

                            if (strtotime($fStart) <= $compareOverrideStartTime && strtotime($fEnd) <= $compareOverrideStartTime) {
                                    
                                $dataOverride->delete();

                            }else if(strtotime($fStart) <= $compareOverrideStartTime && strtotime($fEnd) >= $compareOverrideStartTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->save();
                                
                            }else if(strtotime($fStart) <= $compareOverrideEndTime && strtotime($fEnd) <= $compareOverrideEndTime) {    

                                $dataOverride->delete();
                            }

                        }else if ($fStart !=null && $fEnd ==null && $eStart == null && $eEnd == null) {

                            $dataOverride->delete(); 

                        }else if ($fStart !=null && $fEnd !=null && $eStart != null && $eEnd == null) {
                            
                            if (strtotime($eStart) <= $compareOverrideStartTime) {

                                $dataOverride->end_eat = $getData->start_fast;
                                $dataOverride->save();

                            }elseif(strtotime($fStart) <= $compareOverrideStartTime &&
                                    strtotime($fEnd) >= $compareOverrideStartTime 
                                ){

                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->start_eat = null;
                                $dataOverride->end_eat = null;
                                $dataOverride->save();

                            }
                        }
                    }   
                }

                $getData->update([
                        'end_fast' => $endFastDateHours,
                        'status'=>'Auto'
                  ]);
            }
            $fastingClockModels = FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
            return view('Result.fasting.fasting-clock', ['cycle_start'=>$fastingClockModels->start_fast,'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
        } else {

        $fastingWindow = explode('/',$getIntermittentFastData->protocol)[0];

        // Log::info('Fasting window:'.$fastingWindow);

        $eatingWindow = strval(24 - ((int)$fastingWindow) );

        // Log::info('Fasting window:'.$eatingWindow);
        
        $startTimeVar = strtotime($startTime);

        Log::info('StartTimeVar: '.$startTimeVar);

        $startTimePlus = strtotime("+".$fastingWindow." hours", $startTimeVar);

        if($endTime ==''){
           
            if($startTimeVar <= $currentDatevar && $currentDatevar < $startTimePlus){
                //  return startTime as COUNTUP TIME
                // return $startTimeVar;
                $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $startTimeVar));
                return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$startTimeVar),'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
            }
            else if($startTimeVar <= $currentDatevar && $currentDatevar > $startTimePlus){

                $headTimePlus = $startTimePlus;

                $compareOverrideTime = strtotime($getData->start_fast);
                $store = date('Y-m-d',$getData->start_fast);
                
                $overrideFastingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->where(function($query) use($store){

                                $query->whereDate('start_fast', '>=', $store)
                                ->orWhereDate('end_fast', '>=', $store)
                                ->orWhereDate('start_eat', '>=', $store)
                                ->orWhereDate('end_eat', '>=', $store);
                            })
                            ->where('id','!=',$getData->id)
                            ->orderBy('id', 'ASC')
                            ->get();

                $deletedData = [];

                if (isset($overrideFastingData) && !$overrideFastingData->isEmpty()) {

                    foreach($overrideFastingData as $keyOverride=>$dataOverride){


                        $fStart = $dataOverride->start_fast;
                        $fEnd = $dataOverride->end_fast;

                        $eStart = $dataOverride->start_eat;
                        $eEnd = $dataOverride->end_eat;

                        if ($fStart !=null && $fEnd !=null && $eStart !=null && $eEnd !=null) {
                            
                            if (strtotime($fStart) >= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime && strtotime($eStart) >= $compareOverrideTime && strtotime($eEnd) >= $compareOverrideTime) {
                                    
                                    // $deletedData[] = $dataOverride->id;
                                    $dataOverride->delete();

                            }elseif (strtotime($fStart) <= $compareOverrideTime && strtotime($fEnd) <= $compareOverrideTime && strtotime($eStart) <= $compareOverrideTime  && strtotime($eEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_eat = $getData->start_fast;
                                $dataOverride->save();

                            }elseif ($compareOverrideTime >= strtotime($fStart) && $compareOverrideTime <= strtotime($fEnd) && $compareOverrideTime <= strtotime($eStart) && strtotime($eEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->start_eat = null;
                                $dataOverride->end_eat = null;
                                $dataOverride->save();

                            }


                        }elseif($fStart !=null && $fEnd !=null && $eStart == null && $eEnd == null){

                            if (strtotime($fStart) >= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime) {
                                    
                                $dataOverride->delete();

                            }else if(strtotime($fStart) <= $compareOverrideTime && strtotime($fEnd) >= $compareOverrideTime) {
                                
                                $dataOverride->end_fast = $getData->start_fast;
                                $dataOverride->save();

                            }else{

                                $dataOverride->delete();
                            }

                        }else if ($fStart !=null && $fEnd ==null && $eStart == null && $eEnd == null) {
                            
                            $dataOverride->delete(); 

                        }else if ($fStart !=null && $fEnd !=null && $eStart != null && $eEnd == null) {
                            
                            $dataOverride->delete(); 
                        }
                    }
                } 

                // dd($deletedData);  
                                                    
                while($headTimePlus < $currentDatevar){
                    // # now
                    // # headtime and headtimeplus
                    // save headtimeplus as endtime
                    // check if headtimeplsu + eating window < currenttime
                    //     yes : save headtimeplsu + eating window as startime
                    //            headtimeplsu+= 24
                    //            if now currenttime < heaadtimePlus : return (headtimeplsu - fasting window)
                    //     no : return headtimeplsu // we actually are breaking out of the loop
                    // 
                    $getData->update(array('end_fast' => date('Y-m-d H:i:s',$headTimePlus),'start_eat'=>date('Y-m-d H:i:s',$headTimePlus)));
                    $tempTime = strtotime("+".$eatingWindow." hours", $headTimePlus);
                    if($tempTime <= $currentDatevar){
                            
                        $getData->update(array('end_eat' => date('Y-m-d H:i:s',$tempTime)));

                        $getData=FastingClockModel::create([
                            'client_id'=>Auth::User()->account_id,
                            'start_fast'=>date('Y-m-d H:i:s',$tempTime),
                            'protocol'=>$getIntermittentFastData->protocol,
                            'protocol_other'=>$getIntermittentFastData->protocol_other,
                            'auto_diy'=>$getIntermittentFastData->auto_diy,
                        ]);
                        $headTimePlus = strtotime("+24 hours", $headTimePlus);
                        if($currentDatevar < $headTimePlus){
                            $headTimePlus =strtotime("-".$fastingWindow." hours", $headTimePlus);
                            //return view with date
                            $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $headTimePlus));
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
                        }
                    }
                    else{
                        $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $headTimePlus));
                        return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'mode'=>'eating','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
                    }


                }
                // below seems not applicable anymore
                // if you have come out of this loop na, you must be not have returned. If you are not using return, use flags.
                // now headtimeplus is not grater than currentime. so simply just return headtime NOT HEADTIMEPLUS 
                // headtime = headTimePlsu - fasting window
                //  this all imple assumes that you are returning time less than currenttime FOR COUNTUP NOT COUNTDOWN

            } else {
                $getData=FastingClockModel::where('client_id',Auth::User()->account_id)
                        ->orderBy('id','desc')
                        ->first();
                $estiEndCycle = date('Y-m-d H:i',strtotime("+".$fastingWindow." hours", $startTimeVar));
                return view('Result.fasting.fasting-clock', ['cycle_start'=>$getData->start_fast,'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);

            }


        }
        else{

            //  now here endtime is not null. means we already have both start and end time.
            //  means user had already started eating when last.
            // $endTimePlus=''; // endTime + eating window


            $endTimeVar = strtotime($endTime);
            Log::info('EndTimeVar in date : '.date('Y-m-d H:i:s',$endTimeVar));

            $endTimePlus = strtotime("+".$eatingWindow." hours", $endTimeVar);

            if($currentDatevar < $endTimePlus){
                //  simply return endTime as COUNTUP time
                $getEatingData = FastingClockModel::where('client_id',Auth::User()->account_id)
                            ->orderBy('id','desc')
                            ->first();
                $endTimeVar = strtotime($getEatingData->start_eat);
                $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $endTimeVar));
                // return view('Result.fasting.fasting-clock', ['cycle_start'=>$getEatingData->start_eat,'esti_cycle_end'=>$estiEndCycle,'mode'=>'eating','cmode'=>'AUTO','fastingData'=>$getIntermittentFastData]);
                return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$endTimeVar),'mode'=>'eating','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
            }
            else if($currentDatevar > $endTimePlus){
                Log::info("currentDateVar is greater than endtimplus");
                $headTimePlus = $endTimePlus;

                $getData->update(['end_eat'=>date('Y-m-d H:i:s',$headTimePlus)]);

                while($headTimePlus < $currentDatevar){
                    Log::info("headtimeplus is less than currentDateVar : ".$headTimePlus." < ".$currentDatevar);
                    //  now you should save headtimeplus as startime 
                    // check if headTimePLsu  + fasting windwo < currentime
                    //     yes: save headtimeplus + fasting window as endtime
                    //          headtimeplsu += 24
                    //     no : return headtimeplsu

                    $getData=FastingClockModel::create([
                        'client_id'=>Auth::User()->account_id,
                        'start_fast'=>date('Y-m-d H:i:s',$headTimePlus),
                        'protocol'=>$getIntermittentFastData->protocol,
                        'protocol_other'=>$getIntermittentFastData->protocol_other,
                        'auto_diy'=>$getIntermittentFastData->auto_diy,
                    ]);

                    // create new row with headtimplus as row
                    $tempTime = strtotime("+".$fastingWindow." hours", $headTimePlus);
                    if($tempTime <= $currentDatevar){
                        
                        $getData->update(array('end_fast' => date('Y-m-d H:i:s',$tempTime)));
                        $headTimePlus = strtotime("+24 hours", $headTimePlus);
                        if($currentDatevar < $headTimePlus){
                            $headTimePlus =strtotime("-".$eatingWindow." hours", $headTimePlus);
                            //return view with date
                            $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$eatingWindow." hours", $headTimePlus));
                            return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'mode'=>'eating','cmode'=>'DIY', 'fastingData'=>$getIntermittentFastData]);
                        }
                    }
                    else{
                        $estiEndCycle = date('Y-m-d H:i:s',strtotime("+".$fastingWindow." hours", $headTimePlus));
                        return view('Result.fasting.fasting-clock', ['cycle_start'=>date('Y-m-d H:i:s',$headTimePlus),'mode'=>'fasting','cmode'=>'DIY','fastingData'=>$getIntermittentFastData]);
                    }
                }
                // return similar to above
                // headime = headtimplsu - eating window
            }
        }
      }
      /* end else */
    }

    function fastingSummarySave(Request $request){

        setDefaultTimezone();

        $start_eating = date("Y-m-d H:i:s");
        FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update([
            'start_fast'=>$request->start_fast,
            'end_fast'=>$request->end_fast,
            'mood'=>$request->mood,
            'fasting_mood'=>$request->mood,
        ]);
            
        // FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update(['start_fast'=>$request->start_fast,'end_fast'=>$request->end_fast,'mood'=>$request->mood]);
         
    }

    function loadFastingSummary(){
        $getData=FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First();
        
        $diff=abs(strtotime($getData->start_fast)-strtotime($getData->end_fast));
        // $diff=date('Y-n-j H:i:s',strtotime($getData->start_fast));
        return view('Result.fasting.fasting-summary',['start_fast'=>$getData->start_fast,'end_fast'=>$getData->end_fast,'diff'=>$diff]);
    }

    function updateStartTime(Request $request){

        setDefaultTimezone();

        FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update(['start_fast'=>$request->start_fast]);
        return response()->json(['url'=>url('/fasting-clock-controller')]);
    }

    function preEndFast(Request $request){

        setDefaultTimezone();

        // save endfast as current time
        FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update(['end_fast'=>$request->current_time]);
        return response()->json(['url'=>url('/fasting-clock-controller')]);
    }

    function preEndEating(Request $request){
        // save startfast as current time
        // $getIntermittentFastData= IntermittentFast::select('id','client_id','protocol')
        //  ->where('client_id', Auth::User()->account_id)
        //  ->orderBy('id','desc')
        //  ->first();
        
        // $fastingWindow = explode('/',$getIntermittentFastData->protocol)[0];

        // $eatingWindow = strval(24 - ((int)$fastingWindow) );
        // FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update(['start_fast'=>$request->current_time,'end_fast'=>date('Y-n-j H:i:s',strtotime("+".$eatingWindow." hours", $request->current_time))]);

        setDefaultTimezone();

        $getIntermittentFastData= IntermittentFast::select('id','client_id','auto_diy','protocol','protocol_other')
         ->where('client_id', Auth::User()->account_id)
         ->orderBy('id','desc')
         ->first();

        FastingClockModel::where('client_id',Auth::User()->account_id)->orderBy('id','desc')->First()->update(['start_fast'=>$request->current_time,'end_fast'=>date('Y-n-j H:i:s',strtotime("+24 hours", $request->current_time))]);
        $getData=FastingClockModel::create([
            'client_id'=>Auth::User()->account_id,
            'start_fast'=>date('Y-n-j H:i:s',strtotime("+24 hours", $request->current_time)),
            'protocol'=>$getIntermittentFastData->protocol,
            'protocol_other'=>$getIntermittentFastData->protocol_other,
            'auto_diy'=>$getIntermittentFastData->auto_diy,

            ]);

        return response()->json(['url'=>url('/fasting-clock-controller')]);
        // simply put a condition in clock that if currenttime is less than start time then show 'YET TO START'
    }


    


    function getMoodData(){
        $previous_page = $_SERVER['HTTP_REFERER'];
        $path_parts = pathinfo($previous_page);
        $preUrl = $path_parts['basename']; //route name
        $client_id = Auth::User()->account_id;
        $todayDate = date("Y-m-d");
        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($todayDate)));
        // dd($date1);
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($todayDate)));
        $variable1 = strtotime($date1);
        // dd($variable1);
        $variable2 = strtotime($date2);
        $datArr = array();
        $formattedDateArr = array();

        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) {
            $store = date('Y-m-d', $currentDate);
            // dd($store);
            // $nextLoopDate = date('Y-n-j', strtotime('+1 day', strtotime($store))); 
            $currRow = FastingClockModel::where('client_id', $client_id)
                ->whereDate('start_fast', 'like', '%' . $store . '%')
                ->orderBy('id', 'DESC')
                ->get();

            $totalSumOfMood = 0;
            $totalMoodCount = 0;

            if (!$currRow->isEmpty()) {
                foreach($currRow as $key=>$v){
                        

                    if (!is_null($v->fasting_mood)) {
                                    
                        $totalSumOfMood += $v->fasting_mood;
                        $totalMoodCount++;
                        
                    }

                    if (!is_null($v->eating_mood)) {
                                                
                        $totalSumOfMood += $v->eating_mood;
                        $totalMoodCount++;
                        
                    }

                }

            }    
            
            if ($totalMoodCount != 0) {
                
                $average = ($totalSumOfMood)/($totalMoodCount);

            }else{

                $average = 0;
            }
            if ($average != 0) {
                
                $datArr[]= round($average,2);

            }else{

                $datArr[]= 'N/A';
            }

            $formattedDateArr[]=date('j M',$currentDate);
        }
        
        return view('Result.fasting.mood-history',['gdata'=>$datArr,'forDates'=>$formattedDateArr, 'date1'=>$date1, 'date2'=>$date2,'preUrl'=>$preUrl]);
    }

    function getMoodDataPrev(Request $request){
        $client_id = Auth::User()->account_id;
        $todayDate = date("Y-m-d");
        $tempStr = '-'.strval($request->preweek).' weeks';
        // $tempStr = '-1 weeks';
        $dateConsider = date("Y-m-d", strtotime($tempStr, strtotime($todayDate)));
        // $dateConsider = date("Y-m-d", strtotime('-'++' weeks', strtotime($todayDate)));
        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($dateConsider)));
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($dateConsider)));
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);
        $datArr = array();
        $formattedDateArr = array();
        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) {
             $store = date('Y-m-d', $currentDate);
            // dd($store);
            // $nextLoopDate = date('Y-n-j', strtotime('+1 day', strtotime($store))); 
            $currRow = FastingClockModel::where('client_id', $client_id)
                ->whereDate('start_fast', 'like', '%' . $store . '%')
                ->orderBy('id', 'DESC')
                ->get();

            $totalSumOfMood = 0;
            $totalMoodCount = 0;

            if (!$currRow->isEmpty()) {

                foreach($currRow as $key=>$v){
                        

                    if (!is_null($v->fasting_mood)) {
                                    
                        $totalSumOfMood += $v->fasting_mood;
                        $totalMoodCount++;
                        
                    }

                    if (!is_null($v->eating_mood)) {
                                                
                        $totalSumOfMood += $v->eating_mood;
                        $totalMoodCount++;
                        
                    }

                }

            }    
            
            if ($totalMoodCount != 0) {
                
                $average = ($totalSumOfMood)/($totalMoodCount);

            }else{

                $average = 0;
            }
            
            $datArr[]= round($average,2);
            
            $formattedDateArr[]=date('j M',$currentDate);
        }
        return response()->json(['gdata'=>$datArr,'forDates'=>$formattedDateArr, 'date1'=>date('j M',$variable1), 'date2'=>date('j M',$variable2)]);
    }

    function loadEatingSummary(){

        $sessionData = \Session::all();

        if (isset($sessionData['fasting_clock_id']) && !empty($sessionData['fasting_clock_id'])) {
            
            $getData = FastingClockModel::where('id',$sessionData['fasting_clock_id'])->firstOrFail();
                
            $diff=abs(strtotime($getData->start_eat)-strtotime($getData->end_eat));
            
            return view('Result.fasting.eating-summary',['getData'=>$getData,'start_fast'=>$getData->start_eat,'end_fast'=>$getData->end_eat,'diff'=>$diff]);

        }else{

            return redirect()->route('fasting.clock');
        }

    }

    function eatingSummarySave(Request $request){

        setDefaultTimezone();

        $start_eating = date("Y-m-d H:i:s");
        FastingClockModel::where('id',$request->fasting_clock_id)->First()->update([
            // 'start_fast'=>$request->start_fast,
            // 'end_fast'=>$request->end_fast,
            'eating_mood'=>$request->mood,
            // 'start_eat'=>$start_eating,
        ]);

        \Session::forget('fasting_clock_id');
    }

    public function fastingClockRunBackground(Request $request){

        $input = $request->all();
        setDefaultTimezone();

        $now = getdate();
        $currentDay = $now['mday'];
        $currentMonth = $now['mon'];
        $currentYear = $now['year'];
        $currentHour = $now['hours'];
        $currentMinute = $now['minutes'];
        $currentSecond = $now['seconds'];
        $currentDateMk = mktime($currentHour,$currentMinute,$currentSecond,$currentMonth,$currentDay,$currentYear);
        $currentDate = date("Y-m-d H:i:s", $currentDateMk);
        $currentDatevar = strtotime($currentDate);

        if (!empty($input['intermediate_id'])) {
            
            $intermediateData = \App\Models\IntermittentFast::where('id',$input['intermediate_id'])->firstOrFail();

            if ($intermediateData->protocol == 'Other') {
                
                $fastingData  = \App\Models\FastingClockModel::where('client_id',\Auth::user()->account_id)->orderBy('id','DESC')->First();

                if ($fastingData !=null && $fastingData->end_fast !='') {
                    
                    $endtime = strtotime($fastingData->end_fast);

                    if ($endtime <= $currentDatevar) {
                        
                        $intermediateData->update(['status'=>'Yes']);
                        $fastingData->update(['status'=>'Show']);

                        return response()->json(['status'=>true,'url'=>route('fasting')]);
                    }

                }else{

                    return response()->json(['status'=>false]);
                }
            }elseif($intermediateData->protocol != 'Other' && $intermediateData->auto_diy == 'DIY'){

                return response()->json(['status'=>false]);
            }

        }

        if (isset($input['esti_cycle_end'])) {
            
            
            $endtime = strtotime($input['esti_cycle_end']);

            if ($endtime <= $currentDatevar) {
                       
                return response()->json(['status'=>true]);
            }

        }
        return response()->json(['status'=>false]);
    }
} 
