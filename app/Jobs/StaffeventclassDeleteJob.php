<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class StaffeventclassDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $event;
   
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = $this->event;
        if($event->forceDeleting){
            // $event->histories()->forceDelete();
            $event->resources()->forceDelete();
            DB::table('staff_event_class_areas')->where('seca_sec_id', $event->sec_id)->forceDelete();
            if($event->DELETE_LINKED_CLIENTS){
                DB::table('staff_event_class_clients')->where('secc_sec_id', $event->sec_id)->forceDelete();
            }
        } 
        else{
            // $event->histories()->delete();
            $event->resources()->delete();
            DB::table('staff_event_class_areas')->where('seca_sec_id', $event->sec_id)->update(array('deleted_at' => createTimestamp()));
            if($event->DELETE_LINKED_CLIENTS){
                $teamSalesProcessClients = $event->teamSalesProcessClients;
                if($teamSalesProcessClients->count()){
                    foreach($teamSalesProcessClients as $teamSalesProcessClient){
                        $event->manageSessionSalesProcess($teamSalesProcessClient, $event->sec_id/*, true*/);
                    }    
                }
                DB::table('staff_event_class_clients')->where('secc_sec_id', $event->sec_id)->update(array('deleted_at' => createTimestamp()));
                DB::table('class_clients_rejected')->where('ccr_sec_id', $event->sec_id)->update(array('deleted_at' => createTimestamp()));
            }
        }
    }
}
