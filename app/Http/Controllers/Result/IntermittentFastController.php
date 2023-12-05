<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parq;
use App\Models\PersonalMeasurement;
use App\Models\Clients;
use App\Models\IntermittentFast;
use App\Models\FastingClockModel;
use Auth;
use View;

class IntermittentFastController extends Controller
{

    public function fastShow(){

        $client_id = Auth::User()->account_id;

        $fastingData = IntermittentFast::select('id','client_id','status')
                         ->where('client_id', $client_id)
                         ->orderBy('id','desc')
                         ->first();
                         
        if($fastingData && $fastingData->status != 'Yes'){

            return redirect()->route('fasting.clock');

        } else {
            
            return view("Result.fasting.fasting");
        }

        // return view("Result.fasting.fasting");
        
    }
    public function show()
    {
        $client_id = Auth::User()->account_id;
        $measurement =  PersonalMeasurement::select('id', 'client_id', 'height', 'weight', 'weightUnit', 'heightUnit')
                        ->where('client_id', $client_id)
                        ->orderBy('event_date', 'DESC')
                        ->orderBy('id', 'desc')
                        ->whereNull('deleted_at')
                        ->first();
                 
        if(($measurement->height == 0.0 || $measurement->height == 0) && ($measurement->weight == null)){
             $measurement = Parq::select('id', 'client_id', 'height', 'weight', 'weightUnit', 'heightUnit')
                            ->where('client_id', $client_id)
                            ->orderBy('id', 'desc')
                            ->whereNull('deleted_at')
                            ->first();
          }
        // $data =  Parq::select('id','client_id','gender')
        //                 ->where('client_id',$client_id)
        //                 ->orderBy('id','desc')
        //                 ->first();
        $personal_detail =  Clients::select('id','birthday','gender')
                        ->where('id',$client_id)
                        ->first();
        $fastingData = IntermittentFast::select('id','client_id','achieve','date_of_birth',
                        'gender','experience','height','weight','protocol','protocol_other','status')
                         ->where('client_id', $client_id)
                         ->orderBy('id','desc')
                         ->first();
        //   if($fastingData && $fastingData->status != 'Yes'){
        //         return redirect()->route('fasting.clock');
        //     } else {
        //         return view("Result.fasting.fasting-form",compact('measurement','personal_detail','fastingData'));
        //     }
            return view("Result.fasting.fasting-form",compact('measurement','personal_detail','fastingData'));
    }

    public function store(Request $request)
    {
        $reqData = $request['data'];

        date_default_timezone_set($reqData['timezone']);
        
        $client_id = Auth::User()->account_id;
        if ($reqData['protocol'] == 'Other') {
            $protocol_other = [];
            $protocol_other['days'] = $reqData['days'];
            $protocol_other['fasting_hours'] = $reqData['fasting_hours'];
        }

        
        $customProtocol = isset($reqData['protocolCustom']) ? $reqData['protocolCustom'] : '';

        $fastingStore = IntermittentFast::updateOrCreate(
            ['id'=> $reqData['id']],
            ['client_id'=> $client_id,
            'achieve'=> $reqData['achieve'],
            'gender'=> $reqData['gender'],
            'experience'=> (isset($customProtocol)) ? $customProtocol : $requestData['experience'] ,
            'protocol'=>  $reqData['protocol'],
            'protocol_other'=> ( isset($protocol_other) ) ? json_encode($protocol_other) : null,
            // 'date_of_birth'=> $reqData['date_of_birth'],
            'date_of_birth'=> date('Y-m-d', strtotime($reqData['date_of_birth'])),
            'weight'=> $reqData['weight'],
            'height'=> $reqData['height'],
            'status'=>'No',
            'auto_diy'=>$reqData['auto_diy'],
        ]);

        FastingClockModel::create([
            'client_id' => Auth::User()->account_id,
            'start_fast' => $reqData['start_date'].' '.$reqData['start_time'].':00',
            'protocol'=>$fastingStore->protocol,
            'protocol_other'=>$fastingStore->protocol_other,
            'auto_diy'=>$fastingStore->auto_diy

        ]);
        
        $parq = \App\Models\Parq::where('client_id',\Auth::user()->account_id)->first();

        if (isset($parq) && !empty($parq)) {
            
            $parq->timezone = $reqData['timezone'];    
            $parq->save();
        }    

        $fastingStore->timezone = $reqData['timezone'];
        $fastingStore->Save();
        
        $response = [
            'status' => 'ok',
            'data' => $fastingStore,
        ];
        return response()->json($response);
    }

    public function fastingHistory()
    {
        setDefaultTimezone();
        $previous_page = $_SERVER['HTTP_REFERER'];
        $path_parts = pathinfo($previous_page);
        $preUrl = $path_parts['basename']; //route name
        $client_id = Auth::User()->account_id;
        $todayDate = date("Y-m-d");
        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($todayDate)));
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($todayDate)));
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);
        $fastArray = [];
        $avgAmoutFastingArray = [];
        $avgAmoutEatingArray = [];
        
        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) 
        {   
            $eatingProgresBar = "0";
            $progresBar = "0";

            $hour = [];
            $minute = [];
            $seconds = [];
            $eating_minute = [];
            $eating_hour = [];
            $fastAndEatData = [];
            $store = date('Y-m-d', $currentDate);   
            
            /*  */
            $nextLoopDate = date('Y-m-d', strtotime('+1 day', strtotime($store))); // fast end date
            $preLoopDate = date('Y-m-d', strtotime('-1 day', strtotime($store))); // fast start date
            /*  */
            $timestamp = strtotime($store);
            $date = date('d', $timestamp);
            $month =  date('M', $timestamp);
            $time = "0";
            
            $allOneDayFastingData = FastingClockModel::where('client_id',$client_id)
                            ->where(function($query) use($store){

                                $query->where('start_fast', 'like', '%'.$store.'%')
                                    ->orWhere('end_fast', 'like', '%'.$store.'%')
                                    ->orWhere('start_eat', 'like', '%'.$store.'%')
                                    ->orWhere('end_eat', 'like', '%'.$store.'%')
                                    ->orWhereDate('start_fast','<=',$store)
                                    ->orWhereDate('end_fast','<=',$store)
                                    ->orWhereDate('start_eat','<=',$store)
                                    ->orWhereDate('end_eat','<=',$store);
                            })
                            ->orderBy('start_fast', 'ASC')
                            ->get();

            if(count($allOneDayFastingData) > 0){ 
                foreach($allOneDayFastingData as $weekFastEat){   
                    
                    $chunkFasting = '';
                    $chunkEating = '';

                    if(!empty($weekFastEat->start_fast) && !empty($weekFastEat->end_fast) && !empty($weekFastEat->start_eat) && !empty($weekFastEat->end_eat)){

                        $totalFastSeconds = strtotime($weekFastEat->end_fast) - strtotime($weekFastEat->start_fast);
                        $totalEatSeconds = strtotime($weekFastEat->end_eat) - strtotime($weekFastEat->start_eat);

                        $totalSeconds = $totalFastSeconds + $totalEatSeconds;

                        if ($totalSeconds == 86400) {
                            
                            $chunkFasting = true;

                            $chunkEating = true;
                        }


                    }

                    if(!empty($weekFastEat->start_fast) && !empty($weekFastEat->end_fast) && $store <= date('Y-m-d')){
                        
                        // START FAST
                        $startTime = new \DateTime($weekFastEat->start_fast);
                        $startDate = $startTime->format('Y-m-d');
                        // END FAST 
                        $endTime = new \DateTime($weekFastEat->end_fast);
                        $endDate = $endTime->format('Y-m-d');

                        if ($startDate == $store && $endDate == $store) {
                            
                            $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_fast);
                            
                            $totalendSeconds = convertTimeToSeconds($weekFastEat->end_fast); 

                            $totalFastSeconds =  $totalendSeconds - $totalStartSeconds;

                            $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                            

                            $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                            if ($chunkFasting == true && $chunkEating == true) {
                                
                                $fastAndEatData['chunk'] = true;
                            }

                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;


                        }else if ($startDate == $store || $endDate == $store) {
                            
                            if ($startDate == $store && $endDate != $store) {

                                $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_fast);

                                $totalFastSeconds = 86400 - $totalStartSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,4);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>86400,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                                if ($chunkFasting == true && $chunkEating == true) {
                                    
                                    $fastAndEatData['chunk'] = true;
                                }

                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                            }elseif ($startDate != $store && $endDate == $store) {

                                $totalendSeconds = convertTimeToSeconds($weekFastEat->end_fast);  

                                $totalFastSeconds = $totalendSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>0,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                                if ($chunkFasting == true && $chunkEating == true) {
                                    
                                    $fastAndEatData['chunk'] = true;
                                }

                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                            }

                        }else{

                            $earlier = new \DateTime($weekFastEat->start_fast);
                            $later = new \DateTime($weekFastEat->end_fast);
                            $dayDiff = $later->diff($earlier)->format("%a"); //3
                                
                            $fastingStartTime = $weekFastEat->start_fast;
                            for ($cDate = 1; $cDate <= $dayDiff; $cDate += 1) {

                                $stop_date = new \DateTime($fastingStartTime);
                                $stop_date->modify('+1 day');

                                if (strtotime($stop_date->format('Y-m-d'))  <= strtotime(date('Y-m-d'))) {
                                    
                                    if ($stop_date->format('Y-m-d') == $store) {
                                        
                                        if ($stop_date->format('Y-m-d') == date('Y-m-d')) {
                                            
                                            $totalFastSecond = convertTimeToSeconds(date('Y-m-d H:i:s'));

                                            $totalFastPercentage = round(($totalFastSecond/86400)*100,3);

                                            $fastAndEatData = [
                                                            'percentage'=>$totalFastPercentage,
                                                            'type'=>'fasting',
                                                            'total_seconds'=>$totalFastSecond,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>$totalFastSecond,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                                        }else{
                                            
                                            $fastAndEatData = [
                                                            'percentage'=>100,
                                                            'type'=>'fasting',
                                                            'total_seconds'=>86400,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>86400,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                                        }   

                                        break;
                                    }
                                }


                                $fastingStartTime = $stop_date->format('Y-m-d H:i:s');

                            }
                        }
                    }


                    if(!empty($weekFastEat->start_eat) && !empty($weekFastEat->end_eat) && $store <= date('Y-m-d')){
                        
                        // START FAST
                        $startTime = new \DateTime($weekFastEat->start_eat);
                        $startDate = $startTime->format('Y-m-d');
                        // END FAST 
                        $endTime = new \DateTime($weekFastEat->end_eat);
                        $endDate = $endTime->format('Y-m-d');

                        if ($startDate == $store && $endDate == $store) {
                            
                            $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_eat);

                            $totalendSeconds = convertTimeToSeconds($weekFastEat->end_eat); 

                            $totalFastSeconds =  $totalendSeconds - $totalStartSeconds;

                            $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                            $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                            if ($chunkFasting == true && $chunkEating == true) {
                                
                                $fastAndEatData['chunk'] = true;
                            }                
                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;


                        }else if ($startDate == $store || $endDate == $store) {
                            
                            if ($startDate == $store && $endDate != $store) {

                                $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_eat);

                                $totalFastSeconds = 86400 - $totalStartSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,4);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>86400,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                                if ($chunkFasting == true && $chunkEating == true) {
                                
                                    $fastAndEatData['chunk'] = true;
                                }   
                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                            }elseif ($startDate != $store && $endDate == $store) {
                                
                                $totalendSeconds = convertTimeToSeconds($weekFastEat->end_eat);
                                $totalFastSeconds = $totalendSeconds;
                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>0,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                                if ($chunkFasting == true && $chunkEating == true) {
                                
                                    $fastAndEatData['chunk'] = true;
                                }   
                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                            }

                        }else{

                            $earlier = new \DateTime($weekFastEat->start_eat);
                            $later = new \DateTime($weekFastEat->end_eat);
                            $dayDiff = $later->diff($earlier)->format("%a"); //3
                                
                            $fastingStartTime = $weekFastEat->start_eat;
                            for ($cDate = 1; $cDate <= $dayDiff; $cDate += 1) {

                                $stop_date = new \DateTime($fastingStartTime);
                                $stop_date->modify('+1 day');

                                if (strtotime($stop_date->format('Y-m-d'))  <= strtotime(date('Y-m-d'))) {
                                    
                                    if ($stop_date->format('Y-m-d') == $store) {
                                        
                                        if ($stop_date->format('Y-m-d') == date('Y-m-d')) {
                                            
                                            $totalFastSecond = convertTimeToSeconds(date('Y-m-d H:i:s'));

                                            $totalFastPercentage = round(($totalFastSecond/86400)*100,3);

                                            $fastAndEatData = [
                                                            'percentage'=>$totalFastPercentage,
                                                            'type'=>'eating',
                                                            'total_seconds'=>$totalFastSecond,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>$totalFastSecond,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                                        }else{
                                            
                                            $fastAndEatData = [
                                                            'percentage'=>100,
                                                            'type'=>'eating',
                                                            'total_seconds'=>86400,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>86400,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                                        }   

                                        break;
                                    }
                                }


                                $fastingStartTime = $stop_date->format('Y-m-d H:i:s');

                            }

                        }
                    }
                }
            }

            
            $fastArray[$store]['short_date'] = $date;
            $fastArray[$store]['month'] = $month;
            $fastArray[$store]['date'] = $store;
        }
        /*  */

        // dd($fastArray,$date1,$date2);

        return view("Result.fasting.fasting-history",compact('date1','date2','fastArray','preUrl'));
     }
     
    public function filterFastGraph(Request $request)
    {
        $input = $request->all();

        $client_id = Auth::User()->account_id;
        $avgAmoutFasting = null;
        if (isset($input['sDate']) && !empty($input['sDate'])) {
            
            $graphType = $request['graphType'];
            $todayDate = $input['sDate'];
            
        }else{

            $date = $request['date'];
            $graphType = $request['graphType'];
            if ($request['type'] == "next-btn") {
                $todayDate = date('Y-m-d', strtotime('+1 day', strtotime($date)));
            } elseif ($request['type'] == "pre-btn") {
                $todayDate = date('Y-m-d', strtotime('-1 day', strtotime($date)));
            }
        }

        $date1 = date("Y-m-d", strtotime('monday this week', strtotime($todayDate)));
        $date2 = date("Y-m-d", strtotime('sunday this week', strtotime($todayDate)));
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);
        $fastArray = [];
        $avgAmoutFastingArray = [];
        $avgAmoutEatingArray = [];
        for ($currentDate = $variable1; $currentDate <= $variable2; $currentDate += (86400)) 
         {   
           $eatingProgresBar = "0";
           $progresBar = "0"; 
           $hour = [];
           $minute = [];
           $eating_minute = [];
           $eating_hour = [];
           $fastAndEatData = [];
           $store = date('Y-m-d', $currentDate);   
           $timestamp = strtotime($store);
           $date = date('d', $timestamp);
           $month =  date('M', $timestamp);
           $time = "0";

            $eatingStore = date('Y-m-d', $currentDate);     
            
            $allOneDayFastingData = FastingClockModel::where('client_id',$client_id)
                            ->where(function($query) use($store){

                                $query->where('start_fast', 'like', '%'.$store.'%')
                                    ->orWhere('end_fast', 'like', '%'.$store.'%')
                                    ->orWhere('start_eat', 'like', '%'.$store.'%')
                                    ->orWhere('end_eat', 'like', '%'.$store.'%')
                                    ->orWhereDate('start_fast','<=',$store)
                                    ->orWhereDate('end_fast','<=',$store)
                                    ->orWhereDate('start_eat','<=',$store)
                                    ->orWhereDate('end_eat','<=',$store);
                            })
                            ->orderBy('start_fast', 'ASC')
                            ->get();

            if(count($allOneDayFastingData) > 0){ 
                foreach($allOneDayFastingData as $weekFastEat){   
                    
                    $chunkFasting = '';
                    $chunkEating = '';

                    if(!empty($weekFastEat->start_fast) && !empty($weekFastEat->end_fast) && !empty($weekFastEat->start_eat) && !empty($weekFastEat->end_eat)){

                        $totalFastSeconds = strtotime($weekFastEat->end_fast) - strtotime($weekFastEat->start_fast);
                        $totalEatSeconds = strtotime($weekFastEat->end_eat) - strtotime($weekFastEat->start_eat);

                        $totalSeconds = $totalFastSeconds + $totalEatSeconds;

                        if ($totalSeconds == 86400) {
                            
                            $chunkFasting = true;

                            $chunkEating = true;
                        }


                    }

                    if(!empty($weekFastEat->start_fast) && !empty($weekFastEat->end_fast) && $store <= date('Y-m-d')){
                        
                        // START FAST
                        $startTime = new \DateTime($weekFastEat->start_fast);
                        $startDate = $startTime->format('Y-m-d');
                        // END FAST 
                        $endTime = new \DateTime($weekFastEat->end_fast);
                        $endDate = $endTime->format('Y-m-d');

                        if ($startDate == $store && $endDate == $store) {
                            
                            $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_fast);
                            
                            $totalendSeconds = convertTimeToSeconds($weekFastEat->end_fast); 

                            $totalFastSeconds =  $totalendSeconds - $totalStartSeconds;

                            $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                            

                            $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                            if ($chunkFasting == true && $chunkEating == true) {
                                
                                $fastAndEatData['chunk'] = true;
                            }

                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;


                        }else if ($startDate == $store || $endDate == $store) {
                            
                            if ($startDate == $store && $endDate != $store) {

                                $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_fast);

                                $totalFastSeconds = 86400 - $totalStartSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,4);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>86400,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                                if ($chunkFasting == true && $chunkEating == true) {
                                    
                                    $fastAndEatData['chunk'] = true;
                                }

                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                            }elseif ($startDate != $store && $endDate == $store) {

                                $totalendSeconds = convertTimeToSeconds($weekFastEat->end_fast);  

                                $totalFastSeconds = $totalendSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'fasting',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>0,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];

                                if ($chunkFasting == true && $chunkEating == true) {
                                    
                                    $fastAndEatData['chunk'] = true;
                                }

                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                            }

                        }else{

                            $earlier = new \DateTime($weekFastEat->start_fast);
                            $later = new \DateTime($weekFastEat->end_fast);
                            $dayDiff = $later->diff($earlier)->format("%a"); //3
                                
                            $fastingStartTime = $weekFastEat->start_fast;
                            for ($cDate = 1; $cDate <= $dayDiff; $cDate += 1) {

                                $stop_date = new \DateTime($fastingStartTime);
                                $stop_date->modify('+1 day');

                                if (strtotime($stop_date->format('Y-m-d'))  <= strtotime(date('Y-m-d'))) {
                                    
                                    if ($stop_date->format('Y-m-d') == $store) {
                                        
                                        if ($stop_date->format('Y-m-d') == date('Y-m-d')) {
                                            
                                            $totalFastSecond = convertTimeToSeconds(date('Y-m-d H:i:s'));

                                            $totalFastPercentage = round(($totalFastSecond/86400)*100,3);

                                            $fastAndEatData = [
                                                            'percentage'=>$totalFastPercentage,
                                                            'type'=>'fasting',
                                                            'total_seconds'=>$totalFastSecond,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>$totalFastSecond,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                                        }else{
                                            
                                            $fastAndEatData = [
                                                            'percentage'=>100,
                                                            'type'=>'fasting',
                                                            'total_seconds'=>86400,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>86400,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                                        }   

                                        break;
                                    }
                                }


                                $fastingStartTime = $stop_date->format('Y-m-d H:i:s');

                            }
                        }
                    }


                    if(!empty($weekFastEat->start_eat) && !empty($weekFastEat->end_eat) && $store <= date('Y-m-d')){
                        
                        // START FAST
                        $startTime = new \DateTime($weekFastEat->start_eat);
                        $startDate = $startTime->format('Y-m-d');
                        // END FAST 
                        $endTime = new \DateTime($weekFastEat->end_eat);
                        $endDate = $endTime->format('Y-m-d');

                        if ($startDate == $store && $endDate == $store) {
                            
                            $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_eat);

                            $totalendSeconds = convertTimeToSeconds($weekFastEat->end_eat); 

                            $totalFastSeconds =  $totalendSeconds - $totalStartSeconds;

                            $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                            $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                            if ($chunkFasting == true && $chunkEating == true) {
                                
                                $fastAndEatData['chunk'] = true;
                            }                
                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;


                        }else if ($startDate == $store || $endDate == $store) {
                            
                            if ($startDate == $store && $endDate != $store) {

                                $totalStartSeconds = convertTimeToSeconds($weekFastEat->start_eat);

                                $totalFastSeconds = 86400 - $totalStartSeconds;

                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,4);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>$totalStartSeconds,
                                                'fast_end_time'=>86400,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                                if ($chunkFasting == true && $chunkEating == true) {
                                
                                    $fastAndEatData['chunk'] = true;
                                }   
                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                            }elseif ($startDate != $store && $endDate == $store) {
                                
                                $totalendSeconds = convertTimeToSeconds($weekFastEat->end_eat);
                                $totalFastSeconds = $totalendSeconds;
                                $totalFastPercentage = round(($totalFastSeconds/86400)*100,3);
                        
                                $fastAndEatData = [
                                                'percentage'=>$totalFastPercentage,
                                                'type'=>'eating',
                                                'total_seconds'=>$totalFastSeconds,
                                                'fast_start_time'=>0,
                                                'fast_end_time'=>$totalendSeconds,
                                                'fastingId'=>$weekFastEat->id

                                            ];
                                if ($chunkFasting == true && $chunkEating == true) {
                                
                                    $fastAndEatData['chunk'] = true;
                                }   
                                $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                            }

                        }else{

                            $earlier = new \DateTime($weekFastEat->start_eat);
                            $later = new \DateTime($weekFastEat->end_eat);
                            $dayDiff = $later->diff($earlier)->format("%a"); //3
                                
                            $fastingStartTime = $weekFastEat->start_eat;
                            for ($cDate = 1; $cDate <= $dayDiff; $cDate += 1) {

                                $stop_date = new \DateTime($fastingStartTime);
                                $stop_date->modify('+1 day');

                                if (strtotime($stop_date->format('Y-m-d'))  <= strtotime(date('Y-m-d'))) {
                                    
                                    if ($stop_date->format('Y-m-d') == $store) {
                                        
                                        if ($stop_date->format('Y-m-d') == date('Y-m-d')) {
                                            
                                            $totalFastSecond = convertTimeToSeconds(date('Y-m-d H:i:s'));

                                            $totalFastPercentage = round(($totalFastSecond/86400)*100,3);

                                            $fastAndEatData = [
                                                            'percentage'=>$totalFastPercentage,
                                                            'type'=>'eating',
                                                            'total_seconds'=>$totalFastSecond,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>$totalFastSecond,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;

                                        }else{
                                            
                                            $fastAndEatData = [
                                                            'percentage'=>100,
                                                            'type'=>'eating',
                                                            'total_seconds'=>86400,
                                                            'fast_start_time'=>0,
                                                            'fast_end_time'=>86400,
                                                            'fastingId'=>$weekFastEat->id

                                                        ];

                                            $fastArray[$store]['fastAndEatData'][] = $fastAndEatData;
                                        }   

                                        break;
                                    }
                                }


                                $fastingStartTime = $stop_date->format('Y-m-d H:i:s');

                            }

                        }
                    }
                }
            }
            
            $fastArray[$store]['short_date'] = $date;
            $fastArray[$store]['month'] = $month;
            $fastArray[$store]['date'] = $store;
        }   

        if($graphType == 'fasting'){
            $html = View::make('Result.fasting.fasting-graph',compact('fastArray','date1','date2','fastArray','avgAmoutFasting'));
        }
        $response['html'] = $html->render();
        $response['status'] = 'ok';
        return response()->json($response);
    }



    public function fastingSetting(){
        setDefaultTimezone();
        $client_id = Auth::User()->account_id;
        $fastingData = IntermittentFast::with('fastingClockModel')->select('id','client_id','achieve','date_of_birth',
                         'gender','experience','height','weight','protocol','auto_diy')
                         ->where('client_id', $client_id)
                         ->orderBy('id','desc')
                         ->first();
         $fastingClockArray = '';
        if(count($fastingData['fastingClockModel']) > 0){
             $fastingClockArray = $fastingData['fastingClockModel'][0]; 
        } 

        if($fastingData){
            return view("Result.fasting.fasting-setting",compact('fastingData','fastingClockArray'));
        } else {
            return view("Result.fasting.fasting");
        }   
        
    }

    public function settingStatus(){

        $client_id = Auth::User()->account_id;
        $fastingFetch = IntermittentFast::where('client_id',$client_id)
                      ->orderBy('id','desc')
                      ->first();
        if($fastingFetch){
            $fastingStore =  $fastingFetch->update([
                'status'=>'Yes'
            ]);

            $response = ['status' => 'ok'];
        } else {
            $response = ['status' => 'error'];
        }
        return response()->json($response);
    }

    /* end  */

    /**
     * This functin is used to stop fasting and eating cycle
     * @author Chirag Ghevariya
     */
    public function stopCycle(Request $request){

        setDefaultTimezone();

        $client_id = Auth::User()->account_id;
        $fastingFetch = IntermittentFast::where('client_id',$client_id)
                      ->orderBy('id','desc')
                      ->first();
        if($fastingFetch){
           
            $fastingStore =  $fastingFetch->update([
                'status'=>'Yes'
            ]);


            $fastingClock = FastingClockModel::where('client_id',$client_id)
                      ->orderBy('id','desc')
                      ->first();

            if ($fastingClock) {

                if ($fastingFetch->protocol == 'Other') {
                    

                    $currentTime = strtotime("now");
                    $startTime = strtotime($fastingClock->start_fast); 

                    if ($startTime > $currentTime) {
                        
                        $fastingClock->delete();        

                    }else{

                        $fastingClock->end_fast = date("Y-m-d H:i:s");
                        $fastingClock->save();
                    }


                }else{

                    if($fastingClock->end_fast == null && $fastingClock->end_eat == null) {
                        
                        $currentTime = strtotime("now");
                        $startTime = strtotime($fastingClock->start_fast); 

                        if($startTime > $currentTime) {
                            
                            $fastingClock->delete();

                        }else{

                            $fastingClock->end_fast = date("Y-m-d H:i:s");
                            $fastingClock->save();
                        }


                    }else if($fastingClock->start_eat !=null){
                        
                        $currentTime = strtotime("now");
                        $startTime = strtotime($fastingClock->start_eat); 

                        if ($startTime > $currentTime) {
                            
                            $fastingClock->start_eat = null;
                            $fastingClock->save();

                        }else{

                            $fastingClock->end_eat = date("Y-m-d H:i:s");
                            $fastingClock->save();

                        }

                    }

                }


                // $fastingClock->save();
            
            }   

            // Carbon::now()->format('Y-m-d H:i:s');          

            $response = ['status' => 'ok'];

        } else {

            $response = ['status' => 'error'];
        }

        return response()->json($response);

    }

    /**
     * This funciton is used to get all protocol
     * @author Chirag Ghevariya
     */
    public function getAllProtocol(Request $request){

        
        $fastingData =  \App\Models\IntermittentFast::where('id',$request->fastingId)->first();

        return view('Result.fasting.get-all-protocol',compact('fastingData'));
    }

    public function overrideConfirmPopup(Request $request){

        setDefaultTimezone();

        $startDatetime  = $request->start_date .' '.$request->start_time.':00';

        $getCount = \App\Models\FastingClockModel::where('client_id',\Auth::User()->account_id)
                                        ->where(function($query) use($startDatetime){

                                            $query->where('start_fast','>=',$startDatetime)
                                            ->orWhere('start_eat','>=',$startDatetime);
                                        })
                                        ->count();

        if ($getCount > 0) {

            $startDate = date('d M', strtotime($startDatetime));
            $endDate = Date('d M'); 

            $dateBetween = $startDate.' - '.$endDate; 

            $message = "You are about to override previous data between ".$dateBetween.". Do you want to continue ?";
            return response()->json(['status'=>422,'message'=>$message]);
                
        }else{

            return response()->json(['status'=>200,'message'=>'']);
        }                                
    }

    public function getChunkFastGraph(Request $request){

        $fastingData = \App\Models\FastingClockModel::where('id',$request->fastingId)->firstOrFail();
        $type = $request->fastingType;

        if ($type == 'Fasting') {
            
            return view('Result.fasting.history-graph.fasting-chunk',compact('fastingData','type'));

        }elseif($type == 'Eating'){

            return view('Result.fasting.history-graph.eating-chunk',compact('fastingData','type'));
        }
    }

    /**
     * This function is used to save chunk data
     * @author Chirag Ghevariya
     */
    public function saveChunkFastGraph(Request $request){

        setDefaultTimezone();

        $input = $request->all();
                
        if (!isset($input['fasting_start_date']) || empty($input['fasting_start_date']) || 
            !isset($input['fasting_start_time']) || empty($input['fasting_start_time']) || 
            !isset($input['fasting_end_date']) || empty($input['fasting_end_date']) || 
            !isset($input['fasting_end_time']) || empty($input['fasting_end_time']) || 
            !isset($input['eating_start_date']) || empty($input['eating_start_date']) || 
            !isset($input['eating_start_time']) || empty($input['eating_start_time']) || 
            !isset($input['eating_end_date']) || empty($input['eating_end_date']) || 
            !isset($input['eating_end_time']) || empty($input['eating_end_time'])
        ) {
            
            return response()->json(['status'=>422,'message'=>'Please fill all input field.']);  
        }

        $fastingStartDateTime = $input['fasting_start_date'].' '.$input['fasting_start_time'].':00';
        $fastingEndDateTime = $input['fasting_end_date'].' '.$input['fasting_end_time'].':00';

        $eatingStartDateTime = $input['eating_start_date'].' '.$input['eating_start_time'].':00';
        $eatingEndDateTime = $input['eating_end_date'].' '.$input['eating_end_time'].':00';

        if ($fastingEndDateTime != $eatingStartDateTime) {
            
            return response()->json(['status'=>422,'message'=>'Fasting end date time and Eating start date time must be same.']);exit;
        }

        if (strtotime($fastingEndDateTime) <= strtotime($fastingStartDateTime)) {
            
            return response()->json(['status'=>422,'message'=>'Fasting end date time must be greater then fasting start date time']);exit;
        }

        if (strtotime($eatingEndDateTime) <= strtotime($eatingStartDateTime)) {
            
            return response()->json(['status'=>422,'message'=>'Eating end date time must be greater then eating start date time']);exit;
        }

        $record = \App\Models\FastingClockModel::where('client_id',\Auth::User()->account_id)
                                        ->where('id',$input['fasting_id'])
                                        ->firstOrFail();

        $runningCycle =  \App\Models\FastingClockModel::where('client_id',\Auth::User()->account_id)
                                            ->orderBy('id','DESC')
                                            ->first();

        
        if(isset($runningCycle) && ($runningCycle->end_fast == null || $runningCycle->end_eat == null)){

            $currentDatetime = strtotime(date('Y-m-d H:i:s'));

            if (strtotime($eatingEndDateTime) >= $currentDatetime) {
                
                return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then current date time.']);exit;
            }

            if ($runningCycle->end_fast == null && $runningCycle->start_eat == null && $runningCycle->end_eat == null) {
                
                if (strtotime($eatingEndDateTime) >= strtotime($runningCycle->start_fast)) {
                    
                    return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then to your existing running fasting cycle']);exit;
                }

            }elseif($runningCycle->end_fast != null && $runningCycle->start_eat != null && $runningCycle->end_eat == null){

                if (strtotime($eatingEndDateTime) >= strtotime($runningCycle->start_eat)) {
                    
                    return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then to your existing running eating cycle']);exit;
                }

            }

        }


        // case:- All are same no changes
        if ($record->start_fast  == $fastingStartDateTime && 
            $record->end_fast  == $fastingEndDateTime && 
            $record->start_eat  == $eatingStartDateTime && 
            $record->end_eat  == $eatingEndDateTime  
        ) {
            
            return response()->json(['status'=>422,'message'=>'You did not made any changes.']);exit;

        }

        // case:- Start fast datetime and End eat datetime are same
        if ($record->start_fast  == $fastingStartDateTime && $record->end_eat  == $eatingEndDateTime  
        ) {
            
            $record->end_fast =  $fastingEndDateTime;
            $record->start_eat =  $fastingEndDateTime;
            $record->save();

            return response()->json(['status'=>200,'message'=>'Chunk successfully updated.']);exit;

        }
        
        $start = $fastingStartDateTime;
        $end = $eatingEndDateTime;

        $endFast = $fastingEndDateTime;
        $startEat = $eatingStartDateTime;

        if (strtotime($eatingEndDateTime) < strtotime($record->end_eat) &&
            strtotime($fastingStartDateTime) > strtotime($record->start_fast)
            ) {
            
            $sDate = $record->start_fast;
            $eDate = $record->end_eat;

        }elseif(strtotime($eatingEndDateTime) < strtotime($record->end_eat)) {
            
            $sDate = $fastingStartDateTime;
            $eDate = $record->end_eat;

        }elseif(strtotime($fastingStartDateTime) > strtotime($record->start_fast)) {
            
            $sDate = $record->start_fast;
            $eDate = $eatingEndDateTime;

        }else{

            $sDate = $fastingStartDateTime;
            $eDate = $eatingEndDateTime;
        }
        
        // dd($sDate,$eDate);

        $getData = \App\Models\FastingClockModel::where('id','!=',$record->id)
                                    ->where('client_id',\Auth::User()->account_id)
                                    ->where(function($query) use($sDate,$eDate){

                                        $query->whereBetween('start_fast',[$sDate,$eDate])
                                            ->orWhereBetween('end_fast',[$sDate,$eDate])
                                            ->orWhereBetween('start_eat',[$sDate,$eDate])
                                            ->orWhereBetween('end_eat',[$sDate,$eDate]);
                                    })
                                    ->orderBy('start_fast','ASC')
                                    // ->pluck('id')
                                    // ->toArray();
                                    ->get();

        // dd($record->id,$getData);

        if (isset($getData) && !$getData->isEmpty()) {
                
            foreach($getData as $key=>$v){

                if ($v->start_fast != null && $v->end_fast != null && $v->start_eat != null && $v->end_eat != null) {
                    

                    if (strtotime($v->start_fast) >= strtotime($start) && 
                        strtotime($v->start_fast) <= strtotime($end) &&
                        strtotime($v->end_fast) >= strtotime($start) && 
                        strtotime($v->end_fast) <= strtotime($end) &&
                        strtotime($v->start_eat) >= strtotime($start) && 
                        strtotime($v->start_eat) <= strtotime($end) &&
                        strtotime($v->end_eat) >= strtotime($start) && 
                        strtotime($v->end_eat) <= strtotime($end) 
                        ) {
                        
                        $v->delete();

                    }elseif(
                        (strtotime($start) >= strtotime($v->start_fast)   && 
                        strtotime($start) <= strtotime($v->end_fast) ) ||
                        (strtotime($start) >= strtotime($v->start_eat)   && 
                        strtotime($start) <= strtotime($v->end_eat) )
                        ){

                            
                            if (strtotime($start) >= strtotime($v->start_fast)   && 
                                strtotime($start) <= strtotime($v->end_fast)) {
                                

                                $v->end_fast = $start;
                                $v->start_eat = null;
                                $v->end_eat = null;
                                $v->save();


                            }elseif (strtotime($start) >= strtotime($v->start_eat)   && 
                                    strtotime($start) <= strtotime($v->end_eat)) {
                                

                                $v->end_eat = $start;
                                $v->save();

                            }


                    }elseif (
                        (strtotime($end) >= strtotime($v->start_fast)   && 
                        strtotime($end) <= strtotime($v->end_fast) ) ||
                        (strtotime($end) >= strtotime($v->start_eat)   && 
                        strtotime($end) <= strtotime($v->end_eat) )
                        ) {
                            
                            
                            if (strtotime($end) >= strtotime($v->start_fast)   && 
                                strtotime($end) <= strtotime($v->end_fast)) {
                                
                                $v->start_fast = $end;
                                $v->save();

                            }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                                    strtotime($end) <= strtotime($v->end_eat)) {
                                    
                                    if (strtotime($start) <= strtotime($v->start_fast)   && 
                                        strtotime($start) <= strtotime($v->end_fast)) {
                                        
                                        $v->end_fast = null;    
                                    }
                                    
                                    $v->start_eat = $end;
                                    $v->save();

                            }

                    }elseif(strtotime($end) < strtotime($v->start_fast)   && 
                        strtotime($end) < strtotime($v->end_fast)  &&
                        strtotime($end) < strtotime($v->start_eat)   && 
                        strtotime($end) < strtotime($v->end_eat)
                    ){

                        
                        if ($record->end_eat == $v->start_fast) {
                            
                            $v->start_fast = $end;     
                            $v->save();
                        }

                    }elseif (strtotime($start) > strtotime($v->end_eat)) {
                        
                        $v->end_eat = $start;     
                        $v->save();
                    }


                }elseif ($v->start_eat == null && $v->end_eat == null && $v->end_fast !=null) {
                    
                    if (strtotime($v->start_fast) >= strtotime($start) && 
                        strtotime($v->start_fast) <= strtotime($end) &&
                        strtotime($v->end_fast) >= strtotime($start) && 
                        strtotime($v->end_fast) <= strtotime($end)
                        ) {
                        
                        $v->delete();

                    }elseif(strtotime($start) >= strtotime($v->start_fast)   && 
                            strtotime($start) <= strtotime($v->end_fast) 
                        ){

                            $v->end_fast = $start;
                            $v->save();

                    }elseif(strtotime($end) >= strtotime($v->start_fast)   && 
                            strtotime($end) <= strtotime($v->end_fast)
                        ) {
                        
                            // $checkfastExit = \App\Models\FastingClockModel::where('client_id',\Auth::user()->account_id)->where('start_fast',$v->end_fast)->first();


                            // if ($checkfastExit !=null) {
                                
                            //     $checkfastExit->start_fast = $end;    
                            // }

                            $v->start_fast = $end;
                            $v->save();
                    
                    }elseif (strtotime($end) > strtotime($v->start_fast)   && 
                            strtotime($end) > strtotime($v->end_fast)) {
                            
                            $v->delete();

                    }elseif (strtotime($start) < strtotime($v->start_fast)   && 
                            strtotime($start) > strtotime($v->end_fast)) {
                        
                            $v->delete();
                    }

                }else{


                    if (strtotime($v->start_fast) >= strtotime($start) && 
                        strtotime($v->start_fast) <= strtotime($end) &&
                        strtotime($v->end_fast) >= strtotime($start) && 
                        strtotime($v->end_fast) <= strtotime($end) &&
                        strtotime($v->start_eat) >= strtotime($start) && 
                        strtotime($v->start_eat) <= strtotime($end) &&
                        strtotime($v->end_eat) >= strtotime($start) && 
                        strtotime($v->end_eat) <= strtotime($end) 
                        ) {
                        
                        $v->delete();

                    }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                        strtotime($end) <= strtotime($v->end_eat)) {
                        
                        $v->start_eat  = $end;
                        $v->save();

                    }elseif(strtotime($v->start_eat) >= strtotime($start) && 
                        strtotime($v->start_eat) <= strtotime($end) &&
                        strtotime($v->end_eat) >= strtotime($start) && 
                        strtotime($v->end_eat) <= strtotime($end)
                    ){

                        $v->delete();

                    }elseif(strtotime($end) > strtotime($v->start_eat) &&
                            strtotime($end) > strtotime($v->end_eat)
                        ){

                        $v->delete();
                    }

                }


            }
        }

        $record->start_fast = $start;
        $record->end_fast = $endFast;
        $record->start_eat = $startEat;
        $record->end_eat = $end;                    
        $record->save();
                
        return response()->json(['status'=>200,'message'=>'Data updated.']);exit;

    }

    public function getCustomFastGraph(Request $request){

        $fastingData = \App\Models\FastingClockModel::where('id',$request->fastingId)->firstOrFail();
        $type = $request->fastingType;

        return view('Result.fasting.history-graph.custom.custom-graph',compact('fastingData','type'));
    }

    /**
     * This function is used to save chunk data
     * @author Chirag Ghevariya
     */
    public function saveCustomFastGraph(Request $request){

        setDefaultTimezone();

        $input = $request->all();
        
        $record = \App\Models\FastingClockModel::where('id',$input['fasting_id'])
                                                    ->firstOrFail();

        if ($input['fasting_type'] == 'Fasting') {
            
            $fastingStartDateTime = $input['fasting_start_date'].' '.$input['fasting_start_time'].':00';
            $fastingEndDateTime = $input['fasting_end_date'].' '.$input['fasting_end_time'].':00';

            if (!isset($input['fasting_start_date']) || empty($input['fasting_start_date']) || 
                !isset($input['fasting_start_time']) || empty($input['fasting_start_time']) || 
                !isset($input['fasting_end_date']) || empty($input['fasting_end_date']) || 
                !isset($input['fasting_end_time']) || empty($input['fasting_end_time']) 
            ) {
                
                return response()->json(['status'=>422,'message'=>'Please fill all input field.']);  
            }

            if (strtotime($fastingEndDateTime) <= strtotime($fastingStartDateTime)) {
                
                return response()->json(['status'=>422,'message'=>'Fasting end date time must be greater then fasting start date time']);exit;
            }

            if ($record->start_fast  == $fastingStartDateTime && 
                $record->end_fast  == $fastingEndDateTime
            ) {
                
                return response()->json(['status'=>422,'message'=>'You did not made any changes.']);exit;

            }
            

            $runningCycle =  \App\Models\FastingClockModel::where('client_id',\Auth::User()->account_id)
                                            ->orderBy('id','DESC')
                                            ->first();

        
            if(isset($runningCycle) && ($runningCycle->end_fast == null || $runningCycle->end_eat == null)){

                $currentDatetime = strtotime(date('Y-m-d H:i:s'));

                if (strtotime($fastingEndDateTime) >= $currentDatetime) {
                    
                    return response()->json(['status'=>422,'message'=>'Fasting end date time can`t be greater then current date time.']);exit;
                }

                if ($runningCycle->end_fast == null && $runningCycle->start_eat == null && $runningCycle->end_eat == null) {
                    
                    if (strtotime($fastingEndDateTime) >= strtotime($runningCycle->start_fast)) {
                        
                        return response()->json(['status'=>422,'message'=>'Fasting end date time can`t be greater then to your existing running fasting cycle']);exit;
                    }

                }elseif($runningCycle->end_fast != null && $runningCycle->start_eat != null && $runningCycle->end_eat == null){

                    if (strtotime($fastingEndDateTime) >= strtotime($runningCycle->start_eat)) {
                        
                        return response()->json(['status'=>422,'message'=>'Fasting end date time can`t be greater then to your existing running eating cycle']);exit;
                    }

                }

            }

            $start = $fastingStartDateTime;
            $end = $fastingEndDateTime;

            if (strtotime($fastingStartDateTime) > strtotime($record->start_fast) &&
                strtotime($fastingEndDateTime) < strtotime($record->end_fast)
                ) {
                
                $sDate = $record->start_fast;
                $eDate = $record->end_fast;

            }elseif (strtotime($fastingStartDateTime) > strtotime($record->start_fast)) {
                
                $sDate = $record->start_fast;
                $eDate = $fastingEndDateTime;

            }elseif (strtotime($fastingEndDateTime) < strtotime($record->end_fast)) {
                
                $sDate = $fastingStartDateTime;
                $eDate = $record->end_fast;

            }else{

                $sDate = $fastingStartDateTime;
                $eDate = $fastingEndDateTime;
            }
            // dd($sDate,$eDate);
            $getData = \App\Models\FastingClockModel::where('id','!=',$record->id)
                                        ->where('client_id',\Auth::User()->account_id)
                                        ->where(function($query) use($sDate,$eDate){

                                            $query->whereBetween('start_fast',[$sDate,$eDate])
                                                ->orWhereBetween('end_fast',[$sDate,$eDate])
                                                ->orWhereBetween('start_eat',[$sDate,$eDate])
                                                ->orWhereBetween('end_eat',[$sDate,$eDate]);
                                        })
                                        ->orderBy('start_fast','ASC')
                                        // ->pluck('id')
                                        // ->toArray();
                                        ->get();

            // dd($getData);

            if (isset($getData) && !$getData->isEmpty()) {
                    
                foreach($getData as $key=>$v){

                    if ($v->start_fast != null && $v->end_fast != null && $v->start_eat != null && $v->end_eat != null) {
                        

                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end) &&
                            strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end) 
                            ) {
                            
                            $v->delete();

                        }elseif(
                            (strtotime($start) >= strtotime($v->start_fast)   && 
                            strtotime($start) <= strtotime($v->end_fast) ) ||
                            (strtotime($start) >= strtotime($v->start_eat)   && 
                            strtotime($start) <= strtotime($v->end_eat) )
                            ){


                                if (strtotime($start) >= strtotime($v->start_fast)   && 
                                    strtotime($start) <= strtotime($v->end_fast)) {
                                    

                                    $v->end_fast = $start;
                                    $v->start_eat = null;
                                    $v->end_eat = null;
                                    $v->save();


                                }elseif (strtotime($start) >= strtotime($v->start_eat)   && 
                                        strtotime($start) <= strtotime($v->end_eat)) {
                                    

                                    $v->end_eat = $start;
                                    $v->save();

                                }


                        }elseif (
                            (strtotime($end) >= strtotime($v->start_fast)   && 
                            strtotime($end) <= strtotime($v->end_fast) ) ||
                            (strtotime($end) >= strtotime($v->start_eat)   && 
                            strtotime($end) <= strtotime($v->end_eat) )
                            ) {
                            
                                if (strtotime($end) >= strtotime($v->start_fast)   && 
                                    strtotime($end) <= strtotime($v->end_fast)) {
                                    
                                    if ($v->end_fast == $v->start_eat) {
                                        
                                        $v->end_fast = $end;
                                        $v->start_eat = $end;
                                        $v->save();

                                    }else{

                                        $v->end_fast = $end;
                                        $v->save();
                                    }



                                }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                                        strtotime($end) <= strtotime($v->end_eat)) {
                                        
                                        if (strtotime($start) <= strtotime($v->start_fast)   && 
                                            strtotime($start) <= strtotime($v->end_fast)) {
                                            
                                            $v->end_fast = null;    
                                        }
                                        
                                        $v->start_eat = $end;
                                        $v->save();

                                }

                        }elseif(strtotime($end) < strtotime($v->start_fast)   && 
                        strtotime($end) < strtotime($v->end_fast)  &&
                        strtotime($end) < strtotime($v->start_eat)   && 
                        strtotime($end) < strtotime($v->end_eat)
                        ){

                            if ($record->end_eat == $v->start_fast) {
                                
                                $v->start_fast = $end;     
                                $v->save();
                            }  

                        }elseif (strtotime($start) > strtotime($v->end_eat)) {
                            
                            $v->end_eat = $start;     
                            $v->save();
                        }


                    }elseif ($v->start_eat == null && $v->end_eat == null && $v->end_fast !=null) {
                        
                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end)
                            ) {
                            
                            $v->delete();

                        }elseif(strtotime($v->start_fast) > strtotime($end)){

                            // $v->delete();

                        }elseif(strtotime($start) >= strtotime($v->start_fast)   && 
                                strtotime($start) <= strtotime($v->end_fast) 
                            ){

                                $v->end_fast = $start;
                                $v->save();

                        }elseif(strtotime($end) >= strtotime($v->start_fast)   && 
                                strtotime($end) <= strtotime($v->end_fast)
                            ) {
                            
                                // $checkfastExit = \App\Models\FastingClockModel::where('client_id',\Auth::user()->account_id)->where('start_fast',$v->end_fast)->first();


                                // if ($checkfastExit !=null) {
                                    
                                //     $checkfastExit->start_fast = $end;    
                                // }

                                $v->start_fast = $end;
                                $v->save();
                        
                        }elseif (strtotime($end) > strtotime($v->start_fast)   && 
                            strtotime($end) > strtotime($v->end_fast)) {
                            
                                $v->delete();
                        }elseif (strtotime($start) < strtotime($v->start_fast)   && 
                            strtotime($start) > strtotime($v->end_fast)) {
                        
                                $v->delete();
                        }

                    }else{


                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end) &&
                            strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end) 
                            ) {
                            
                            $v->delete();

                        }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                            strtotime($end) <= strtotime($v->end_eat)) {
                            
                            $v->start_eat  = $end;
                            $v->save();

                        }elseif(strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end)
                        ){

                            $v->delete();

                        }elseif(strtotime($end) > strtotime($v->start_eat) && 
                            strtotime($end) > strtotime($v->end_eat)
                            ){
                                
                            $v->delete();
                        }

                    }


                }
            }

            if ($record->start_eat !=null && $record->end_eat !=null) {

                if (strtotime($end) >= strtotime($record->start_eat) && strtotime($end) <= strtotime($record->end_eat)) {
                    
                    $record->start_eat = $end;    

                }elseif(strtotime($end) >= strtotime($record->start_fast) && strtotime($end) <= strtotime($record->end_fast)){

                    $record->start_eat = $end;

                }elseif(strtotime($end) >= strtotime($record->end_eat)){

                    $record->start_eat = null;
                    $record->end_eat = null;
                }   

                $record->start_fast = $start;
                $record->end_fast = $end;
                $record->save();

            }else{

                $record->start_fast = $start;
                $record->end_fast = $end;                    
                $record->save();
            }
                
            return response()->json(['status'=>200,'message'=>'Data updated.']);exit;

        }else{

            $eatingStartDateTime = $input['eating_start_date'].' '.$input['eating_start_time'].':00';
            $eatingEndDateTime = $input['eating_end_date'].' '.$input['eating_end_time'].':00';

            if(!isset($input['eating_start_date']) || empty($input['eating_start_date']) || 
                !isset($input['eating_start_time']) || empty($input['eating_start_time']) || 
                !isset($input['eating_end_date']) || empty($input['eating_end_date']) || 
                !isset($input['eating_end_time']) || empty($input['eating_end_time'])
            ) {
                
                return response()->json(['status'=>422,'message'=>'Please fill all input field.']);  
            }

            if (strtotime($eatingEndDateTime) <= strtotime($eatingStartDateTime)) {
                
                return response()->json(['status'=>422,'message'=>'Eating end date time must be greater then eating start date time']);exit;
            }

            if ($record->start_eat  == $eatingStartDateTime && 
                $record->end_eat  == $eatingEndDateTime
            ) {
                
                return response()->json(['status'=>422,'message'=>'You did not made any changes.']);exit;

            }


            $runningCycle =  \App\Models\FastingClockModel::where('client_id',\Auth::User()->account_id)
                                            ->orderBy('id','DESC')
                                            ->first();

        
            if(isset($runningCycle) && ($runningCycle->end_fast == null || $runningCycle->end_eat == null)){

                $currentDatetime = strtotime(date('Y-m-d H:i:s'));

                if (strtotime($eatingEndDateTime) >= $currentDatetime) {
                    
                    return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then current date time.']);exit;
                }

                if ($runningCycle->end_fast == null && $runningCycle->start_eat == null && $runningCycle->end_eat == null) {
                    
                    if (strtotime($eatingEndDateTime) >= strtotime($runningCycle->start_fast)) {
                        
                        return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then to your existing running fasting cycle']);exit;
                    }

                }elseif($runningCycle->end_fast != null && $runningCycle->start_eat != null && $runningCycle->end_eat == null){

                    if (strtotime($eatingEndDateTime) >= strtotime($runningCycle->start_eat)) {
                        
                        return response()->json(['status'=>422,'message'=>'Eating end date time can`t be greater then to your existing running eating cycle']);exit;
                    }

                }

            }
            
            $start = $eatingStartDateTime;
            $end = $eatingEndDateTime;

            if (strtotime($eatingEndDateTime) < strtotime($record->end_eat) &&
                strtotime($eatingStartDateTime) > strtotime($record->start_eat)
                ) {
                
                $sDate = $record->start_eat;
                $eDate = $record->end_eat;

            }elseif(strtotime($eatingStartDateTime) > strtotime($record->start_eat)){
                
                $sDate = $record->start_eat;
                $eDate = $eatingEndDateTime;

            }elseif (strtotime($eatingEndDateTime) < strtotime($record->end_eat)) {
                
                $sDate = $eatingStartDateTime;
                $eDate = $record->end_eat;

            }else{

                $sDate = $eatingStartDateTime;
                $eDate = $eatingEndDateTime;
            }

            $getData = \App\Models\FastingClockModel::where('id','!=',$record->id)
                                        ->where('client_id',\Auth::User()->account_id)
                                        ->where(function($query) use($sDate,$eDate){

                                            $query->whereBetween('start_fast',[$sDate,$eDate])
                                                ->orWhereBetween('end_fast',[$sDate,$eDate])
                                                ->orWhereBetween('start_eat',[$sDate,$eDate])
                                                ->orWhereBetween('end_eat',[$sDate,$eDate]);
                                        })
                                        ->orderBy('start_fast','ASC')
                                        // ->pluck('id')
                                        // ->toArray();
                                        ->get();

            // dd($getData);

            if (isset($getData) && !$getData->isEmpty()) {
                    
                foreach($getData as $key=>$v){

                    if ($v->start_fast != null && $v->end_fast != null && $v->start_eat != null && $v->end_eat != null) {
                        

                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end) &&
                            strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end) 
                            ) {
                            
                            $v->delete();

                        }elseif(
                            (strtotime($start) >= strtotime($v->start_fast)   && 
                            strtotime($start) <= strtotime($v->end_fast) ) ||
                            (strtotime($start) >= strtotime($v->start_eat)   && 
                            strtotime($start) <= strtotime($v->end_eat) )
                            ){


                                if (strtotime($start) >= strtotime($v->start_fast)   && 
                                    strtotime($start) <= strtotime($v->end_fast)) {
                                    

                                    $v->end_fast = $start;
                                    $v->start_eat = null;
                                    $v->end_eat = null;
                                    $v->save();


                                }elseif (strtotime($start) >= strtotime($v->start_eat)   && 
                                        strtotime($start) <= strtotime($v->end_eat)) {
                                    

                                    $v->end_eat = $start;
                                    $v->save();

                                }


                        }elseif (
                            (strtotime($end) >= strtotime($v->start_fast)   && 
                            strtotime($end) <= strtotime($v->end_fast) ) ||
                            (strtotime($end) >= strtotime($v->start_eat)   && 
                            strtotime($end) <= strtotime($v->end_eat) )
                            ) {
                            
                                if (strtotime($end) >= strtotime($v->start_fast)   && 
                                    strtotime($end) <= strtotime($v->end_fast)) {
                                    
                                    

                                        $v->start_fast = $end;
                                        $v->save();
                                    // }



                                }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                                        strtotime($end) <= strtotime($v->end_eat)) {
                                        
                                        if (strtotime($start) <= strtotime($v->start_fast)   && 
                                            strtotime($start) <= strtotime($v->end_fast)) {
                                            
                                            $v->end_fast = null;    
                                        }
                                        
                                        $v->start_eat = $start;
                                        $v->save();

                                }

                        }elseif(strtotime($end) < strtotime($v->start_fast)   && 
                        strtotime($end) < strtotime($v->end_fast)  &&
                        strtotime($end) < strtotime($v->start_eat)   && 
                        strtotime($end) < strtotime($v->end_eat)
                        ){

                            if ($record->end_eat == $v->start_fast) {
                            
                                $v->start_fast = $end;     
                                $v->save();
                            }     
                        }elseif (strtotime($start) > strtotime($v->end_eat)) {
                            
                            $v->end_eat = $start;     
                            $v->save();
                        }


                    }elseif ($v->start_eat == null && $v->end_eat == null && $v->end_fast !=null) {
                        
                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end)
                            ) {
                            
                            $v->delete();

                        }elseif(strtotime($start) >= strtotime($v->start_fast)   && 
                                strtotime($start) <= strtotime($v->end_fast) 
                            ){

                                $v->end_fast = $start;
                                $v->save();

                        }elseif(strtotime($end) >= strtotime($v->start_fast)   && 
                                strtotime($end) <= strtotime($v->end_fast)
                            ) {
                                
                                // $checkfastExit = \App\Models\FastingClockModel::where('client_id',\Auth::user()->account_id)->where('start_fast',$v->end_fast)->first();


                                // if ($checkfastExit !=null) {
                                    
                                //     $checkfastExit->start_fast = $end;    
                                // }

                                $v->start_fast = $end;
                                $v->save();
                        
                        }elseif (strtotime($start) >= strtotime($v->end_fast) ||  
                            strtotime($start) == strtotime($v->end_fast)) {
                                
                                $v->end_fast = $start;
                                $v->save();

                        }elseif (strtotime($start) < strtotime($v->start_fast)   && 
                            strtotime($start) > strtotime($v->end_fast)) {

                                $v->end_fast = $start;
                                $v->save();
                        }


                    }else{


                        if (strtotime($v->start_fast) >= strtotime($start) && 
                            strtotime($v->start_fast) <= strtotime($end) &&
                            strtotime($v->end_fast) >= strtotime($start) && 
                            strtotime($v->end_fast) <= strtotime($end) &&
                            strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end) 
                            ) {
                            
                            $v->delete();

                        }elseif (strtotime($end) >= strtotime($v->start_eat)   && 
                            strtotime($end) <= strtotime($v->end_eat)) {
                            
                            $v->start_eat  = $end;
                            $v->save();

                        }elseif(strtotime($v->start_eat) >= strtotime($start) && 
                            strtotime($v->start_eat) <= strtotime($end) &&
                            strtotime($v->end_eat) >= strtotime($start) && 
                            strtotime($v->end_eat) <= strtotime($end)
                        ){

                            $v->delete();

                        }elseif(strtotime($end) > strtotime($v->start_eat) &&
                            strtotime($end) > strtotime($v->end_eat)
                            ){
                                
                            $v->delete();
                        }

                    }


                }
            }


            // $record->start_eat = $start;
            // $record->end_eat = $end;

            if (strtotime($start) <= strtotime($record->start_fast)) {
                
                $record->end_fast = null;
                $record->start_eat = $start;
                $record->end_eat = $end;

            }elseif(strtotime($start) >= strtotime($record->start_fast) && strtotime($start) <= strtotime($record->end_fast) && strtotime($end) >= strtotime($record->start_fast) && strtotime($end) <= strtotime($record->end_fast)){

                $record->end_fast = $start;
                $record->start_eat = $start;
                $record->end_eat = $end;


            }elseif (strtotime($start) >= strtotime($record->start_fast) && strtotime($start) <= strtotime($record->end_fast)) {
                
                $record->end_fast = $start;
                $record->start_eat = $start;
                $record->end_eat = $end;

            }elseif (strtotime($start) >= strtotime($record->end_fast)) {

                $record->end_fast = $start;
                $record->start_eat = $start;
                $record->end_eat = $end;  

            }else{
                
                $record->start_eat = $start;
                $record->end_eat = $end;
            }   
            // dd("exir");
            $record->save();
                
            return response()->json(['status'=>200,'message'=>'Data updated.']);exit;





        }  
        
    }
}
