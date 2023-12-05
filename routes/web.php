<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helper;
use App\Http\Controllers\Setings\Business\BusinessController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('photo/capture-save-meal','Helper@uploadCaptureFileMeal');
Route::any('photo/save-mucle','Helper@uploadMuscle')->name('muscle.upload_image');
Route::post('client/photo/save','ClientsController@uploadFile');

if(\Request::getHost() != 'update.epictrainer.com' ){

    // $currHost = 'crm';
    include('epictrainer.php');
    $middlewares = ['web', 'auth', 'member','attendence'];

}else{

    // $currHost = 'result';
    include('epicresult.php');
    $middlewares = ['web', 'auth'];

}

Route::group(['middleware' => $middlewares], function () {

	Route::group(['prefix' => 'meal-planner', 'namespace' => 'MealPlanner'], function() {
	    
	    Route::get('meals/download/{id}', 'MealPlannerController@download')->name('meals.download');
       	Route::post('ingredient-meal','MealPlannerController@analyzeIngredientMeal');

	    // Recipes Routes
	    Route::get('/recipes', 'MealPlannerController@allRecipe')->name('recipes.list');
	    Route::get('/recipe-details/{id}', 'MealPlannerController@recipeDetail')->name('recipes.details');
	    Route::get('/recipes/{filtersuggestion}', 'MealPlannerController@searchFilterSuggestion')->name('recipes.filtersuggestion');
	    Route::get('/calendar-filter', 'MealPlannerController@searchFilterSuggestionCalendar')->name('recipes.calendarfilter');

	     /* review */
	    Route::post('/post-review', 'MealReviewController@postReview')->name('review.post');
	    Route::post('/post-reply', 'MealReviewController@postReply')->name('reply.post');
	    Route::post('/upvote', 'MealReviewController@upvote')->name('reply.upvote');
	    Route::post('/post-rating', 'MealReviewController@starRating')->name('review.post_rating');
	    Route::post('/review-filter', 'MealReviewController@reviewFilter');

	      Route::post('remove/image','MealPlannerController@removeImage');
         Route::post('ingredients','MealPlannerController@analyzeIngredients');

	    // Meal Planner Calendar
		Route::group(['prefix'=>'calendar'], function(){
	        Route::get('', 'MealCalendarController@show')->name('meal_planner.calendar');
	        Route::post('store', 'MealCalendarController@store');
	        Route::post('update', 'MealCalendarController@update');
	        Route::get('event/{id}', 'MealCalendarController@edit');
	    
	        Route::get('getEvent', 'MealCalendarController@getEvents'); 
	        Route::get('meallist', 'MealCalendarController@getMealList');
	        Route::get('foodlist', 'MealCalendarController@getFoodList');
	        Route::get('meal/{id}', 'MealCalendarController@getMeal')->name('meal_planner.calendar.get_meal');
	        Route::get('food/{id}', 'MealCalendarController@getFood');
	        Route::post('delete-event','MealCalendarController@deleteEvent');


	        Route::post('ingredient/{id}','MealCalendarController@ingredientModalShow');
	    });

	    Route::get('meals', 'MealPlannerController@index')->name('meals.index');
        Route::get('validate-meal-name', 'MealPlannerController@validateName');
	     Route::get('meals/create', 'MealPlannerController@create')->name('meals.create');
        Route::post('meals/store', 'MealPlannerController@store')->name('meals.store');
	    Route::get('meals/edit/{id}', 'MealPlannerController@edit')->name('meals.edit');
        Route::post('meals/update/{id}', 'MealPlannerController@update')->name('meals.update');
        Route::delete('meals/delete/{id}', 'MealPlannerController@delete')->name('meals.destroy');
        Route::get('meal/{id}', 'MealPlannerController@show')->name('meals.show');
        Route::get('getFoodList', 'MealPlannerController@foodNameListings');
        
        Route::get('tools/foods', 'MealToolsController@getFood');


	    /* Meal caledar routes */
        Route::post('/shopping-list-ingredients', 'MealPlannerController@saveShoppingList');
        Route::post('/detail-shopping-list', 'MealPlannerController@shoppingList');
        Route::post('/email-ingredient', 'MealPlannerController@emailIngredient');
        Route::post('/calender-shopping-list', 'MealPlannerController@shoppingList');

        /* Sopping list routes */
        Route::get('shopping-list', 'ShoppingListController@index');
        Route::post('update-shopping-list','ShoppingListController@update');
        Route::post('delete-shopping-list','ShoppingListController@deleteShopping');

	});

	Route::group(['prefix' => 'meal-categories', 'namespace' => 'MealPlanner'], function(){
        Route::get('','MealCategoryController@index')->name('meal.getCat');
        Route::post('','MealCategoryController@save');
        Route::delete('{id}','MealCategoryController@destroy');
    });
});

Route::post('photo/save',[Helper::class,'uploadFile'])->name('form.uploadFile');
Route::post('business/photo/save',[BusinessController::class,'uploadFile']);


/**
 * Super Admin Routess
 */
Route::group(['prefix' => 'epic-super-admin','namespace' => 'SuperAdmin','middleware' => ['web']], function(){
    Route::get('login','LoginController@showLoginForm')->name('superadmin.login');
    Route::post('login','LoginController@authenticate')->name('superadmin.authenticate');
    Route::get('logout','LoginController@logout')->name('superadmin.logout');
    Route::group(['middleware' => ['superAdminAuth']], function(){
        Route::get('dashboard','SuperAdminController@dashboard')->name('superadmin.dashboard');
        Route::get('business-accounts','BusinessAccountController@index')->name('superadmin.businessAccount.index');
         Route::get('business-accounts/edit/{id}','BusinessAccountController@edit')->name('superadmin.businessAccount.edit');
        Route::post('business-accounts/edit/{id}','BusinessAccountController@update')->name('superadmin.businessAccount.update');
        Route::get('business-accounts/delete/{id}','BusinessAccountController@delete')->name('superadmin.businessAccount.delete');
        Route::get('business-accounts/view/{id}','BusinessAccountController@view')->name('superadmin.businessAccount.view');
        Route::get('business-accounts/send-confirmation-mail/{id}','BusinessAccountController@sendConfirmationEmail')->name('superadmin.businessAccount.sendConfirmationEmail');
        Route::resource('users-limit','UsersLimitController');
        Route::get('users-limit/delete/{id}','UsersLimitController@destroy')->name('users-limit.delete');
    });
});


Route::group(['prefix' => 'my-profile', 'namespace' => 'Frontend\Auth', 'middleware' => 'auth'], function(){
    Route::get('', 'AuthController@show')->name('auth.show');
    Route::patch('', 'AuthController@update')->name('auth.update');
    Route::post('update-field','AuthController@updateField');
});

