<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

/**
 * Class LocaleMiddleware
 * @package App\Http\Middleware
 */
class UpdateFastingTimezoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (\Auth::check()) {
            
            $interFast = \App\Models\IntermittentFast::where('client_id',\Auth::user()->account_id)->first();

            if (isset($interFast) && $interFast != null) {
                    
                if (empty($interFast->timezone)) {
                    
                    $parqData = \App\Models\Parq::where('client_id',\Auth::user()->account_id)->first();

                    if (isset($parqData) && !empty($parqData->timezone)) {

                        $timezone = $parqData->timezone;  

                    }else{

                        $timezone = "Asia/Calcutta";
                    }

                    $interFast->timezone = $timezone;
                    $interFast->save();
                }

            }


        }


        return $next($request);
    }
}
