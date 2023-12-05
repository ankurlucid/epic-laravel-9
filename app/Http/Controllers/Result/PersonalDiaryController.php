<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{PersonalDiary,PersonalMeasurement};
use Carbon\Carbon;
use Auth;

class PersonalDiaryController extends Controller
{
    public function personalDairy(Request $request)
    {
        $clientId = Auth::User()->account_id;
        if($request->date){
            $eventDate =$request->date;
        } else{
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
        $personalDiary = [];
        $personalDiaryData = PersonalDiary::where('client_id',$clientId)
                    ->where('event_date',$eventDate)
                    ->orderBy('id', 'DESC')
                    ->first();
        if($personalDiaryData){
            $personalDiary = $personalDiaryData->toArray();
        }
        return view('Result.dailydiary.personal-dairy',compact('personalDiary','eventDate'));
    }

    public function storeData(Request $request){
        $requestData = $request->all();
        $clientId = Auth::User()->account_id;
        // $date = Carbon::now();
        // $eventDate = $date->toDateString();
        $eventDate = $requestData['event_date'];
        $response = [];
      if(isset($requestData['diaryData'])){
          $personalDiary = PersonalDiary::updateOrCreate([
                            'client_id' => $clientId,
                            'event_date' => $eventDate,
                            'content' => $requestData['diaryData']['content'],
                            'stress_rate' => $requestData['diaryData']['stress_rate'],
                            'humidity' => $requestData['diaryData']['humidity'],
                            'temperature' => $requestData['diaryData']['temp']
               ]);
        if($personalDiary){
            $response = [
                'status' => 'ok',
                'data' => $personalDiary,
            ];
        }
     }
     return response()->json($response);
   }
}


