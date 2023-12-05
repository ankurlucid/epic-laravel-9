<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\StaffAttendence;
use App\Models\Hours;
use DB;
use Session;

class StaffAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dateCarbon;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dateCarbon)
    {
        $this->dateCarbon = $dateCarbon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dateCarbon = $this->dateCarbon;

           $date = $dateCarbon->toDateString();
                $day = $dateCarbon->format('l');
                                 $gethourlists = DB::table('hours')->where('hr_entity_type','staff')->select('hr_id','hr_entity_id', 'hr_start_time','hr_end_time','hr_edit_date','hr_entity_type','hr_entity_number')
                                    ->whereNull('deleted_at')->where('hr_day',$day)
                                    ->where(function($q) use ($date){
                                        $q->where(function($query) use ($date){
                                            $query->where('hr_edit_date','=',$date);
                                        })->orWhereNull('hr_edit_date');
                                    })
                                    ->where('hr_start_time','!=','hr_end_time')
                                    // ->orderBy('hr_entity_id')
                                    ->orderBy('hr_edit_date','desc')
                                    ->get();
                if(!$gethourlists->isEmpty()){
                    $existHourId = [];
                    
                    foreach ($gethourlists as $key => $gethourlist) {
                        if(in_array($gethourlist->hr_entity_id, $existHourId) && $gethourlist->hr_edit_date != null){
                            $insertData = array('sa_staff_id' =>$gethourlist->hr_entity_id, 'sa_start_time'=>$gethourlist->hr_start_time, 'sa_end_time'=>$gethourlist->hr_end_time,'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time, 'sa_date'=>$date, 'sa_status'=>'','sa_entity_number'=>$gethourlist->hr_entity_number);
                        }
                        else if(!in_array($gethourlist->hr_entity_id, $existHourId) && $gethourlist->hr_edit_date != null){
                            $flag=true;
                            $existHourId[] = $gethourlist->hr_entity_id;
                            $insertData = array('sa_staff_id' =>$gethourlist->hr_entity_id, 'sa_start_time'=>$gethourlist->hr_start_time, 'sa_end_time'=>$gethourlist->hr_end_time, 'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time,'sa_date'=>$date, 'sa_status'=>'','sa_entity_number'=>$gethourlist->hr_entity_number);
                        }
                        else if(in_array($gethourlist->hr_entity_id, $existHourId) && $gethourlist->hr_edit_date == null){
                            $insertData = array('sa_staff_id' =>$gethourlist->hr_entity_id, 'sa_start_time'=>$gethourlist->hr_start_time, 'sa_end_time'=>$gethourlist->hr_end_time,'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time, 'sa_date'=>$date, 'sa_status'=>'', 'sa_entity_number'=>$gethourlist->hr_entity_number);
                        }
                        elseif(!in_array($gethourlist->hr_entity_id, $existHourId) && $gethourlist->hr_edit_date == null){
                            $existHourId[] = $gethourlist->hr_entity_id;
                            $insertData = array('sa_staff_id' =>$gethourlist->hr_entity_id, 'sa_start_time'=>$gethourlist->hr_start_time, 'sa_end_time'=>$gethourlist->hr_end_time,'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time, 'sa_date'=>$date, 'sa_status'=>'', 'sa_entity_number'=>$gethourlist->hr_entity_number);
                        }
                        $isRecordExist = StaffAttendence::with(['client'])->whereDate('sa_date',$date)->where(function($q) use($gethourlist){
                            $q->where(function($query) use($gethourlist){
                                $query->where('sa_start_time',$gethourlist->hr_start_time)->where('sa_end_time',$gethourlist->hr_end_time);
                            })
                            ->orWhere(function($query) use($gethourlist){
                                $query->where('edited_start_time',$gethourlist->hr_start_time)->where('edited_end_time',$gethourlist->hr_end_time);
                                
                            });
                        })->where('sa_staff_id',$gethourlist->hr_entity_id)->get();
                        
                        if(!$isRecordExist->isEmpty()){
                            if(count($isRecordExist) > 1){
                                // $StaffData = $isRecordExist->where('sa_status','')->delete();
                                $staffAttendence = StaffAttendence::with(['client'])->withTrashed()->where('sa_date',$date)->where(function($q) use($gethourlist){
                                    $q->where(function($query) use($gethourlist){
                                        $query->where('sa_start_time',$gethourlist->hr_start_time)->where('sa_end_time',$gethourlist->hr_end_time);
                                    })
                                    ->orWhere(function($query) use($gethourlist){
                                        $query->where('edited_start_time',$gethourlist->hr_start_time)->where('edited_end_time',$gethourlist->hr_end_time);
                                        
                                    });
                                })->where('sa_staff_id',$gethourlist->hr_entity_id)->first();
                                if($staffAttendence['sa_status'] == ''){
                                    $staffAttendence->update(['sa_start_time'=>$gethourlist->hr_start_time,'sa_end_time'=>$gethourlist->hr_end_time,'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time, 'sa_date'=>$date,'sa_entity_number'=>$gethourlist->hr_entity_number]);
                                    setInfoLog('Updated from middleware when isRecordExist is greater', $staffAttendence['id'],$staffAttendence->client,'optimize');
                                
                                    
                                }
                              
                            }else{
                                if($isRecordExist[0]->sa_status == ''){
                                $isRecordExist[0]->update(['sa_start_time'=>$gethourlist->hr_start_time,'sa_end_time'=>$gethourlist->hr_end_time,'edited_start_time'=>$gethourlist->hr_start_time,'edited_end_time'=>$gethourlist->hr_end_time, 'sa_date'=>$date,'sa_entity_number'=>$gethourlist->hr_entity_number]);
                                setInfoLog('Updated from middleware when isRecordExist is less', $isRecordExist[0]->id,$isRecordExist[0]->client,'optimize');
                                }
                            }
                           
                        }else{
                            $isRecordExist = StaffAttendence::with(['client'])->withTrashed()->whereDate('sa_date',$date)->where('sa_entity_number',$gethourlist->hr_entity_number)->where('sa_staff_id',$gethourlist->hr_entity_id)->first();
                            $currentDate = setLocalToBusinessTimeZone(Carbon::now());
                       
                            if(!$isRecordExist &&  Carbon::parse($date)->format('Y-m-d') >= $currentDate->format('Y-m-d')){
                                $staffAttendence = StaffAttendence::create($insertData);
                                setInfoLog('Created from middleware',  $staffAttendence->id,$staffAttendence->client,'optimize');
                            }
                        }

                    }
                }
    }
}
