<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\StaffEventsTrait;
use App\Http\Traits\HelperTrait;
use App\Http\Traits\ClosedDateTrait;

class MemberMiddlewareJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StaffEventsTrait, HelperTrait, ClosedDateTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*Start: Delete those event witch have only data */
                    $this->deleteStaffEventSingleServices();
                /*End: Delete those event witch have only data */

                /* Start: set time zone in session valiable */    
                    $this->setTimeZone();
                /* End: set time zone in session valiable */ 

                /* Start: Set nex invoice id in salestool */
                    $this->setNextInvoiceId();
                /* End: Set nex invoice id in salestool   */


                /* Start: Update 'this' updated bookings */
                    //$this->updateThisOnlyBookings();
                /* End: Update 'this' updated bookings */
                /* Start: Clear old parent id of bookings */
                    //$this->updateThisOnlyBookings();
                    //$this->clearBookingOldPar();
                /* End: Clear old parent id of bookings */
    }
}
