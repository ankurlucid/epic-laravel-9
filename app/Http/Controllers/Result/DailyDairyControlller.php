<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
use View;
use App\{PersonalStatistic,GoalPersonalStatistic};

class DailyDairyControlller extends Controller
{
    public function dailyDairy(Request $request)
    {
        $clickDate = $request->date;
        return view('Result.dailydiary.daily-diary',compact('clickDate'));
    }

  
    public function personalStastic(Request $request)
    {
        $clickDate = $request->date;
        $clientId = Auth::User()->account_id;
        if($clickDate){
            $eventDate = $clickDate;
        }else{
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
        $statisticsData = [];
        $statistics = PersonalStatistic::where('client_id',$clientId)
                    ->whereDate('event_date','<=',$eventDate)
                    ->orderBy('event_date','DESC')
                    ->orderBy('id','DESC')
                    ->first();

        if($statistics){
            $statisticsData = $statistics->toArray();
        }
        $body_part = 'BFP';
        $duration = 1;
        $bodypart = "bfp";
        $updated_field = "bfp_kg";
        $label_suffix = '%';
        $column_name = 'bfp_kg';
        $personal_statistic = PersonalStatistic::select('id','event_date')->orderBy('event_date','asc')->orderBy('id','asc')->where('client_id',Auth::User()->account_id);
        // if($duration == 1){
            $stepSize =  1;
            $startOfTheMonth = date('Y-m-01');
            $endOfTheMonth = date('Y-m-t');
            $personal_statistic = $personal_statistic->whereBetween('event_date',[date('Y-m-01') , date('Y-m-d')])->get()->toArray();      
            // $previous_event_date = [];
            // $event_id = [];
            // foreach($personal_statistic as $val){  
            //     if(in_array($val['event_date'], $previous_event_date)){
            //         array_pop($event_id);
            //         array_push($event_id, $val['id']);
            //     }else{
            //         $event_id[] = $val['id'];
            //     }
            //     $previous_event_date[] = $val['event_date'];
            // }

            // if($bodypart == 'bfp'){
            //     $personal_statistic = PersonalStatistic::select('event_date','bfp_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
            //     $data = [];
            //     foreach($personal_statistic as $value){
            //         if($value['bfp_kg'] > 0){
            //             $data[] = ['date' => $value['event_date'],'value'=>$value['bfp_kg']];
            //         }
            //     }
            //     $body_part = 'BFP';
            //     $label_suffix = '%';
            // }
        $max = PersonalStatistic::select('event_date', 'bfp_kg')
                ->where('client_id', Auth::User()->account_id)
                ->where('bfp_kg','!=','0')
                ->orderBy('bfp_kg','DESC') 
                ->first();
    
        $min = PersonalStatistic::select('event_date', 'bfp_kg')
                ->where('client_id', Auth::User()->account_id)
                ->where('bfp_kg','!=','0')
                ->where('event_date','!=',$max['event_date'])
                ->orderBy('bfp_kg','ASC')  
                ->first();

        $personal_statistic_fields = PersonalStatistic::select('id','event_date','updated_field','created_at','bfp_kg','client_id','updated_at')
                             ->where('client_id',Auth::User()->account_id)
                             ->orderBy('id','DESC')
                            //  ->groupBy('bfp_kg')
                            //  ->where('updated_field','bfp_kg')
                            //  ->take(11)
                             ->get();
         $personal_statistic_field = [];
          $i = 0;
        foreach($personal_statistic_fields as $key =>$item){  
           if($key == 0){
            $personal_statistic_field[] = $item;
               $i+=1;
           } else {
             if($item->bfp_kg != $personal_statistic_fields[$key-1]->bfp_kg){
                $personal_statistic_field[] = $item;
                 $i+=1;
               }
            } 
            if($i == 11){
               break;
            }
        }
        // dd($statisticsData);

        return view('Result.dailydiary.personal-stastic',compact('statisticsData','eventDate','personal_statistic_field','body_part','bodypart','updated_field','label_suffix','column_name','max','min'));
    }

    public function storeData(Request $request){
        $requestData = $request->all();
        if($requestData['eventDate']){
            $eventDate = $requestData['eventDate'];
        }else{
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
        $clientId = Auth::User()->account_id;
        DB::beginTransaction();
        $dbStatus = true;
        try{ 
           if(isset($requestData)){
                $personalStatistics = PersonalStatistic::where('client_id',$clientId)->orderBy('id','DESC')->first();
                $statisticsData = $requestData;
                // $createStatesData = false;
                // if($personalStatistics){
                //     if($personalStatistics->event_date != $eventDate || $personalStatistics->bfp_kg != $statisticsData['bfp_kg'] || $personalStatistics->smm_kg != $statisticsData['smm_kg'] || $personalStatistics->bmr_kg != $statisticsData['bmr_kg'] || $personalStatistics->bmi_kg != $statisticsData['bmi_kg']|| $personalStatistics->sleep_kg != $statisticsData['sleep_kg']|| $personalStatistics->h_w_ratio != $statisticsData['h_w_ratio'] || $personalStatistics->vis_eat_kg != $statisticsData['vis_eat_kg'] || $personalStatistics->pulsed_kg != $statisticsData['pulsed_kg'] || $personalStatistics->bp_mm != $statisticsData['bp_mm']|| $personalStatistics->bp_hg != $statisticsData['bp_hg']){
                //         $createStatesData = true;
                //     }
                // }
                // if(!$personalStatistics || $createStatesData){
                $personalStatisticData = PersonalStatistic::where('client_id',$clientId)
                                ->whereDate('event_date','=', $eventDate)
                                ->orderBy('event_date','DESC')
                                ->orderBy('id','DESC')
                                ->first();  
        // $clientStatistics = PersonalStatistic::UpdateOrCreate(
            // [id=>$personalStatisticData['id']],
            // [ 'client_id' => $clientId,
                $clientStatistics = PersonalStatistic::UpdateOrCreate(
                    [id=>$personalStatisticData['id']],
                    ['client_id' => $clientId,
                    'event_date' => $eventDate,
                    'bfp_kg' => sprintf('%1.3f',$statisticsData['bfp_kg']),
                    'smm_kg' => sprintf('%1.3f',$statisticsData['smm_kg']),
                    'bmr_kg' => round($statisticsData['bmr_kg']),
                    'bmi_kg' => sprintf('%1.3f',$statisticsData['bmi_kg']),
                    'sleep_kg' => sprintf('%1.3f',$statisticsData['sleep_kg']),
                    'h_w_ratio' => sprintf('%1.2f',$statisticsData['h_w_ratio']),
                    'vis_eat_kg' => round($statisticsData['vis_eat_kg']),
                    'pulsed_kg' => round($statisticsData['pulsed_kg']),
                    'bp_mm' => round($statisticsData['bp_mm']),
                    'bp_hg' => round($statisticsData['bp_hg']),
                    // 'updated_field'=> $requestData['updated_field'],
                    'extra_input' => $statisticsData['extra_input']
                    ]);
                    if(!$clientStatistics){
                        $dbStatus = false;
                    }   
            //    }
           }
        }catch(\ Throwable $e){
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
        if($dbStatus){
            DB::commit();
            $response = [
                'status' => 'ok',
                'message' => 'Data saved successfully'
            ];
            return response()->json($response);
        } else{
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
            return response()->json($response);
        }
    }

    public function storeGoalData(Request $request){
        $requestData = $request->all();
        $clientId = Auth::User()->account_id;
        // $personalStatistics = PersonalStatistic::where('client_id',$clientId)->orderBy('id','DESC')->first();
            try{ 
                switch ($requestData['field_name']) {
                    case 'bfp_kg':
                      $val = sprintf('%1.3f',$requestData['value']);
                      break;
                    case 'smm_kg':
                        $val = sprintf('%1.3f',$requestData['value']);
                      break;
                    case 'bmr_kg':
                        $val = round($requestData['value']);
                      break;
                    case 'bmi_kg':
                        $val = sprintf('%1.3f',$requestData['value']);
                        break;
                    case 'sleep_kg':
                        $val = sprintf('%1.3f',$statisticsData['value']);
                        break;
                    case 'h_w_ratio':
                        $val = sprintf('%1.2f',$requestData['value']);
                        break;
                    case 'vis_eat_kg':
                        $val = round($requestData['value']);
                        break;
                    case 'pulsed_kg':
                        $val = round($requestData['value']);  
                        break;
                    case 'bp_mm':
                        $val = round($requestData['value']);
                         break;
                    case 'bp_hg':
                        $val =  round($requestData['value']); 
                        break;
                  }
                  $goalPersonal['due_date'] = $requestData['due_date'];
                  $goalPersonal['field_name'] = $requestData['field_name'];
                  $goalPersonal['value'] = $requestData['value'];
                  $addGoalPersonal = json_encode($goalPersonal);
                  if($requestData['field_name'] == 'bp_mm'){
                        $goalPersonalBpHg['due_date'] = $requestData['due_date'];
                        $goalPersonalBpHg['field_name'] = 'bp_hg';
                        $goalPersonalBpHg['value'] = $requestData['field_name_bp_hg'];
                        $addGoalPersonalBpHg = json_encode($goalPersonalBpHg);
                    }
                  $find_id = GoalPersonalStatistic::where('client_id',$clientId)
                            ->where('personal_statistic_id',$requestData['personalStatisticId'])
                            ->first();
                  if($find_id){
                      if($requestData['field_name'] == 'bp_mm'){
                         $goalStatistic = $find_id->update([
                                $requestData['field_name'] => $addGoalPersonal,
                                'bp_hg' => $addGoalPersonalBpHg
                            ]);
                      } else {
                        $goalStatistic = $find_id->update([
                            $requestData['field_name']=> $addGoalPersonal,
                          ]); 
                      }                
                  }else {
                        if($requestData['field_name'] == 'bp_mm'){
                            $goalStatistic = GoalPersonalStatistic::create([
                                'client_id'=> $clientId ,
                                'personal_statistic_id'=> $requestData['personalStatisticId'],
                                 $requestData['field_name'] => $addGoalPersonal,
                                 'bp_hg' => $addGoalPersonalBpHg
                            ]);
                    } else {
                          $goalStatistic = GoalPersonalStatistic::create([
                            'client_id'=> $clientId ,
                            'personal_statistic_id'=> $requestData['personalStatisticId'],
                            $requestData['field_name']=> $addGoalPersonal,
                         ]); 
                     }
                  }
                  

                if($goalStatistic){
                        $response = [
                            'status' => 'ok',
                            'message' => 'Data saved successfully'
                        ];
                        return response()->json($response);
                    } else{
                        $response = [
                            'status' => 'error',
                            'message' => 'Something went wrong'
                        ];
                        return response()->json($response);
                    }
            }catch(\ Throwable $e){
                $response = [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
                return response()->json($response);
            }
      }

      public function personalStatisticsGraph(Request $request){
        $bodypart = $request->bodypart ;
        $duration = 1;
        $updated_field =  $request->updated_field;
        $max_bp_hg='';
        $min_bp_hg='';
        $personal_statistic = PersonalStatistic::select('id','event_date')->orderBy('event_date','asc')->orderBy('id','asc')->where('client_id',Auth::User()->account_id);
        // if($duration == 1){
            $stepSize =  1;
            $startOfTheMonth = date('Y-m-01');
            $endOfTheMonth = date('Y-m-t');
            $personal_statistic = $personal_statistic->whereBetween('event_date',[date('Y-m-01') , date('Y-m-d')])->get()->toArray();
            
            $previous_event_date = [];
            $event_id = [];
            foreach($personal_statistic as $val){
                
                if(in_array($val['event_date'], $previous_event_date)){
                    array_pop($event_id);
                    array_push($event_id, $val['id']);
                }else{
                    $event_id[] = $val['id'];
                }
                $previous_event_date[] = $val['event_date'];
            }

            if($bodypart == 'bfp'){
                $personal_statistic = PersonalStatistic::select('event_date','bfp_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['bfp_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['bfp_kg']];
                    }
    
                }
                $body_part = 'BFP';
                $label_suffix = '%';
                $column_name = 'bfp_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where( $column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();
        
                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'smm'){
                $personal_statistic = PersonalStatistic::select('event_date','smm_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['smm_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['smm_kg']];
                    }
                    
                }
                $body_part = 'SMM';
                $label_suffix = 'kg';
                $column_name = 'smm_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'bmr'){
                $personal_statistic = PersonalStatistic::select('event_date','bmr_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['bmr_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['bmr_kg']];
                    }
                    
                }
                $body_part = 'BMR';
                $label_suffix = 'KCal';
                $column_name = 'bmr_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'bmi'){
                $personal_statistic = PersonalStatistic::select('event_date','bmi_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['bmi_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['bmi_kg']];
                    }
                    
                }
                $body_part = 'BMI';
                $label_suffix = 'kg/m2';
                $column_name = 'bmi_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'bfm'){
                $personal_statistic = PersonalStatistic::select('event_date','sleep_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['sleep_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['sleep_kg']];
                    }
                    
                }
                $body_part = 'BFM';
                $label_suffix = 'kg';
                $column_name = 'sleep_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'hw'){
                $personal_statistic = PersonalStatistic::select('event_date','h_w_ratio')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['h_w_ratio'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['h_w_ratio']];
                    }
                    
                }
                $body_part = 'H/W Ratio';
                $label_suffix = '';
                $column_name = 'h_w_ratio';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'vis_fat'){
                $personal_statistic = PersonalStatistic::select('event_date','vis_eat_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['vis_eat_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['vis_eat_kg']];
                    }
                    
                }
                $body_part = 'Vis Fat';
                $label_suffix = 'kg';
                $column_name = 'vis_eat_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'pulse'){
                $personal_statistic = PersonalStatistic::select('event_date','pulsed_kg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                foreach($personal_statistic as $value){
                    if($value['pulsed_kg'] > 0){
                        $data[] = ['date' => $value['event_date'],'value'=>$value['pulsed_kg']];
                    }
                    
                }
                $body_part = 'Pulse';
                $label_suffix = 'bpm';
                $column_name = 'pulsed_kg';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where( $column_name,'!=','0')
                        ->orderBy( $column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();
            }
            if($bodypart == 'bp'){
                $personal_statistic = PersonalStatistic::select('event_date','bp_mm','bp_hg')->whereIn('id',$event_id)->orderBy('event_date','asc')->get()->toArray();
                $data = [];
                $data1 = [];
                foreach($personal_statistic as $value){
                    if($value['bp_mm'] > 0){
                        $data[] = ['date' => $value['event_date'],'bp_mm'=>$value['bp_mm'],'bp_hg'=>$value['bp_hg']];
                    }
                    
                }
                $body_part = 'Blood Pressure';
                $label_suffix = 'mmHg';
                $column_name = 'bp_mm';
                $max = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->orderBy($column_name,'DESC') 
                        ->first();

                $min = PersonalStatistic::select('event_date', $column_name)
                        ->where('client_id', Auth::User()->account_id)
                        ->where($column_name,'!=','0')
                        ->where('event_date','!=',$max['event_date'])
                        ->orderBy($column_name,'ASC')  
                        ->first();

                $max_bp_hg = PersonalStatistic::select('event_date', 'bp_hg')
                        ->where('client_id', Auth::User()->account_id)
                        ->where('bp_hg','!=','0')
                        ->orderBy('bp_hg','DESC') 
                        ->first();

                $min_bp_hg = PersonalStatistic::select('event_date', 'bp_hg')
                        ->where('client_id', Auth::User()->account_id)
                        ->where('bp_hg','!=','0')
                        ->where('event_date','!=',$max_bp_hg['event_date'])
                        ->orderBy('bp_hg','ASC')  
                        ->first();
            }

            $pastMonth = date("Y-m-d");
            $viewCalendar = date('M Y',strtotime(date("Y-m-d")));
          if($updated_field == 'bp_mm') {
              $personal_statistic_fields = PersonalStatistic::select('id','event_date','updated_field','created_at',$updated_field,'bp_hg','client_id','updated_at')
                        ->orderBy('id','DESC')
                        ->where('client_id',Auth::User()->account_id)
                        ->where($updated_field,'!=','0')
                        // ->where('updated_field',$updated_field)
                        // ->take(11)
                        ->get();
          } else {
             $personal_statistic_fields = PersonalStatistic::select('id','event_date','updated_field','created_at',$updated_field,'client_id','updated_at')
                        ->orderBy('id','DESC')
                        ->where('client_id',Auth::User()->account_id)
                        ->where($updated_field,'!=','0')
                        // ->where('updated_field',$updated_field)
                        // ->take(11)
                        ->get();
               }
        
            $personal_statistic_field = [];
            $i = 0;
             foreach($personal_statistic_fields as $key =>$item){  
                if($key == 0){
                 $personal_statistic_field[] = $item;
                    $i+=1;
                } else {
                   if($item->$updated_field != $personal_statistic_fields[$key-1]->$updated_field){
                //  if($item->$column_name != $personal_statistic_fields[$key-1]->$column_name){
                     $personal_statistic_field[] = $item;
                      $i+=1;
                    }
                 } 
                 if($i == 11){
                    break;
                 }
             }
       
            $html = View::make('Result.dailydiary.graph-mob', compact('data','body_part','bodypart','duration','pastMonth',
               'viewCalendar','label_suffix','startOfTheMonth','stepSize','endOfTheMonth','personal_statistic_field',
               'updated_field','column_name','max','min','max_bp_hg','min_bp_hg'));
            $response['mob_html'] = $html->render();
            $response['status'] = 'ok';
            return response()->json($response);
         
      }
   
      public function getGoalData($field,$id){
           $goalData = GoalPersonalStatistic::select($field,'bp_hg')->where('personal_statistic_id',$id)->first();
           if($field == 'bp_mm'){
                $selectedGoal =  json_decode( $goalData,true) ;
                $response['data'] = json_decode($selectedGoal[$field],true) ; 
                $response['bp_hg'] = json_decode($selectedGoal['bp_hg'],true) ; 
           } else {
              $selectedGoal =  json_decode( $goalData,true) ;
              $response['data'] = json_decode($selectedGoal[$field],true) ; 
           }
           return response()->json($response);

      }

   public function storeListData(Request $request){
       $clientId = Auth::User()->account_id;
       $personalStatistics = PersonalStatistic::where('client_id',$clientId)
                    ->where('id',$request['id'])
                    ->first();
           switch ($request['field']) {
                 case 'bfp_kg':
                          $val = sprintf('%1.3f',$request['value']);
                          break;
                 case 'smm_kg':
                            $val = sprintf('%1.3f',$request['value']);
                          break;
                 case 'bmr_kg':
                            $val = round($request['value']);
                          break;
                 case 'bmi_kg':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                 case 'sleep_kg':
                            $val = sprintf('%1.3f',$request['value']);
                            break;
                 case 'h_w_ratio':
                            $val = sprintf('%1.2f',$request['value']);
                            break;
                 case 'vis_eat_kg':
                            $val = round($request['value']);
                            break;
                 case 'pulsed_kg':
                            $val = round($request['value']);  
                            break;
                 case 'bp_mm':
                            $val = round($request['value']);
                            $valBpHg = round($request['bp_hg']);
                             break;
                //  case 'bp_hg':
                //             $val =  round($requestData['value']); 
                //             break;
                }                   
        if($personalStatistics){
            if($request['field'] == 'bp_mm'){
               $clientStatistics = $personalStatistics->update([
                    $request['field'] => $val , 
                    'bp_hg' => $valBpHg
                ]);
            } else {
                $clientStatistics = $personalStatistics->update([
                    $request['field'] => $val, 
                ]); 
            }
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
     
}
