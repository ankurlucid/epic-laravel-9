<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\StaffEventsTrait;

class UpdateClientMembershipLimitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StaffEventsTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $clientId;
    protected $dates;
    protected $eventData;

    public function __construct($clientId, $dates, $eventData)
    {
        $this->clientId = $clientId;
        $this->dates = $dates;
        $this->eventData = $eventData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateClientMembershipLimit($this->clientId, $this->dates, $this->eventData);
    }
}
