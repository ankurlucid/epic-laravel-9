<?php

namespace App\Http\Controllers\Result;

use App\Benchmarks;
use App\Http\Controllers\Controller;

use App\HydrationJournal;

use App\Parq;
use App\PersonalMeasurement;use Auth;use Carbon\Carbon;
use Illuminate\Http\Request;

class HydrationController extends Controller
{
    public function hydration(Request $request)
    {
        $clientId = Auth::User()->account_id;
        if ($request->date) {
            $eventDate = $request->date;
        } else {
            $date = Carbon::now();
            $eventDate = $date->toDateString();
            // $eventDate =  '2022-02-01';
        }
        
        $hydrationJournalData = [];
        $weightUnit = null;
        $weight = 0;
        $hydrationJournal = HydrationJournal::where('client_id', $clientId)
                 ->where('event_date', $eventDate)
                 ->get();
               
        $personalMeasurement = PersonalMeasurement::where('client_id', $clientId)
            ->orderBy('event_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->select('weight', 'weightUnit')
            ->first();
        if ($personalMeasurement && $personalMeasurement['weight'] > 0) {
            $weight = $personalMeasurement['weight'];
            $weightUnit = $personalMeasurement['weightUnit'];
        } else {
            $benchmarks = Benchmarks::where('client_id', $clientId)->orderBy('id', 'DESC')->select('weight')->first();
            if ($benchmarks && $benchmarks->weight > 0) {
                $weight = $benchmarks['weight'];
            } else {
                $parq_weight = Parq::where('client_id', $clientId)->orderBy('id', 'DESC')->select('weight', 'weightUnit')->first();
                if ($parq_weight && $parq_weight->weight > 0) {
                    $weight = $parq_weight['weight'];
                    $weightUnit = $parq_weight['weightUnit'];
                }
            }
        }

        if ($weightUnit == 'Imperial') {
            $weightConvert = $weight / 2.2046226218;
            $requiredVolume = $weightConvert * 0.04;
        } else {
            $requiredVolume = $weight * 0.04;
        }
        $hydrationJournalData['required_amount'] = sprintf('%1.1f', $requiredVolume);
        $hydrationJournalData['consumed'] = 0;
        $hydrationJournalData['liquidType'] = 0;
        $hydrationJournalData['consumedHistory'] = [];
        if (count($hydrationJournal)) {
            $consumed = $hydrationJournal->sum('drank');
            $hydrationJournalData['consumed'] = $consumed;
            foreach ($hydrationJournal as $item) {
                if ($item->drink_type == 1) {
                    $item->drink_type = 'Water';
                }
                if ($item->drink_type == 2) {
                    $item->drink_type = 'Coffee';
                }
                if ($item->drink_type == 3) {
                    $item->drink_type = 'Tea';
                }
                if ($item->drink_type == 4) {
                    $item->drink_type = 'Juice';
                }
                if ($item->drink_type == 5) {
                    $item->drink_type = 'Soda';
                }
                if ($item->drink_type == 6) {
                    $item->drink_type = 'Milk';
                }
                if ($item->drink_type == 7) {
                    $item->drink_type = 'Alcohal';
                }
                if ($item->drink_type == 8) {
                    $item->drink_type = 'Sports Drinks';
                }
                $hydrationJournalData['consumedHistory'][] = [
                    'volume' => $item->drank,
                    'time' => $item->time,
                    'liquidType' => $item->drink_type,
                    'id' => $item->id,
                ];
            }
        }
    
        return view('Result.dailydiary.hydration', compact('hydrationJournalData','eventDate','weight','weightUnit'));
    }

    public function hydrationHistory(Request $request)
    {
        $clientId = Auth::User()->account_id;
        if ($request->date) {
            $eventDate = $request->date;
        } else {
            $date = Carbon::now();
            $eventDate = $date->toDateString();
            // $eventDate =  '2022-02-01';
        }
        $consumedHistory = [];
        $hydrationJournal = HydrationJournal::where('client_id', $clientId)
            ->where('event_date', $eventDate)
            ->get();
        if (count($hydrationJournal)) {
            foreach ($hydrationJournal as $item) {
                if ($item->drink_type == 1) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Water';
                }
                if ($item->drink_type == 2) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Coffee';
                }
                if ($item->drink_type == 3) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Tea';
                }
                if ($item->drink_type == 4) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Juice';
                }
                if ($item->drink_type == 5) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Soda';
                }
                if ($item->drink_type == 6) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Milk';
                }
                if ($item->drink_type == 7) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Alcohal';
                }
                if ($item->drink_type == 8) {
                    $drinkId = $item->drink_type;
                    $item->drink_type = 'Sports Drinks';
                }
                    $consumedHistory[] = [
                    'volume' => $item->drank,
                    'time' => $item->time,
                    'liquidType' => $item->drink_type,
                    'id' => $item->id,
                    'text'=>$item->add_text,
                    'drinkType'=> $drinkId
                ];
            }
        }
        return view('Result.dailydiary.hydration_history', compact('consumedHistory','eventDate'));
    }

    public function saveHydrationData(Request $request){
        $requestData = $request->all();
        $clientId = Auth::User()->account_id;
        try{
            HydrationJournal::create([
                'client_id' => $clientId,
                'event_date' => $requestData['event_date'],
                'drink_type' => $requestData['liquidType'],
                'time' => $requestData['time'],
                'drank' => $requestData['drank'],
                'add_text' => $requestData['hydrationText']
            ]);
            $response = [
                'status' => 'ok',
                'message' => 'Data saved successfully'
            ];
        }catch(\ Throwable $e){
            $response = [
                'status' => 'ok',
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
