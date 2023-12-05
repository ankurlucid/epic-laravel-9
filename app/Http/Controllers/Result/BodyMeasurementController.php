<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{PersonalDiary,PersonalMeasurement};
use Carbon\Carbon;
use Auth;
use View;
use App\Clients;

class BodyMeasurementController extends Controller
{
    public function personalMeasurement(Request $request)
    {
        $clientId = Auth::User()->account_id;
        $clickDate = $request->date;
        if ($clickDate) {
            $eventDate = $clickDate;
        } else {
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
        $measurementData = [];

        $measurement = PersonalMeasurement::where('client_id', $clientId)
            ->whereDate('event_date', '<=', $eventDate)
            ->orderBy('event_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->first();
        if ($measurement) {
            $measurementData = $measurement->toArray();
        }
        return view('Result.dailydiary.personal-measurement', compact('measurementData', 'eventDate'));
    }

    public function updateMeasurementData(Request $request)
    {
        $requestData = $request->all();
        $clientId = Auth::User()->account_id;
        // $personalMeasurements = PersonalMeasurement::where('client_id', $clientId)->orderBy('id', 'DESC')->first();
        $personalMeasurements = PersonalMeasurement::where('client_id', $clientId)
                             ->where('id', $requestData['id'])
                             ->where('event_date', $requestData['eventDate'])
                             ->first();
        // $createMeasureData = false;
        // if ($personalMeasurements) {
        //     if ($personalMeasurements->event_date != $requestData['eventDate'] || $personalMeasurements->height != $requestData['height'] || $personalMeasurements->chest != $requestData['chest'] || $personalMeasurements->neck != $requestData['neck'] || $personalMeasurements->bicep_r != $requestData['bicep_r'] || $personalMeasurements->bicep_l != $requestData['bicep_l'] || $personalMeasurements->forearm_r != $requestData['forearm_r'] || $personalMeasurements->forearm_l != $requestData['forearm_l'] || $personalMeasurements->waist != $requestData['waist'] || $personalMeasurements->hip != $requestData['hip'] || $personalMeasurements->thigh_r != $requestData['thigh_r'] || $personalMeasurements->thigh_l != $requestData['thigh_l'] || $personalMeasurements->calf_r != $requestData['calf_r'] || $personalMeasurements->calf_l != $requestData['calf_l'] || $personalMeasurements->weight != $requestData['weight'] || $personalMeasurements->weightUnit != $requestData['weightUnit'] || $personalMeasurements->heightUnit != $requestData['heightUnit']) {
        //         $createMeasureData = true;
        //     }
        // }
        // if (!$personalMeasurements || $createMeasureData) {
        //     $clientMeasurement = PersonalMeasurement::create([
      if ($personalMeasurements) {
                $clientMeasurement = $personalMeasurements->update([
                    $updated_field => $requestData[$updated_field],
                    'updated_date' => Carbon::now()->format('Y-m-d'),
                ]);
       } else {
            $clientMeasurement = PersonalMeasurement::create([
                'client_id' => $clientId,
                'event_date' => $requestData['eventDate'],
                'height' => sprintf('%1.3f', $requestData['height']),
                'chest' => sprintf('%1.3f', $requestData['chest']),
                'neck' => sprintf('%1.3f', $requestData['neck']),
                'bicep_r' => sprintf('%1.3f', $requestData['bicep_r']),
                'bicep_l' => sprintf('%1.3f', $requestData['bicep_l']),
                'forearm_r' => sprintf('%1.3f', $requestData['forearm_r']),
                'forearm_l' => sprintf('%1.3f', $requestData['forearm_l']),
                'waist' => sprintf('%1.3f', $requestData['waist']),
                'hip' => sprintf('%1.3f', $requestData['hip']),
                'thigh_r' => sprintf('%1.3f', $requestData['thigh_r']),
                'thigh_l' => sprintf('%1.3f', $requestData['thigh_l']),
                'calf_r' => sprintf('%1.3f', $requestData['calf_r']),
                'calf_l' => sprintf('%1.3f', $requestData['calf_l']),
                'weight' => sprintf('%1.3f', $requestData['weight']),
                'weightUnit' => $requestData['weightUnit'],
                'heightUnit' => $requestData['heightUnit'],
                'updated_date' => Carbon::now()->format('Y-m-d'),
            ]);
          }

            if ($clientMeasurement) {
                $response = [
                    'status' => 'ok',
                    'message' => 'Data saved successfully',
                ];
                return response()->json($response);
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong',
                ];
                return response()->json($response);
            }
        // } 
        // else {
        //     $response = [
        //         'status' => 'error',
        //         'message' => 'Something went wrong',
        //     ];
        //     return response()->json($response);
        // }
    }

    public function storeMeasurementData(Request $request)
    {
        $requestData = $request->all();
        $updated_field = $requestData[updated_field];
        $clientId = Auth::User()->account_id;
        $personalMeasurements = PersonalMeasurement::where('client_id',$clientId)
                                ->where('event_date',$requestData['eventDate'])
                                ->orderBy('id','DESC')
                                ->first();
        if($personalMeasurements){
            $clientMeasurement = $personalMeasurements->update([
                 $updated_field => $requestData[$updated_field],
                'updated_date' => Carbon::now()->format('Y-m-d'),
            ]);
        } else {
            // $clientMeasurement = PersonalMeasurement::UpdateOrCreate(
            //     [id=>$personalMeasurements['id']],
            $clientMeasurement = PersonalMeasurement::create([
                'client_id' => $clientId,
                'event_date' => $requestData['eventDate'],
                'height' => sprintf('%1.3f', $requestData['height']),
                'chest' => sprintf('%1.3f', $requestData['chest']),
                'neck' => sprintf('%1.3f', $requestData['neck']),
                'bicep_r' => sprintf('%1.3f', $requestData['bicep_r']),
                'bicep_l' => sprintf('%1.3f', $requestData['bicep_l']),
                'forearm_r' => sprintf('%1.3f', $requestData['forearm_r']),
                'forearm_l' => sprintf('%1.3f', $requestData['forearm_l']),
                'waist' => sprintf('%1.3f', $requestData['waist']),
                'hip' => sprintf('%1.3f', $requestData['hip']),
                'thigh_r' => sprintf('%1.3f', $requestData['thigh_r']),
                'thigh_l' => sprintf('%1.3f', $requestData['thigh_l']),
                'calf_r' => sprintf('%1.3f', $requestData['calf_r']),
                'calf_l' => sprintf('%1.3f', $requestData['calf_l']),
                'weight' => sprintf('%1.3f', $requestData['weight']),
                'weightUnit' => $requestData['weightUnit'],
                'heightUnit' => $requestData['heightUnit'],
                'updated_date' => Carbon::now()->format('Y-m-d'),
                 ]);
            }          
        
        if ($clientMeasurement) {
            $response = [
                'status' => 'ok',
                'message' => 'Data saved successfully',
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Something went wrong',
            ];
            return response()->json($response);
        }
    }

    public function bodyMeasurementGraph($bodypart)
    {
        $duration = 1;
        $personal_measurement = PersonalMeasurement::select('id', 'event_date')->orderBy('event_date', 'asc')->orderBy('id', 'asc')->where('client_id', Auth::User()->account_id);

        $stepSize = 1;
        $startOfTheMonth = date('Y-m-01');
        $endOfTheMonth = date('Y-m-t');
        $personal_measurement = $personal_measurement->whereBetween('event_date', [date('Y-m-01'), date('Y-m-d')])->get()->toArray();
        $previous_event_date = [];
        $event_id = [];
        $max;
        $min;
        $columnName;
    
        foreach ($personal_measurement as $val) {

            if (in_array($val['event_date'], $previous_event_date)) {
                array_pop($event_id);
                array_push($event_id, $val['id']);
            } else {
                $event_id[] = $val['id'];
            }
            $previous_event_date[] = $val['event_date'];
        }

        if ($bodypart == 'height') {
            $columnName = 'height';
            $get_last_data = PersonalMeasurement::select('event_date', 'height', 'heightUnit')->where('height', '>', 0)->whereIn('id', $event_id)->orderBy('event_date', 'desc')->limit(1)->first();
            $get_data = PersonalMeasurement::select('event_date', 'height', 'heightUnit')->where('height', '>', 0)->where('client_id', Auth::user()->account_id)->limit(1)->first();
            //  $get_last_data = PersonalMeasurement::select('event_date', 'height', 'heightUnit')->whereIn('id', $event_id)->orderBy('event_date', 'desc')->limit(1)->first();
            //  $get_data = PersonalMeasurement::select('event_date', 'height', 'heightUnit')->where('client_id', Auth::user()->account_id)->limit(1)->first();
            $personal_measurement = PersonalMeasurement::select('event_date', 'height', 'heightUnit')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'height','heightUnit as unit')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('height','!=','0')
                    ->orderBy('height','DESC') 
                    ->first();
            
            $min = PersonalMeasurement::select('event_date', 'height','heightUnit as unit')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('height','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('height','ASC')  
                    ->first();
             
            $data = [];
            if (isset($get_data)) {
                foreach ($personal_measurement as $value) {
                    if ($value['height'] > 0) {
                        if (isset($get_last_data) && $get_last_data->heightUnit == 'inches') {
                            if ($value['heightUnit'] == 'cm') {
                                $data[] = ['date' => $value['event_date'], 'value' => (number_format((float) ($value['height'] * 0.393701), 2, '.', ''))];
                            } else {
                                $data[] = ['date' => $value['event_date'], 'value' => $value['height']];
                            }
                        } else {
                            if ($value['heightUnit'] == 'inches') {
                                $data[] = ['date' => $value['event_date'], 'value' => (number_format((float) ($value['height'] / 0.393701), 2, '.', ''))];
                            } else {
                                $data[] = ['date' => $value['event_date'], 'value' => $value['height']];
                            }
                        }

                    }

                }
                $height_unit = isset($get_last_data) ? ($get_last_data['heightUnit'] == 'inches' ? 'inches' : 'cm') : 'cm';
            } else {
                $clients = Clients::with(['parq' => function ($q) {
                    $q->select('client_id', 'height', 'heightUnit');
                }])->find(Auth::User()->account_id);
                $get_last_data = $clients->parq;

                if (isset($get_last_data) && $get_last_data->heightUnit != 'Metric') {
                    if ($get_last_data->heightUnit == 'Metric') {
                        $data[] = ['date' => date("Y-m-d"), 'value' => (number_format((float) ($get_last_data->height * 0.393701), 2, '.', ''))];
                    } else {
                        $data[] = ['date' => date("Y-m-d"), 'value' => $get_last_data->height];
                    }
                } else {
                    if ($get_last_data->heightUnit == 'inches') {
                        $data[] = ['date' => date("Y-m-d"), 'value' => (number_format((float) ($get_last_data->height / 0.393701), 2, '.', ''))];
                    } else {
                        $data[] = ['date' => date("Y-m-d"), 'value' => $get_last_data->height];
                    }
                }
                $height_unit = isset($get_last_data) ? ($get_last_data->heightUnit != 'Metric' ? 'inches' : 'cm') : 'cm';
            }

            $body_part = 'Height';
        }
        if ($bodypart == 'chest') {
            $columnName = 'chest';
            $personal_measurement = PersonalMeasurement::select('event_date', 'chest')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'chest')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('chest','!=','0')
                    ->orderBy('chest','DESC')
                    ->first();
            $min = PersonalMeasurement::select('event_date', 'chest')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('chest','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('chest','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['chest'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['chest']];
                }

            }
            $body_part = 'Chest';
        }
        if ($bodypart == 'neck') {
            $columnName = 'neck';
            $personal_measurement = PersonalMeasurement::select('event_date', 'neck')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'neck')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('neck','!=','0')
                    ->orderBy('neck','DESC')
                    ->first();
             
            $min = PersonalMeasurement::select('event_date', 'neck')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('neck','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('neck','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['neck'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['neck']];
                }

            }
            $body_part = 'Neck';
        }
        if ($bodypart == 'bicepR') {
            $columnName = 'bicep_r';
            $personal_measurement = PersonalMeasurement::select('event_date', 'bicep_r')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'bicep_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('bicep_r','!=','0')
                    ->orderBy('bicep_r','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'bicep_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('bicep_r','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('bicep_r','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['bicep_r'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['bicep_r']];
                }

            }
            $body_part = 'Bicep R';
        }
        if ($bodypart == 'bicepL') {
            $columnName = 'bicep_l';
            $personal_measurement = PersonalMeasurement::select('event_date', 'bicep_l')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'bicep_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('bicep_l','!=','0')
                    ->orderBy('bicep_l','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'bicep_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('bicep_l','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('bicep_l','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['bicep_l'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['bicep_l']];
                }

            }
            $body_part = 'Bicep L';
        }
        if ($bodypart == 'forearmR') {
            $columnName = 'forearm_r';
            $personal_measurement = PersonalMeasurement::select('event_date', 'forearm_r')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'forearm_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('forearm_r','!=','0')
                    ->orderBy('forearm_r','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'forearm_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('forearm_r','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('forearm_r','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['forearm_r'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['forearm_r']];
                }

            }
            $body_part = 'Forearm R';
        }
        if ($bodypart == 'forearmL') {
            $columnName = 'forearm_l';
            $personal_measurement = PersonalMeasurement::select('event_date', 'forearm_l')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'forearm_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('forearm_l','!=','0')
                    ->orderBy('forearm_l','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'forearm_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('forearm_l','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('forearm_l','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['forearm_l'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['forearm_l']];
                }

            }
            $body_part = 'Forearm L';
        }
        if ($bodypart == 'abdomen') {
            $columnName = 'waist';
            $personal_measurement = PersonalMeasurement::select('event_date', 'waist')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'waist')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('waist','!=','0')
                    ->orderBy('waist','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'waist')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('waist','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('waist','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['waist'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['waist']];
                }

            }
            $body_part = 'Waist';
        }
        if ($bodypart == 'hip') {
            $columnName = 'hip';
            $personal_measurement = PersonalMeasurement::select('event_date', 'hip')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'hip')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('hip','!=','0')
                    ->orderBy('hip','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'hip')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('hip','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('hip','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['hip'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['hip']];
                }

            }
            $body_part = 'Hip';
        }
        if ($bodypart == 'thighR') {
            $columnName = 'thigh_r';
            $personal_measurement = PersonalMeasurement::select('event_date', 'thigh_r')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'thigh_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('thigh_r','!=','0')
                    ->orderBy('thigh_r','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'thigh_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('thigh_r','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('thigh_r','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['thigh_r'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['thigh_r']];
                }

            }
            $body_part = 'Thigh R';
        }
        if ($bodypart == 'thighL') {
            $columnName = 'thigh_l';
            $personal_measurement = PersonalMeasurement::select('event_date', 'thigh_l')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'thigh_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('thigh_l','!=','0')
                    ->orderBy('thigh_l','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'thigh_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('thigh_l','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('thigh_l','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['thigh_l'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['thigh_l']];
                }

            }
            $body_part = 'Thigh L';
        }
        if ($bodypart == 'calfR') {
            $columnName = 'calf_r';
            $personal_measurement = PersonalMeasurement::select('event_date', 'calf_r')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'calf_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('calf_r','!=','0')
                    ->orderBy('calf_r','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'calf_r')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('calf_r','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('calf_r','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['calf_r'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['calf_r']];
                }

            }
            $body_part = 'Calf R';
        }
        if ($bodypart == 'calfL') {
            $columnName = 'calf_l';
            $personal_measurement = PersonalMeasurement::select('event_date', 'calf_l')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'calf_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('calf_l','!=','0')
                    ->orderBy('calf_l','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'calf_l')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('calf_l','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('calf_l','ASC')
                    ->first();
            $data = [];
            foreach ($personal_measurement as $value) {
                if ($value['calf_l'] > 0) {
                    $data[] = ['date' => $value['event_date'], 'value' => $value['calf_l']];
                }

            }
            $body_part = 'Calf L';
        }
        if ($bodypart == 'weight') {
            $columnName = 'weight';
            $get_last_data = PersonalMeasurement::select('event_date', 'weight', 'weightUnit')->where('weight', '>', 0)->whereIn('id', $event_id)->orderBy('event_date', 'desc')->limit(1)->first();
            $get_data = PersonalMeasurement::select('event_date', 'weight', 'weightUnit')->where('weight', '>', 0)->where('client_id', Auth::user()->account_id)->limit(1)->first();
            // $get_last_data = PersonalMeasurement::select('event_date', 'weight', 'weightUnit')->whereIn('id', $event_id)->orderBy('event_date', 'desc')->limit(1)->first();
            // $get_data = PersonalMeasurement::select('event_date', 'weight', 'weightUnit')->where('client_id', Auth::user()->account_id)->limit(1)->first();
            $personal_measurement = PersonalMeasurement::select('event_date', 'weight', 'weightUnit')->whereIn('id', $event_id)->orderBy('event_date', 'asc')->get()->toArray();
            $max = PersonalMeasurement::select('event_date', 'weight','weightUnit as unit')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('weight','!=','0')
                    ->orderBy('weight','DESC')
                    ->first();

            $min = PersonalMeasurement::select('event_date', 'weight','weightUnit as unit')
                    ->where('client_id', Auth::User()->account_id)
                    ->where('weight','!=','0')
                    ->where('event_date','!=',$max['event_date'])
                    ->orderBy('weight','ASC')
                    ->first();
            $data = [];
            if (isset($get_data)) {
                foreach ($personal_measurement as $value) {
                    if ($value['weight'] > 0) {
                        if (isset($get_last_data) && $get_last_data->weightUnit == 'Imperial') {
                            if ($value['weightUnit'] == 'Metric') {
                                $data[] = ['date' => $value['event_date'], 'value' => number_format((float) ($value['weight'] * 2.2046226218), 2, '.', '')];
                            } else {
                                $data[] = ['date' => $value['event_date'], 'value' => $value['weight']];
                            }
                        } else {
                            if ($value['weightUnit'] == 'Imperial') {
                                $data[] = ['date' => $value['event_date'], 'value' => number_format((float) ($value['weight'] / 2.2046226218), 2, '.', '')];
                            } else {
                                $data[] = ['date' => $value['event_date'], 'value' => $value['weight']];
                            }
                        }
                    }
                }
            } else {
                $clients = Clients::with(['parq' => function ($q) {
                    $q->select('client_id', 'weight', 'weightUnit');
                }])->find(Auth::User()->account_id);
                $get_last_data = $clients->parq;

                if (isset($get_last_data) && $get_last_data->weightUnit == 'Imperial') {
                    if ($value['weightUnit'] == 'Metric') {
                        $data[] = ['date' => date("Y-m-d"), 'value' => number_format((float) ($get_last_data->weight * 2.2046226218), 2, '.', '')];
                    } else {
                        $data[] = ['date' => date("Y-m-d"), 'value' => $get_last_data->weight];
                    }
                } else {
                    if ($value['weightUnit'] == 'Imperial') {
                        $data[] = ['date' => date("Y-m-d"), 'value' => number_format((float) ($get_last_data->weight / 2.2046226218), 2, '.', '')];
                    } else {
                        $data[] = ['date' => date("Y-m-d"), 'value' => $get_last_data->weight];
                    }
                }
            }

            $weight_unit = isset($get_last_data) ? ($get_last_data->weightUnit == 'Imperial' ? 'pound' : 'kg') : 'kg';

            $body_part = 'Weight';
        }

        $personal_measurement_fields = PersonalMeasurement::select('id','event_date','created_at',$columnName,'client_id','updated_at','updated_date','weightUnit','heightUnit')
                ->where('client_id',Auth::User()->account_id)
                ->where($columnName,'!=','0')
                ->orderBy('id','DESC')
                ->get();
        $personal_measurement_field = [];
        $i = 0;
        $label_suffix;
         foreach($personal_measurement_fields as $key =>$item){  
            if($key == 0){
                $personal_measurement_field[] = $item;
                 $i+=1;
            } else {
                if($item->$columnName != $personal_measurement_fields[$key-1]->$columnName){
                    $personal_measurement_field[] = $item;
                    $i+=1;
                 }
             } 
            if($i == 11){
                 break;
                }
            }
            // dd($personal_measurement_field);
        $html = View::make('Result.dailydiary.measurement-graph', compact('data', 'body_part', 'bodypart', 'duration',
               'weight_unit', 'height_unit', 'startOfTheMonth', 'stepSize', 'endOfTheMonth','max','min','columnName','personal_measurement_field','label_suffix'));
        $response['mob_html'] = $html->render();
        $response['status'] = 'ok';
        return response()->json($response);
    }

    public function storeListData(Request $request){
        $clientId = Auth::User()->account_id;
        $personalMeasurements = PersonalMeasurement::where('client_id',$clientId)
                     ->where('id',$request['id'])
                     ->first();
                   
            switch ($request['field']) {
                  case 'height':
                           $val = sprintf('%1.3f',$request['value']);
                           break;
                  case 'chest':
                             $val = sprintf('%1.3f',$request['value']);
                           break;
                  case 'neck':
                             $val = sprintf('%1.3f',$request['value']);
                           break;
                  case 'bicep_r':
                             $val = sprintf('%1.3f',$request['value']);
                             break;
                  case 'bicep_l':
                             $val = sprintf('%1.3f',$request['value']);
                             break;
                  case 'forearm_r':
                             $val = sprintf('%1.3f',$request['value']);
                             break;
                  case 'forearm_l':
                             $val = sprintf('%1.3f',$request['value']);
                             break;
                  case 'waist':
                             $val = sprintf('%1.3f',$request['value']); 
                             break;
                  case 'hip':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                  case 'thigh_r':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                  case 'thigh_l':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                  case 'calf_r':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                  case 'calf_l':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                  case 'weight':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                 }                   
         if($personalMeasurements){     
                 $clientMeasurements = $personalMeasurements->update([
                     $request['field'] => $val, 
                     'updated_date' => Carbon::now()->format('Y-m-d'),
                 ]); 
             $response = [
                     'status' => 'ok',
                     'message' => 'Data saved successfully'
                 ];
                 return response()->json($response);
          } else {
             $response = [
                 'status' => 'error',
                 'message' => 'Something went wrong'
             ];
             return response()->json($response);
          }
       }

    /*  */
}
