<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\StaffEventHistoryTrait;
use App\Http\Traits\StaffEventClassTrait;
use \stdClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class sendClientClassBookingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StaffEventHistoryTrait, StaffEventClassTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $eventClass;
    protected $client;
    protected $type;
    protected $request;

    public function __construct($eventClass, $client, $type)
    {
        $this->eventClass = $eventClass;
        $this->client = $client;
        $this->type = $type;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {

        $client = $this->client;
        if ( $this->type == 'confirm') { 
            
            $eventClass = $this->eventClass;

            $dataForEmail                     = new stdClass();
            $dataForEmail->eventDateTimeEmail = dbDateToDateTimeString(Carbon::createFromFormat('Y-m-d H:i:s', $eventClass->sec_start_datetime));
            $dataForEmail->modalLocArea       = $eventClass->areas->pluck('la_id')->toArray();
            $dataForEmail->staffClass         = $eventClass->sec_class_id;
            $dataForEmail->staff              = $eventClass->sec_staff_id;
            $alertHistoryText                 = $this->sendClientClassBookingEmail('confirm', $dataForEmail, [$client]);

            $this->alertHistory(['text' => rtrim($alertHistoryText, "|"), 'event' => $eventClass]);
        
        }elseif( $this->type == 'cancel'){

            $origEvent = $this->eventClass;
            $alertHistoryText            = $this->sendClientClassBookingEmail('cancel', $request, [$client]);
            $this->alertHistory(['text' => rtrim($alertHistoryText, "|"), 'event' => $origEvent]);
        }

    }

    protected function sendClientClassBookingEmail($action, $request, $clients)
    {
        return $this->sendClientEventBookingEmail($action, $request, $clients, 'class');
    }
}
