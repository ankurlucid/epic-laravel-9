<?php

use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\NewDashboardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Setings\Contact\ContactController;
use App\Http\Controllers\Setings\Membership\MembershipController;
use App\Http\Controllers\Setings\Staff\StaffController;
/**
 * Frontend Access Controllers
 */

Route::get('/', function () {

    return redirect()->route('auth.login');
});

\Route::group(['namespace' => 'Auth'], function () {


    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [AuthController::class,'logout'])->name('auth.logout');

        // Change Password Routes
        Route::get('password/change', 'PasswordController@showChangePasswordForm')->name('auth.password.change');
        Route::post('password/change', 'PasswordController@changePassword')->name('auth.password.update');
    });

    /**
     * These routes require the user NOT be logged in
     */
    \Route::group(['middleware' => 'guest'], function () {

        \Route::get('login/{businessUrl?}',[AuthController::class,'showLoginForm'])->name('auth.login');
        \Route::post('login', [AuthController::class,'login'])->name('auth.doLogin');

        \Route::post('checkuser', 'AuthController@checkUserType');

    });

    // Route::group(['middleware' => ['web', 'auth', 'member','attendence']], function(){
    Route::group(['middleware' => ['web','auth']], function(){

        Route::get('dashboard',[NewDashboardController::class,'show'])->name('dashboard.show');

        Route::get('/dashboard/calendar-new', [CalendarController::class,'indexNew'])->name('calendar-new');

        Route::post('dashboard/chart-setting',[NewDashboardController::class,'editChart'])->name('dashboard.editChart');
        Route::post('dashboard/tasks',[NewDashboardController::class,'getTasks'])->name('dashboard.getTasks');
        Route::get('upcoming-tasks',[NewDashboardController::class,'callUpcomingTasksTimestamp'])->name('dashboard.callUpcomingTasksTimestamp');

        Route::get('client/{id}',[ClientsController::class,'show'])->name('clients.show');

        Route::group(['prefix' => 'clients'], function() {

            Route::get('csv-export', [ClientsController::class,'csvExport'])->name('status.export');
            Route::get('all', [ClientsController::class,'allClients'])->name('allClients');
            Route::get('create', [ClientsController::class,'create'])->name('clients.create');
            Route::get('print-appointments', [ClientsController::class,'printAppointments'])->name('clients.print');
            
            Route::get('{filter?}', [ClientsController::class,'index'])->name('clients');

            Route::get('{id}/co', [ClientsController::class,'coClients']);
            Route::get('{id}/edit', [ClientsController::class,'edit'])->name('clients.edit');
            Route::patch('{id}', [ClientsController::class,'update'])->name('clients.update');
            Route::get('operate-as-client/{id}',[ClientsController::class,'operateAsClient'])->name('clients.operateAsClient');

            Route::delete('{id}', [ClientsController::class,'destroy'])->name('clients.destroy');

            Route::post('', [ClientsController::class,'save'])->name('clients.store');
            Route::post('raise-make-up', [ClientsController::class,'raiseMakeUp']);
            Route::get('makeup-netamount/{id}', [ClientsController::class,'makeupNetamount']);
            Route::post('sales-process/price-emailed', [ClientsController::class,'priceEmailed']);
            Route::post('sales-process/update', [ClientsController::class,'updateSalesProcess']);
            Route::post('membership/update', [ClientsController::class,'updateMembership']);
            Route::post('{id}/membership/delete', [ClientsController::class,'deleteMembership']);
            Route::post('membership/makeup', [ClientsController::class,'setMembershipEpic']);
            Route::get('membership/services',[ClientsController::class,'getMembService']);

            Route::patch('{id}/sales-process-settings', [ClientsController::class,'salesProcSettings'])->name('clients.salesProcSett');

            Route::post('{clientId}/menues/', [ClientsController::class,'saveMenues'])->name('menu.save');
            
        });

        Route::group(['prefix' => 'settings/business'], function(){


            Route::group(['prefix' => 'contacts', 'namespace' => 'Setings\Contact'], function(){
                
                Route::get('', [ContactController::class,'index'])->name('contacts');

            });

            Route::group(['prefix' => 'memberships', 'namespace' => 'Setings\Membership'], function(){
            
                Route::get('', [MembershipController::class,'index'])->name('memberships');
                
            });

            Route::group(['prefix' => 'staffs', 'namespace' => 'Setings\Staff'], function(){
                
                Route::get('', [StaffController::class,'index'])->name('staffs');

            });

        }); 
        
    });

});
