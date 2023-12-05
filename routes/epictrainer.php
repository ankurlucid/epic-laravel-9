<?php 
use App\Http\Controllers\Setings\Business\MuscleController;

    Route::group(['middleware' => ['web']], function() {

        
        /**
         * Frontend Routes
         * Namespaces indicate folder structure
         */

        Route::group(['namespace' => 'Frontend'], function () {
            
            include('Frontend/Access.php');
        });

    }); 

    Route::group([ 'middleware' => ['web', 'auth'] ],function()
    {
       
        Route::group(['prefix' => 'clients'], function(){
            Route::get('csv-export', 'ClientsController@csvExport')->name('status.export');
            Route::get('all', 'ClientsController@allClients');
            Route::get('create', 'ClientsController@create')->name('clients.create');
            Route::get('print-appointments', 'ClientsController@printAppointments')->name('clients.print');
            Route::get('{filter?}','ClientsController@index')->name('clients');
            Route::get('{id}/co', 'ClientsController@coClients');
            Route::get('{id}/edit', 'ClientsController@edit')->name('clients.edit');
            Route::patch('{id}', 'ClientsController@update')->name('clients.update');
            Route::get('operate-as-client/{id}','ClientsController@operateAsClient')->name('clients.operateAsClient');

            Route::delete('{id}', 'ClientsController@destroy')->name('clients.destroy');

            Route::post('', 'ClientsController@save')->name('clients.store');
            Route::post('raise-make-up', 'ClientsController@raiseMakeUp');
            Route::get('makeup-netamount/{id}', 'ClientsController@makeupNetamount');
            Route::patch('raise-make-up/{id}', 'MakeupController@update');
            Route::delete('makeup/{id}', 'MakeupController@destroy')->name('makeup.destroy');
            Route::get('getnotes/{id}', 'MakeupController@getNotes');
            Route::post('sales-process/price-emailed', 'ClientsController@priceEmailed');
            Route::post('sales-process/update', 'ClientsController@updateSalesProcess');
            Route::post('membership/update', 'ClientsController@updateMembership');
            Route::post('{id}/membership/delete', 'ClientsController@deleteMembership');
            Route::post('membership/makeup', 'ClientsController@setMembershipEpic');
            Route::get('membership/services','ClientsController@getMembService');

            Route::patch('{id}/sales-process-settings', 'ClientsController@salesProcSettings')->name('clients.salesProcSett');

            Route::post('movement/save', 'MovementController@store');
            Route::get('movement/edit/{id}', 'MovementController@edit');
            Route::post('movement/update/{id}', 'MovementController@update');
            Route::post('movement/steps', 'MovementController@updateMovementSteps');
            Route::delete('movement/{id}', 'MovementController@destroy')->name('movement.destroy');
            Route::post('{clientId}/menues/', 'ClientsController@saveMenues')->name('menu.save');

            Route::post('save/measurement', 'MeasurementFileController@saveFile');
            Route::get('edit/measurement/{id}', 'MeasurementFileController@editFile');
            Route::get('download/measurement/{id}', 'MeasurementFileController@downloadFile');
            Route::get('delete/measurement/{id}', 'MeasurementFileController@deleteFile');
        });  

        Route::group([ 'prefix' => 'muscles/', 'middleware' => ['web', 'auth'], 'as' => 'muscle.'], function()
        {
    		Route::get('',[MuscleController::class,'index'])->name('list');
    		Route::get('create',[MuscleController::class,'create'])->name('create');
    		Route::get('edit/{id}',[MuscleController::class,'edit'])->name('edit');
            Route::get('view/{id}',[MuscleController::class,'view'])->name('view');
    		Route::post('store',[MuscleController::class,'store'])->name('store');
    		Route::post('update/{id}',[MuscleController::class,'update'])->name('update');
    		Route::any('delete/{id}',[MuscleController::class,'delete'])->name('delete');
        }); 

        
        Route::any('excel-to-db', 'FileController@importExcelIntoDB')->name('excel.import');

    });


/**
 * Frontend Access Controllers
 */
Route::group(['namespace' => 'Frontend\Auth'], function () {

    /**
     * These routes require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'AuthController@logout')->name('auth.logout');

        // Change Password Routes
        Route::get('password/change', 'PasswordController@showChangePasswordForm')->name('auth.password.change');
        Route::post('password/change', 'PasswordController@changePassword')->name('auth.password.update');
    });

    /**
     * These routes require the user NOT be logged in
     */
    Route::group(['middleware' => 'guest'], function () {

        // Registration Routes
        Route::get('register', 'AuthController@showRegistrationForm')
            ->name('auth.register');
        Route::post('register', 'AuthController@register');

        // Authentication Routes
      //  Route::get('login/{businessId?}', 'AuthController@showLoginForm')->name('auth.login');
        Route::get('login/{businessUrl?}','AuthController@showLoginForm')->name('auth.login');
        /*Route::get('{businessUrl?}','AuthController@showLoginForm')->name('auth.login');*/
        Route::post('login', 'AuthController@login')->name('auth.doLogin');
        Route::post('checkuser', 'AuthController@checkUserType');

        // Socialite Routes
        Route::get('login/{provider}', 'AuthController@loginThirdParty')
            ->name('auth.provider');
        //Route::get('index', 'FrontendController@index')->name('frontend.index');

        // Confirm Account Routes
        Route::get('account/confirm/{token}', 'AuthController@confirmAccount')
            ->name('account.confirm');
        Route::get('account/confirm/resend/{token}', 'AuthController@resendConfirmationEmail')
            ->name('account.confirm.resend');

        // Password Reset Routes
        Route::get('password/reset/{token?}', 'PasswordController@showResetForm')
            ->name('auth.password.reset');
        Route::post('password/forgot', 'PasswordController@sendResetLinkEmail')->name('password.forgot');
        Route::post('password/reset', 'PasswordController@reset')->name('password.reset');
    });
});
?>
