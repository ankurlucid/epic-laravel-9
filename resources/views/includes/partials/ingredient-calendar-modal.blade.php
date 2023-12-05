<style type="text/css">
    
     .recipe__list--ingredients ul {
    padding-left: 20px;
}
</style>
<ul>
    <li>
        <label for="select-all" class="checkbox-list">
            <input class="popup-checkbox-list-input" type="checkbox" id="select-all" data-id="{{$meal_detail->id}}">
            <span class="checkbox-list-checkmark" style="display: inline-block;">
                <span class="recipe__list-qty">
                    <span class="ingr1-qty">Select All</span>
                </span>
            </span>
        </label>
    </li>
</ul>
<hr>
<input id="cat-id" value="{{ isset($requestData['cat']) ? $requestData['cat'] : '' }}" hidden>
<input id="snack-type" value="{{ isset($requestData['snackType']) ? $requestData['snackType'] : '' }}" hidden>
<input id="meal_date" value="{{ isset($requestData['date']) ? $requestData['date'] : '' }}" hidden>
<input id="recipe-title" value="{{ isset($requestData['title']) ? $requestData['title'] : '' }}" hidden>
@php
    if($meal_detail->ingredient_set_no != 1){
        $set_name = json_decode($meal_detail->ingredient_set_name);
    }
@endphp
<ul>
    @if(($meal_detail->ingredient_set_no != 1) && isset($set_name))
       <li class="recipe__list-subheading">{{$set_name->set_name_1}}:</li>
    @endif
    {{-- <li class="recipe__list-subheading">For the Lacinato kale and fresh mint salad:</li> --}}
    @if(count($meal_detail->mealIngredientSetPart1) > 0)
     @foreach($meal_detail->mealIngredientSetPart1 as $key => $ingr_val_1)
        <li>
            <label for="recipe-ingredients-popup-{{$key}}" class="checkbox-list checkbox-popup-list1">
                <input class="popup-checkbox popup-checkbox-list-input popup-checkbox-{{$meal_detail->id}}" value="{{$ingr_val_1->id}}" type="checkbox"
                    id="recipe-ingredients-popup-{{$key}}">
                <span class="checkbox-list-checkmark" style="display: inline-block;">
                    <span class="recipe__list-qty">
                        <span class="ingr1-popup-qty-{{$key}}">@if($ingr_val_1->qty != 0){{$ingr_val_1->qty}}@endif</span>  {{$ingr_val_1->measurement??''}}
                    </span>
                    {{$ingr_val_1->item??''}}<br>
                </span>
            </label>
        </li>
        @endforeach
    @endif
</ul>
<ul>
    @if(($meal_detail->ingredient_set_no != 1) && isset($set_name))
        <li class="recipe__list-subheading">{{$set_name->set_name_2}}:</li>
    @endif
    @if(count($meal_detail->mealIngredientSetPart2) > 0)
        @foreach($meal_detail->mealIngredientSetPart2 as $key2 => $ingr_val_2)
            <li>
                <label for="recipe-ingredients-popup-2-{{$key2}}" class="checkbox-list checkbox-popup-list2">
                    <input class="popup-checkbox popup-checkbox-list-input popup-checkbox-{{$meal_detail->id}}" value="{{$ingr_val_2->id}}" type="checkbox"
                        id="recipe-ingredients-popup-2-{{$key2}}">
                    <span class="checkbox-list-checkmark" style="display: inline-block;">
                        <span class="recipe__list-qty">
                            <span class="ingr2-popup-qty-{{$key2}}">@if($ingr_val_2->qty != 0){{$ingr_val_2->qty}}@endif</span> {{$ingr_val_2->measurement??''}}
                        </span>
                        {{$ingr_val_2->item??''}}<br>
                    </span>
                </label>
            </li>   
        @endforeach
    @endif 
</ul>