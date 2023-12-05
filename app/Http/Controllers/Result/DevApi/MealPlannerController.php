<?php

namespace App\Http\Controllers\DevApi;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MpUsers;



class MealPlannerController extends Controller {



 
    public function CreateAnonymousAccount(Request $request) {
        	
        	$in_data = [];
        	$response = [];
        	$response['message'] = "no email ID found.";
        	$email = \Request::get('email');
        	
        	if(!empty($email))
        	{
        		$user_detail = MpUsers::where('email',$email)->get();
        		
        		if($user_detail->count() > 0)
        		{
        			$response['message'] = 'already exists.';
        		}
        		else
        		{
        			$in_data['email'] = $email;
	        		$in_data['created_at'] = Carbon::now();
	        		$in_data['updated_at'] = Carbon::now();

	        		// dd($in_data);
					if($user_id = MpUsers::insertGetId($in_data))
					{
						$response['id'] = $user_id;
						$response['message'] = 'insert';

					}	
        		}
        		        		
        	}
    		return json_encode($response);

    }

    public function AddItemToShoppingList(Request $request)
    {
    	
    }

		

}
