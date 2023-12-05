<?php 
	
    Route::group(['namespace'=>'\App\Http\Controllers\Result','middleware' => ['web']], function () {

	    Route::get('/client-login', 'UserController@loginMob')->name('result.loginMob');
	    Route::get('/', 'UserController@homePage')->name('result.home');

	    Route::get('login/{businessUrl?}', 'UserController@index')->name('login');
	    Route::post('login', 'UserController@login');
	    Route::post('check-client','UserController@checkClient');

        Route::get('header-notifications', 'HeaderNotificationController@index');
	});

    Route::group(['namespace'=>'\App\Http\Controllers\Result','middleware' => ['web', 'auth', 'updateTimezone']], function () {

        Route::get('logout', 'UserController@logout');

    	Route::group(['prefix' => 'new-dashboard'], function() {
            Route::get('', 'DashboardController@show')->name('dashboard');
            Route::get('app-section/data', 'DashboardController@getAppSectionData');
            Route::get('app-section/week-data', 'DashboardController@getAppSectionWeekData');
        });

    	/**
         * Clients Personal Statistics Routes
         */
        Route::post('store-sleep-data','PersonalStatisticController@storeSleepData');
        Route::post('store-statistics-data','PersonalStatisticController@storeData');
        Route::post('store-weight-data','PersonalStatisticController@storeWeight');
        Route::get('get-statistics-data','PersonalStatisticController@getData');
        Route::post('store-nutritional-data','PersonalStatisticController@saveNutritionalData');
        Route::post('store-hydration-data','PersonalStatisticController@saveHydrationData');
        Route::post('update-hydration-data','PersonalStatisticController@updateHydrationData');
        Route::get('get-statistics-data-height','PersonalStatisticController@getDataHeight');

        Route::get('goals/calendar', ['as' => 'goals.calendar', 'uses' => 'GoalBuddyCalendarController@index']);

        Route::group(['prefix' => 'social'], function() {
                   
            Route::get('home', 'SocialNetworkController@index')->name('social.index');
            Route::get('direct/message', 'SocialNetworkController@direct_message')->name('social.direct_message');
            Route::get('add/friend/{id}', 'SocialNetworkController@add_friend');
            Route::get('cancel/friend/{id}', 'SocialNetworkController@cancel_friend');
            Route::get('reject/friend/{id}', 'SocialNetworkController@reject_friend');
            Route::get('confirm/friend/{id}', 'SocialNetworkController@confirm_friend');
            Route::get('search/friend', 'SocialNetworkController@index')->name('search.all_list');
            Route::get('my/friend/{id}', 'SocialNetworkController@index')->name('social.my_friend');
            Route::post('update-profile', 'SocialNetworkController@update_profile');
            Route::post('filter/my/friend', 'SocialNetworkController@filter_my_friend');
            Route::post('filter/requested/friend', 'SocialNetworkController@filter_requested_friend');
            Route::post('filter/sended/friend', 'SocialNetworkController@filter_sended_friend');
            Route::post('cover/image', 'SocialNetworkController@coverImage');
            Route::post('profile/image', 'SocialNetworkController@profileImage');
            Route::post('privacy', 'SocialNetworkController@privacy');
           
            Route::get('messages', 'SocialNetwork\MessageController@all_message')->name('social.all_message');
            
            Route::get('post/preview/{id}', 'SocialNetworkController@postPreview');

            Route::group(['prefix' => 'post', 'namespace'=>'SocialNetwork'], function() {
                Route::post('store', 'PostController@store')->name('post.store');
                Route::post('like', 'PostController@like')->name('post.like');
                Route::get('delete/{post_id}', 'PostController@delete')->name('post.delete');
                Route::post('comment', 'PostController@comment')->name('post.comment');
                Route::get('single_comment', 'PostController@single_comment')->name('post.single_comment');
                Route::get('detail/{post_id}', 'PostController@single_post')->name('post.single_post');
                Route::post('comment/delete', 'PostController@delete_comment')->name('post.delete_comment');
                Route::post('update/comment', 'PostController@update_comment')->name('post.update_comment');
                Route::post('update/{post_id}', 'PostController@update_post')->name('post.update_post'); 
                Route::post('user-likes', 'PostController@likes')->name('post.user_likes');
                // Route::get('image/delete/{post_id}', 'PostController@delete_image')->name('post.delete_image');
                Route::post('image/delete', 'PostController@delete_image')->name('post.delete_image');
                Route::get('video/delete/{post_id}', 'PostController@delete_video')->name('post.delete_video');
                Route::post('search_friend', 'PostController@search_friend')->name('post.friends');
                  
                Route::get('show_all_comment/{id}', 'PostController@show_all_comment')->name('post.show_all_comment');
                // Route::get('edit/{post_id}', 'PostController@edit_post')->name('post.edit_post'); 
             });

            Route::group(['prefix' => 'direct-message', 'namespace'=>'SocialNetwork'], function() {
                 Route::post('search/friend', 'MessageController@search')->name('message.search');
                 Route::post('people-list', 'MessageController@people_list')->name('message.people-list');     
                 Route::post('chat', 'MessageController@chat')->name('message.chat');
                 Route::post('send', 'MessageController@send')->name('message.send');
                 Route::post('sendFile', 'MessageController@sendFile')->name('message.sendFile');
                 Route::post('delete', 'MessageController@delete_message')->name('message.delete');
                 Route::post('new-messages', 'MessageController@new_messages')->name('message.new');
                 Route::post('contact', 'MessageController@filter_contact');

                 Route::post('chat-list', 'MessageController@chat_list'); // chat page
                 Route::post('single_chat/{id}', 'MessageController@single_chat');  
            });
        });

        /* Start: Goal buddy routes */
        Route::group(['namespace'=>'\App\Http\Controllers\GoalBuddy'], function(){
            Route::get('goal-buddy/goal-listing','GoalBuddyController@goalListing')->name('goal-buddy.goallisting');
            Route::get('goals', 'GoalBuddyController@index')->name('goals.goallisting');

            Route::get('goal-buddy','GoalBuddyController@index')->name('goal-buddy');

            Route::get('goal-buddy/create-old','GoalBuddyController@create_old')->name('goal-buddy.create-old');
            Route::get('goal-buddy/loadfirststep','GoalBuddyController@loadFirstStep');

            Route::post('goal-buddy/editgoaldetails','GoalBuddyController@editGoaldetails');

            Route::get('goal-buddy/load-friend-list','GoalBuddyController@friendDataForAutoComplete');
            Route::get('goal-buddy/load-habit-data','GoalBuddyController@getHabitDataGoal');
            Route::get('goal-buddy/load-custom-habit-step','GoalBuddyController@loadCustomHabitStep');
            Route::get('goal-buddy/load-custom-task-list','GoalBuddyController@loadCustomTaskList');
            Route::get('goal-buddy/load-custom-milestone-list','GoalBuddyController@loadCustomMilestoneList');
            Route::post('goal-buddy/load-form-data','GoalBuddyController@getDataFromSession');
            Route::get('goal-buddy/load-custom-task-step','GoalBuddyController@loadCustomTaskStep');
            Route::get('goal-buddy/load-final-step','GoalBuddyController@loadFinalStep');

            Route::get('goal-buddy/create','GoalBuddyController@create')->name('goal-buddy.create');
            Route::get('goal-buddy/edit-old/{id}', 'GoalBuddyController@fetchdataforsteponeedit')->name('goal-buddy.edit');
            Route::get('goal-buddy/fetch/{id}', 'GoalBuddyController@fetchdataforsteponeedit'); // 06--07-2021
            Route::get('goal-buddy/edithabit/{id}', 'GoalBuddyController@edithabit')->name('goal-buddy.edithabit');
            Route::get('goal-buddy/editgoal/{id}', 'GoalBuddyController@editgoal')->name('goal-buddy.editgoal');
            Route::get('goal-buddy/edittask/{id}', 'GoalBuddyController@edittask')->name('goal-buddy.edittask');
            Route::get('goal-buddy/editmilestone/{id}', 'GoalBuddyController@editmilestone')->name('goals.editmilestone');

            # Get goal template details
            Route::get('goal-buddy/template/{id}', 'GoalBuddyController@getGoalTemplate');
            
            Route::get('goal-buddy/goal-print','GoalBuddyController@goalPrint')->name('goal-buddy.print');
            Route::get('goal-buddy/{viewName}','GoalBuddyController@openView');
            Route::post('goal-buddy/checkgoalform','GoalBuddyController@checkGoalForm');
            Route::post('goal-buddy/savegoal','GoalBuddyController@store');
            Route::post('goal-buddy/savegoal-new','GoalBuddyController@storeNew')->name('goal-save-new');

            Route::post('goal-buddy/updategoal','GoalBuddyController@update');
            Route::post('goal-buddy/insert-metadata','GoalBuddyController@storeMetaData');
            Route::post('goal-buddy/deletegoal','GoalBuddyController@delete');
            Route::post('goal-buddy/deletemilestones','GoalBuddyController@deletemilestones');
            Route::post('goal-buddy/updatemilestones','GoalBuddyController@updatemilestones');
            Route::post('goal-buddy/deletehabit','GoalBuddyController@deletehabit');
            Route::post('goal-buddy/showhabit','GoalBuddyController@showhabit');
            Route::post('goal-buddy/deletetask','GoalBuddyController@deletetask');
            Route::post('goal-buddy/showtask','GoalBuddyController@showtask');
            Route::post('goal-buddy/showmilestone','GoalBuddyController@showmilestone');
            Route::post('goal-buddy/deletemilestone','GoalBuddyController@deletemilestone');
            Route::get('showcalendar', 'GoalBuddyCalendarController@index')->name('goal-buddy.showcalendar');
            Route::get('showgoalactivity', 'GoalBuddyCalendarController@show');
            Route::post('manage-status', 'GoalBuddyCalendarController@statusChange');
            Route::post('goal-buddy/get-listing-task','GoalBuddyController@getTaskUpdate');
            Route::post('goal-buddy/get-listing-goal','GoalBuddyController@getGoalUpdate');
            Route::post('search-goal','GoalBuddyController@searching')->name('searchingclientgoal');

            Route::post('goal-buddy/get-habit','GoalBuddyController@getHabit');
            Route::post('goal-buddy/get-task','GoalBuddyController@getTask');
            Route::post('goal-buddy/fetchdataforsteponeedit','GoalBuddyController@fetchdataforsteponeedit');
            Route::post('goal-buddy/get-listing-habit','GoalBuddyController@getHabitUpdate');
            Route::post('goal-buddy/get-listing-milestone','GoalBuddyController@getMilestoneUpdate');
            Route::post('goal-buddy/updategoalstatus','GoalBuddyController@updateGoalStatus');
            Route::post('goal-buddy/getAllHabit','GoalBuddyController@getAllHabit');
            Route::post('goal-buddy/checked-week-days','GoalBuddyController@checkedTaskWeek');
            Route::post('goal-buddy/update-habit-value','GoalBuddyController@updateHabitRecurrence');



        });
        /* End: Goal buddy routes */


        // Measurements Route
        Route::get('epic/measurements','ProfileController@showMeasurement')->name('epic.measurements');


        // Fasting Routes
        Route::get("fasting", 'IntermittentFastController@fastShow')->name('fasting');
        Route::get("fasting-form", 'IntermittentFastController@show');
        Route::post("fasting-save", 'IntermittentFastController@store');
        Route::post("override-confirm-popup", 'IntermittentFastController@overrideConfirmPopup');
        Route::post("get-all-protocol", 'IntermittentFastController@getAllProtocol');
        Route::get("fasting-history", 'IntermittentFastController@fastingHistory');
        Route::get("filter-fast-graph", 'IntermittentFastController@filterFastGraph');

        Route::get("/fasting-details", function(){return view("Result.fasting.fasting-details");});
        Route::get("/fasting-datetime-start", function(){return view("Result.fasting.fasting-datetime-start");});
        Route::get("/fasting-clock", function(){return view("Result.fasting.fasting-clock");});
        Route::get("/fasting-clock-controller",'FastingClockController@fastingClockHit')->name('fasting.clock');
        Route::post("/fasting-clock-controller-run-background",'FastingClockController@fastingClockRunBackground')->name('fasting.clock.fastingClockRunBackground');
        Route::post("/fasting-clock-start-save",'FastingClockController@saveFastClockStart' );
        Route::post("/fasting-cycle-end",'FastingClockController@fastingCycleEnd' );

        Route::get("/fasting-summary", function(){return view("Result.fasting.fasting-summary");});

        Route::get("/load-fasting-summary",'FastingClockController@loadFastingSummary');
        Route::post("/save-fasting-summary",'FastingClockController@fastingSummarySave' );
        Route::post("/update-start-time",'FastingClockController@updateStartTime' );
        Route::post("/pre-end-fast",'FastingClockController@preEndFast' );
        Route::post("/pre-end-eating",'FastingClockController@preEndEating' );
        Route::get("/get-mood-data-prev",'FastingClockController@getMoodDataPrev');
        Route::get("/get-mood-history",'FastingClockController@getMoodData');

        Route::get("/fasting-eating", function(){return view("Result.fasting.fasting-eating");});

        Route::get("/load-eating-summary",'FastingClockController@loadEatingSummary');
        Route::post("/save-eating-summary",'FastingClockController@eatingSummarySave' );
            
        // EDIT CHUNK DATA
        Route::post("get-chunk-fast-graph", 'IntermittentFastController@getChunkFastGraph')->name('getChunkFastGraph');
        Route::post("save-chunk-fast-graph", 'IntermittentFastController@saveChunkFastGraph')->name('save-chunk-fast-graph');

        // EDIT CUSTOM DATA
        Route::post("get-custom-fast-graph", 'IntermittentFastController@getCustomFastGraph')->name('getCustomFastGraph');
        Route::post("save-custom-fast-graph", 'IntermittentFastController@saveCustomFastGraph')->name('save-custom-fast-graph');

        Route::get("mood-history", function(){return view("Result.fasting.mood-history");});
        Route::get("fasting-setting", 'IntermittentFastController@fastingSetting');
        Route::get('fasting-setting-status','IntermittentFastController@settingStatus');
        Route::post('stop-cycle','IntermittentFastController@stopCycle');

    });

?>