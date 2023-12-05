<?php

namespace App\Http\Controllers\MealPlanner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
use View;
use App\Models\MpClientMealplan;
use App\Models\ShoppingList;

class ShoppingListController extends Controller {

    /**
     * Retrive Shopping Category list.
     *
     * @param String  
     * @return Ingrediant list
     */
   

    public function index(Request $request){
        $clientId = Auth::user()->account_id;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $view = $request->view;
        $shoppinglists = array();
        $foods = array();

        $onlyShoppingList = ShoppingList::where('client_id',$clientId)
                          ->where('start_date',$startDate)
                          ->where('end_date', $endDate)
                          ->whereNull('deleted_at')
                          ->whereNull('purchased_date')
                          ->get();
        $shoppingNewData = ShoppingList::where('client_id',$clientId)->where('start_date',$startDate)->where('end_date', $endDate)->whereNull('deleted_at')->get();
        $html = View::make('mealplanner.shopping.shopping-modal',compact('shoppingNewData','startDate','endDate','clientId','onlyShoppingList'));
        $data['html'] = $html->render();

        return response()->json($data);       
    }
    
    public function update(Request $request){
        foreach($request->shoppingData as $key => $value){
           $checkData = ShoppingList::where('client_id',$request->clientId)
                        ->where('rec_name',$value['name'])
                        ->where('start_date',$request->startDate)
                        ->where('end_date', $request->endDate)
                        ->where('id', $value['shopping_id'])   // add new for detail page                
                        ->whereNull('deleted_at')
                        ->first();
   
           if( $checkData ){
            
           $checkData->update(['puchased_quan'=> $value['quantity'], 'purchased_date' =>now()]);
           }
        
        }
        $msg = 'Quantity Successfully Updated';
        return $msg;
            
    }

    public function fractionToDecimal($fraction) 
        {
            // Split fraction into whole number and fraction components
            preg_match('/^(?P<whole>\d+)?\s?((?P<numerator>\d+)\/(?P<denominator>\d+))?$/', $fraction, $components);

            // Extract whole number, numerator, and denominator components
            $whole = $components['whole'] ?: 0;
            $numerator = $components['numerator'] ?: 0;
            $denominator = $components['denominator'] ?: 0;

            // Create decimal value
            $decimal = $whole;
            $numerator && $denominator && $decimal += ($numerator/$denominator);

            return $decimal;
        }
      
   
        public function convert_decimal_to_fraction($fraction) {
            $base = floor($fraction);
            $fraction -= $base;
            if( $fraction == 0 ) return $base;
            list($ignore, $numerator) = preg_split('/\./', $fraction, 2);
            $denominator = pow(10, strlen($numerator));
            $gcd =$this->gcd($numerator, $denominator);
            $fraction = ($numerator / $gcd) . '/' . ($denominator / $gcd);
            if( $base > 0 ) {
              return $base . ' ' . $fraction;
            } else {
              return $fraction;
            }        
          }
        public function gcd($a,$b) {
            return ($a % $b) ? $this->gcd($b,$a % $b) : $b;
          }


      /* shopping delete */
     public function deleteShopping(Request $request){
         $delete = ShoppingList::whereIn('id',$request->id)->delete();
          if($delete){
            $response['status'] = 'success';
            return \Response::json($response); 
          }
     }

}
