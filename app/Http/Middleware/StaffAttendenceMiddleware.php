<?php
namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\StaffAttendence;
use App\Hours;
use DB;
use Session;

class StaffAttendenceMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        
        if($request->isMethod('get') && !$request->ajax() && !\Route::is('dashboard.show')){
            if($request->has('date')){
               $dateCarbon = new Carbon($request->date); 
            }else{
               $dateCarbon = setLocalToBusinessTimeZone(Carbon::now());
            }

            dispatch(new \App\Jobs\StaffAttendanceJob($dateCarbon));
            
        }

        return $next($request);
    }
    
}
