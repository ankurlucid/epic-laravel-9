@if(isset($mealInfo))
{!! Form::model($mealInfo, ['method' => 'get', 'route' => ['meals.update', $mealInfo->id], 'id' => 'meal-form', 'class' => 'margin-bottom-30 meal_form_create_edit']) !!}
@else
{!! Form::open(['route' => ['meals.store'], 'id' => 'meal-form', 'class' => 'margin-bottom-30 meal_form_create_edit']) !!}
@endif
{!! Form::hidden('meal_id', isset($mealInfo)?$mealInfo->id:'') !!}
<div class="white-bg-wrapper swMain">
    <div class="row">
        <div class="col-md-6">
            <fieldset class="p-3">
                <legend>General</legend>
                <div class="form-group">
                    <label for="staff_id" class="strong">Staff *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left"><i class="fa fa-question-circle"></i></span>
                   {!! Form::select('staff_id',$staffs, isset($mealInfo)?$mealInfo->staff_id:null, ['class'=>'form-control onchange-set-neutral','id'=>'staff_id','required']) !!}
                    {!! $errors->first('staff_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group">
                    <label for="name" class="strong">Recipe Name *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left"><i class="fa fa-question-circle"></i></span>
                    {!! Form::text('name', isset($mealInfo)?$mealInfo->name:'', ['class'=>'form-control mealName','required']) !!}
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="description" class="strong">Recipe Description *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left"><i class="fa fa-question-circle"></i></span>
                    <textarea class="form-control" name="description" placeholder="Recipe Description"
                    required>{{ isset($mealInfo) ? $mealInfo->description : '' }}</textarea>

                    <span id="description" class="help-block" style="color: #a94442;display: none;"></span>
                </div>
            </fieldset>

            <fieldset class="padding-15">
                <legend>
                    Recipe Image
                </legend>
                <div class="form-group upload-group" id="image-area">
                    <div class="imgError hidden"> </div>
                    <div>
                        <label for="" class="strong">Upload Recipe Pictures *</label>
                        <span class="epic-tooltip tooltipstered" data-toggle="tooltip"><i
                                class="fa fa-question-circle"></i></span>
                        <span class="help-block" style="color: #a94442;"></span>

                    </div>
                    @if(isset($mealInfo) && $mealInfo->mealimages->count())
                    <?php $i = 1; ?>
                    @foreach($mealInfo->mealimages->take(1) as $mealimage)
                    <div class="set-error clone-image-row col-md-3 col-xs-6 remove-img btn-file">
                        <div class="img-row-design">
                            <label class="btn btn-img-uplode" style="margin:0px; padding:0px;">
                                <img class="image-uploder-img-style" src="{{ dpSrc($mealimage->mmi_img_name) }}" />
                                <span class="image-uploder-label-style remove-edit"><i class="fa fa-times"></i> Remove</span> 
                                <input type="file" class="hidden" onChange="fileSelectHandler(this)" accept="image/*">
                            </label>
                            <input type="hidden" name="mealPicture{{$i}}" value="{{ $mealimage->mmi_img_name }}">
                        </div>
                    </div>
                    <?php $i++; ?>
                    @endforeach
                    @endif
                    <div class="set-error clone-image-row col-md-3 col-xs-6 btn-file">
                        <input type="hidden" name="prePhotoName" value="" class="no-clear">
                        <input type="hidden" name="entityId" value="" class="no-clear">
                        <input type="hidden" name="saveUrl" value="" class="no-clear">
                        <input type="hidden" name="photoHelper" value="mealPicture" class="no-clear">
                        <input type="hidden" name="photoMeal" value="mealPopup" class="no-clear">
                        <input type="hidden" name="cropSelector" value="">

                        @if(isset($mealInfo) && $mealInfo->mealimages->count())
                            <div class="img-row-design  edit-image-div" >
                                <label class="btn btn-img-uplode" style="margin:0px; padding:0px;">
                                    <img name="thumb_image" class="mealPicturePreviewPics previewPics image-uploder-img-style" data-src="{{ asset('assets\images\no-image.jpg') }}" src="{{ asset('assets\images\no-image.jpg') }}" />
                                    <span class="image-uploder-label-style"><i class="fa fa-plus"></i> Add File</span> 
                                    <input type="file" class="hidden" onChange="fileSelectHandler(this)" accept="image/*">
                                </label>
                                <input type="hidden" name="mealPicture" value="">
                            </div>
                        @else
                        <div class="img-row-design">
                            <label class="btn btn-img-uplode" style="margin:0px; padding:0px;">
                                <img name="thumb_image"
                                    class="mealPicturePreviewPics previewPics image-uploder-img-style"
                                    data-src="{{ asset('assets\images\no-image.jpg') }}"
                                    src="{{ asset('assets\images\no-image.jpg') }}">
                                <span class="image-uploder-label-style"><i class="fa fa-plus"></i> Add
                                    File</span>
                                <input type="file" class="hidden" onchange="fileSelectHandler(this)"
                                    accept="image/*">
                            </label>
                            <input type="hidden" name="mealPicture" value="">
                        </div>
                        @endif

                    </div>
                </div>
            </fieldset>
            <fieldset class="padding-15">
                <legend>Recipe categories</legend>
                <div class="form-group">
                    <label for="category_id" class="strong">Recipe Categories *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left"><i class="fa fa-question-circle"></i></span>

                    <a href="{{ route('meal.getCat') }}" class="pull-right add-more" data-modal-title="Meal Categories"
                        data-field="meal-category">Manage Recipe Categories</a>

                    {!! Form::select('category_id', isset($mealsCategory)?$mealsCategory:[], isset($mealSlctCat)?$mealSlctCat:0, ['class'=>'form-control meal-category','id'=>'meal_cat','required','multiple']) !!}
                </div>
                {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}

            </fieldset>
            <fieldset class="padding-15">
                <legend>Serving Size</legend>
                <div class="form-group">
                    <label for="serves" class="strong">Serves *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left"><i class="fa fa-question-circle"></i></span>
                    
                    {!! Form::text('serves',isset($mealInfo)?$mealInfo->serves:'', ['class'=>'form-control ','required', 'id'=>"serves"]) !!}
                    {!! $errors->first('serves', '<p class="help-block">:message</p>') !!}

                    @if(isset($mealInfo))
                        @php
                           $prep_time = json_decode($mealInfo->time);
                           $cook_time = json_decode($mealInfo->cook_time);  
                        @endphp
                    @endif
                </div>
            </fieldset>
            <fieldset class="padding-15">
                <legend>Cuisine Type</legend>
                @foreach($main_cat as $key => $cat) 
                    <div class="form-group">
                        <label class="strong">{{$cat->name}}</label>
                        <select name="main_category_id[{{$cat->id}}]" multiple class="form-control">
                            <option value="0"> None </option> 
                            @foreach($cat['subCategory'] as $sub_cat)
                                @if(isset($mealInfo) && $mealInfo->mealMainCategory->count())
                                  <option  value="{{$sub_cat->id}}" @foreach($mealInfo->mealMainCategory as $fetch_val)  @if($fetch_val->main_category_id == $cat->id && $fetch_val->sub_category_id == $sub_cat->id)selected="selected"@endif @endforeach>{{$sub_cat->name}}</option>
                                @else
                                  <option  value="{{$sub_cat->id}}" >{{$sub_cat->name}}</option>
                                @endif
                            @endforeach    
                                  
                        </select>
                    </div>                
                @endforeach
            </fieldset>
            <fieldset class="padding-15">
                <legend>Ingredients Section</legend>
                @if(isset($mealInfo))
                @include('mealplanner.meal.edit-form')
                @else
                @include('mealplanner.meal.create-form')
                @endif            
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset class="padding-15 ">
                <legend>Nutrition Data </legend>
                <div class="panel-group meal_table_accordian" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">Nutritional table</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="headingOne" data-bs-parent="#accordion" style="">
                            <div class="panel-body">
                                <div class="">
                                    <table class="meallist" style="width: 100%;" border="1">
                                        <tbody>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Food</th>
                                                <th>Calories</th>
                                                <th>Weight</th>
                                            </tr>
                                            @if(isset($edamamIngredient) && count($edamamIngredient) > 0)
                                            @foreach($edamamIngredient as $table_data)
                                            <tr class="ingredient-table-tr">
                                                <td class="ingredient-qty">{{$table_data->qty}}</td>
                                                <td class="ingredient-measure">{{$table_data->unit}}</td>
                                                <td class="ingredient-item">{{$table_data->item}}</td>
                                                <td class="ingredient-calories">{{$table_data->calorie}}</td>
                                                <td class="ingredient-weight">{{$table_data->weight}}</td> 
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">Nutritional Information</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="headingTwo" data-bs-parent="#accordion">
                            <div class="panel-body">
                                <!-- Start: Nutrational Information -->
                                @if(isset($mealInfo))
                                @php
                                    $nutrationalInfo = json_decode($mealInfo->nutritional_information); 
                                    $nutrational_kcal = json_decode($mealInfo->nutrient_kcal);
                                    $nutrationalInfoPercentage = json_decode($mealInfo->nutritional_information_percentage); 
                                @endphp
                                @endif
                                <div class="nutrional-info">
                                    <div class="desk">
                                        <input hidden id="total_energ_kcal" name="total_energ_kcal" value="{{ isset($nutrational_kcal->total_energ_kcal) && $nutrational_kcal->total_energ_kcal != '0'? $nutrational_kcal->total_energ_kcal:'' }}" >
                                        <input hidden id="cal_from_protein" name="cal_from_protein" value="{{ isset($nutrational_kcal->cal_from_protein) && $nutrational_kcal->cal_from_protein != '0'? $nutrational_kcal->cal_from_protein:'' }}" >
                                        <input hidden id="cal_from_fat" name="cal_from_fat" value="{{ isset($nutrational_kcal->cal_from_fat) && $nutrational_kcal->cal_from_fat != '0'? $nutrational_kcal->cal_from_fat:'' }}" >
                                        <input hidden id="cal_from_carbohydrates" name="cal_from_carbs" value="{{ isset($nutrational_kcal->cal_from_carbs) && $nutrational_kcal->cal_from_carbs != '0'? $nutrational_kcal->cal_from_carbs:'' }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="energ_kcal"
                                                        class="strong">Calories</label>
                                                    <span class="epic-tooltip tooltipstered"
                                                        rel="tooltip" data-toggle="tooltip"
                                                        data-placement="left"><i
                                                            class="fa fa-question-circle"></i></span>
                                                    <input class="form-control nutritional-info" data-realtime="energ_kcal" name="energ_kcal" value="{{  isset($nutrationalInfo->energ_kcal) && $nutrationalInfo->energ_kcal != '0'?$nutrationalInfo->energ_kcal:'' }}" id="energ_kcal" type="text" placeholder="0">
                                                    <span id="energ_kcal" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="fat" class="strong">Fat </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="fat" name="fat" value="{{ isset($nutrationalInfo->fat) && $nutrationalInfo->fat != '0'?$nutrationalInfo->fat:''}}" id="fat" type="text" placeholder="0">
                                                    <span id="fat" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="fa_sat" class="strong">Saturated Fat
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="fa_sat" name="fa_sat" value="{{isset($nutrationalInfo->fa_sat) && $nutrationalInfo->fa_sat != '0'?$nutrationalInfo->fa_sat:''}}" id="fa_sat" type="text" placeholder="0">
                                                    <span id="fa_sat" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="carbohydrate"
                                                            class="strong">Carbohydrate</label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="carbohydrate" name="carbohydrate" value="{{ isset($nutrationalInfo->carbohydrate) && $nutrationalInfo->carbohydrate != '0'?$nutrationalInfo->carbohydrate:'' }}" id="carbohydrate" type="text" placeholder="0">
                                                    <span id="carbohydrate" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="sugar" class="strong">Sugar
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="sugar" name="sugar" value="{{ isset($nutrationalInfo->sugar) && $nutrationalInfo->sugar != '0'?$nutrationalInfo->sugar:'' }}" id="sugar" type="text" placeholder="0">
                                                    <span id="sugar" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="sodium" class="strong">Sodium
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="sodium" name="sodium" value="{{ isset($nutrationalInfo->sodium) && $nutrationalInfo->sodium != '0'?$nutrationalInfo->sodium:'' }}" id="sodium" type="text" placeholder="0">
                                                    <span id="sodium" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="fiber" class="strong">Fiber</label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="fiber" name="fiber" value="{{ isset($nutrationalInfo->fiber) && $nutrationalInfo->fiber != '0'?$nutrationalInfo->fiber:''}}" id="fiber" type="text" placeholder="0">
                                                    <span id="fiber" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="protein" class="strong">Protein </label>
                                                    <span class="epic-tooltip tooltipstered"
                                                        rel="tooltip" data-toggle="tooltip"
                                                        data-placement="left"><i
                                                            class="fa fa-question-circle"></i></span>
                                                    <input class="form-control nutritional-info" data-realtime="protein" name="protein" value="{{ isset($nutrationalInfo->protein) && $nutrationalInfo->protein != '0'?$nutrationalInfo->protein:'' }}" id="protein" type="text" placeholder="0">
                                                    <span id="protein" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="cholesterol"
                                                            class="strong">Cholesterol </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="cholesterol" name="cholesterol" value="{{ isset($nutrationalInfo->cholesterol) && $nutrationalInfo->cholesterol != '0'?$nutrationalInfo->cholesterol:'' }}" id="cholesterol" type="text" placeholder="0">
                                                    <span id="cholesterol" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="vitamin" class="strong">Vitamin
                                                            D</label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="vitamin" name="vitamin" value="{{ isset($nutrationalInfo->vitamin) && $nutrationalInfo->vitamin != '0'?$nutrationalInfo->vitamin:'' }}" id="vitamin" type="text" placeholder="0">
                                                    <span id="vitamin" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="calcium" class="strong">Calcium
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="calcium" name="calcium" value="{{ isset($nutrationalInfo->calcium) && $nutrationalInfo->calcium != '0'?$nutrationalInfo->calcium:'' }}" id="calcium" type="text" placeholder="0">
                                                    <span id="calcium" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="iron" class="strong">Iron </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="iron" name="iron" value="{{ isset($nutrationalInfo->iron) && $nutrationalInfo->iron != '0'?$nutrationalInfo->iron:'' }}" id="iron" type="text" placeholder="0">
                                                    <span id="iron" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="potassium" class="strong">Potassium
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="potassium" name="potassium" value="{{ isset($nutrationalInfo->potassium) && $nutrationalInfo->potassium != '0'?$nutrationalInfo->potassium:'' }}" id="potassium" type="text" placeholder="0">
                                                    <span id="potassium" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div>
                                                        <label for="trans_fat" class="strong">Trans Fat
                                                        </label>
                                                        <span class="epic-tooltip tooltipstered"
                                                            rel="tooltip" data-toggle="tooltip"
                                                            data-placement="left">
                                                            <i class="fa fa-question-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control nutritional-info" data-realtime="trans_fat" name="trans_fat" value="{{ isset($nutrationalInfo->trans_fat) && $nutrationalInfo->trans_fat != '0'?$nutrationalInfo->trans_fat:'' }}" id="trans_fat" type="text" placeholder="0">
                                                    <span id="trans_fat" class="help-block" style="color: #a94442;display: none;" ></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End: Nutrational Information -->
                                    </div>
                                </div>
                                <div class="nutrional-info-percentage" style="display: none">
                                    <div class="desk">                                     
                                        <div class="row">
                                           <input class="form-control percentage-nutritional-info" data-realtime="percentage_energ_kcal" name="energ_kcal" value="{{  isset($nutrationalInfoPercentage->energ_kcal) && $nutrationalInfoPercentage->energ_kcal != '0'?$nutrationalInfoPercentage->energ_kcal:'' }}" id="percentage_energ_kcal" type="text">
                                           <input class="form-control percentage-nutritional-info" data-realtime="percentage_fat" name="fat" value="{{ isset($nutrationalInfoPercentage->fat) && $nutrationalInfoPercentage->fat != '0'?$nutrationalInfoPercentage->fat:''}}" id="percentage_fat" type="text">
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_fa_sat" name="fa_sat" value="{{isset($nutrationalInfoPercentage->fa_sat) && $nutrationalInfoPercentage->fa_sat != '0'?$nutrationalInfoPercentage->fa_sat:''}}" id="percentage_fa_sat" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_trans_fat" name="trans_fat" value="{{ isset($nutrationalInfoPercentage->trans_fat) && $nutrationalInfoPercentage->trans_fat != '0'?$nutrationalInfoPercentage->trans_fat:'' }}" id="percentage_trans_fat" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_cholesterol" name="cholesterol" value="{{ isset($nutrationalInfoPercentage->cholesterol) && $nutrationalInfoPercentage->cholesterol != '0'?$nutrationalInfoPercentage->cholesterol:'' }}" id="percentage_cholesterol" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_sodium" name="sodium" value="{{ isset($nutrationalInfoPercentage->sodium) && $nutrationalInfoPercentage->sodium != '0'?$nutrationalInfoPercentage->sodium:'' }}" id="percentage_sodium" type="text" >   
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_carbohydrate" name="carbohydrate" value="{{ isset($nutrationalInfoPercentage->carbohydrate) && $nutrationalInfoPercentage->carbohydrate != '0'?$nutrationalInfoPercentage->carbohydrate:'' }}" id="percentage_carbohydrate" type="text" >  
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_sugar" name="sugar" value="{{ isset($nutrationalInfoPercentage->sugar) && $nutrationalInfoPercentage->sugar != '0'?$nutrationalInfoPercentage->sugar:'' }}" id="percentage_sugar" type="text" >   
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_protein" name="protein" value="{{ isset($nutrationalInfoPercentage->protein) && $nutrationalInfoPercentage->protein != '0'?$nutrationalInfoPercentage->protein:'' }}" id="percentage_protein" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_vitamin" name="vitamin" value="{{ isset($nutrationalInfoPercentage->vitamin) && $nutrationalInfoPercentage->vitamin != '0'?$nutrationalInfoPercentage->vitamin:'' }}" id="percentage_vitamin" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_calcium" name="calcium" value="{{ isset($nutrationalInfoPercentage->calcium) && $nutrationalInfoPercentage->calcium != '0'?$nutrationalInfoPercentage->calcium:'' }}" id="percentage_calcium" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_iron" name="iron" value="{{ isset($nutrationalInfoPercentage->iron) && $nutrationalInfoPercentage->iron != '0'?$nutrationalInfoPercentage->iron:'' }}" id="percentage_iron" type="text" >                                                 
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_fiber" name="fiber" value="{{ isset($nutrationalInfoPercentage->fiber) && $nutrationalInfoPercentage->fiber != '0'?$nutrationalInfoPercentage->fiber:''}}" id="percentage_fiber" type="text" >
                                            <input class="form-control percentage-nutritional-info" data-realtime="percentage_potassium" name="potassium" value="{{ isset($nutrationalInfoPercentage->potassium) && $nutrationalInfoPercentage->potassium != '0'?$nutrationalInfoPercentage->potassium:'' }}" id="percentage_potassium" type="text" >
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" id="updateNutritionServe" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Nutritional Info As Per serves
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="headingThree" data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FeatureDefinitions"
                                                class="strong">Calories</label>
                                            <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                data-toggle="tooltip" data-placement="left"><i
                                                    class="fa fa-question-circle"></i></span>
                                            <input class="form-control nutritional-info" data-realtime="FeatureDefinitions" name="FeatureDefinitions" value="" id="energ_kcal_serve" type="text" placeholder="0">
                                            <span id="energ_kcal_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="fat_serve" class="strong">Fat </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="fat_serve" name="fat_serve" value="" id="fat_serve" type="text" placeholder="0">
                                            <span id="fat_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="fa_sat_serve" class="strong">Saturated Fat
                                                </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="fa_sat_serve" name="fa_sat_serve" value="" id="fa_sat_serve" type="text" placeholder="0">
                                            <span id="fa_sat_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="carbohydrate_serve"
                                                    class="strong">Carbohydrate</label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="carbohydrate_serve" name="carbohydrate_serve" value="" id="carbohydrate_serve" type="text" placeholder="0">
                                            <span id="carbohydrate_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="sugar_serve" class="strong">Sugar </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="sugar_serve" name="sugar_serve" value="" id="sugar_serve" type="text" placeholder="0">
                                            <span id="sugar_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="sodium_serve" class="strong">Sodium </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="sodium_serve" name="sodium_serve" value="" id="sodium_serve" type="text" placeholder="0">
                                            <span id="sodium_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="fiber_serve" class="strong">Fiber</label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="fiber_serve" name="fiber_serve" value="{{ isset($nutrationalInfo->fiber_serve) && $nutrationalInfo->fiber_serve != '0'?$nutrationalInfo->fiber_serve:''}}" id="fiber_serve" type="text" placeholder="0">
                                            <span id="fiber_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="protein_serve" class="strong">Protein </label>
                                            <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                data-toggle="tooltip" data-placement="left"><i
                                                    class="fa fa-question-circle"></i></span>
                                            <input class="form-control nutritional-info-serve" data-realtime="protein_serve" name="protein_serve" value="" id="protein_serve" type="text" placeholder="0">
                                            <span id="protein_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="cholesterol_serve" class="strong">Cholesterol
                                                </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="cholesterol_serve" name="cholesterol_serve" value="{{ isset($nutrationalInfo->cholesterol_serve) && $nutrationalInfo->cholesterol_serve != '0'?$nutrationalInfo->cholesterol_serve:'' }}" id="cholesterol_serve" type="text" placeholder="0">
                                            <span id="cholesterol_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="vitamin_serve" class="strong">Vitamin
                                                    D</label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="vitamin_serve" name="vitamin_serve" value="" id="vitamin_serve" type="text" placeholder="0">
                                            <span id="vitamin_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="calcium_serve" class="strong">Calcium </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="calcium_serve" name="calcium_serve" value="{{ isset($nutrationalInfo->calcium_serve) && $nutrationalInfo->calcium_serve != '0'?$nutrationalInfo->calcium_serve:'' }}" id="calcium_serve" type="text" placeholder="0">
                                            <span id="calcium_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="iron_serve" class="strong">Iron </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="iron_serve" name="iron_serve" value="{{ isset($nutrationalInfo->iron_serve) && $nutrationalInfo->iron_serve != '0'?$nutrationalInfo->iron_serve:'' }}" id="iron_serve" type="text" placeholder="0">
                                            <span id="iron_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="potassium_serve" class="strong">Potassium
                                                </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="potassium_serve" name="potassium_serve" value="" id="potassium_serve" type="text" placeholder="0">
                                            <span id="potassium_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="trans_fat_serve" class="strong">Trans Fat
                                                </label>
                                                <span class="epic-tooltip tooltipstered" rel="tooltip"
                                                    data-toggle="tooltip" data-placement="left">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control nutritional-info-serve" data-realtime="trans_fat_serve" name="trans_fat_serve" value="{{ isset($nutrationalInfo->trans_fat_serve) && $nutrationalInfo->trans_fat_serve != '0'?$nutrationalInfo->trans_fat_serve:'' }}" id="trans_fat_serve" type="text" placeholder="0">
                                            <span id="trans_fat_serve" class="help-block" style="color: #a94442;display: none;" ></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="padding-15 ">
                <legend>Time</legend>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4 col-md-4 pr-0">
                            <label for="time" class="strong">Prep Time *</label>
                            <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                                data-placement="left"><i class="fa fa-question-circle"></i></span>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <input type="number" name="prep_time_hrs" value="{{ isset($prep_time->prep_hrs) && $prep_time->prep_hrs?$prep_time->prep_hrs:''}}" placeholder="Hrs" min="0" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <input type="number" name="prep_time_mins" value="{{ isset($prep_time->prep_mins) && $prep_time->prep_mins?$prep_time->prep_mins:''}}" placeholder="Mins" min="0" max="60" class="form-control"> 
                        </div>
                    </div>
                    <span class="prep-time-error" style="color: red;display: none;">This field is required</span>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4 col-md-4 pr-0">
                            <label for="cook_time" class="strong">Cook Time *</label>
                            <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                                data-placement="left"><i class="fa fa-question-circle"></i></span>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <input type="number" min="0"  name="cook_time_hrs" value="{{ isset($cook_time->cook_hrs) && $cook_time->cook_hrs?$cook_time->cook_hrs:''}}" placeholder="Hrs" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <input type="number"min="0" max="60" name="cook_time_mins" value="{{ isset($cook_time->cook_mins) && $cook_time->cook_mins?$cook_time->cook_mins:''}}" placeholder="Mins" class="form-control"> 
                        </div>
                    </div>
                    <span class="cook-time-error" style="color: red;display: none;">This field is required</span>
                </div>
            </fieldset>
            <fieldset class="padding-15 ">
                <legend>Tips</legend>
                <div class="form-group">
                    <label for="tips" class="strong">Tips *</label>
                    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
                        data-placement="left">
                        <i class="fa fa-question-circle"></i>
                    </span>
                    <textarea class="form-control" name="tips" required>{{ isset($mealInfo)?$mealInfo->tips:'' }}</textarea>
                </div>
            </fieldset>
            <fieldset class="padding-15 ">
                <legend>Meal Listing</legend>
                <div class="form-group">
                    <div class="checkbox clip-check check-primary m-b-0">
                        <input name="listing_status" value="0" type="checkbox" id="listingStatus" {{isset($mealInfo) && $mealInfo->listing_status == \App\Models\MpMeals::HIDE?'checked':''}}>
                        <label for="listingStatus">
                            <strong>Remove meal from listing for client </strong>
                        </label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12">
            <div class="form-group padding-15">
                @if(isset($mealInfo))
                <button type="button" class="btn btn-primary btn-wide pull-right submit_meal"> <i class="fa fa-edit"></i> Update Recipe </button>
                @else
                <button type="button" class="btn btn-primary btn-wide pull-right submit_meal"> <i class="fa fa-plus"></i> Add Recipe </button>
                @endif
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}


<div id="myModalTips" class="modal fade    model-design" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Tips</strong></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
      </div>
      <div class="modal-body">

         <div class="row">
             <div class="col-md-12">
            <p>If an ingredient line is highlighted, we are not calculating the nutrition for it, so please try rewriting it:</p>
            <ul>
                <li>Always include quantity: "3 oz of butter cookies" is better than "butter cookies or tuilles"</li>
                <li>Shorten and simplify the line: "2 cans of garbanzo beans, drained" is better than "2-2 1/2 cans of washed and drained garbanzo beans"</li>
                <li>If oil is used for frying, indicate it in the ingredient line (add the words "for frying"), so we can calculate how much gets absorbed</li>
                <li>For stocks and broths, enter "stock" or "broth" in the recipe field, or we'll assume it's a soup</li>
            </ul>
        </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).ajaxStart(function(){
            $("#waitingShield").removeClass('hidden');
            $("#waitingShield").css('display','block');
        });
        $(document).ajaxComplete(function(){
        $("#waitingShield").addClass('hidden');
        $("#waitingShield").css('display','none');
        });
        $(document).on('change', '.ingredient_measurement_select_1', function() {
            if($(this).attr('data-id') != undefined){
                let name_measurement = "ingredient_measurement_value_1["+$(this).attr('data-id')+"]";
                $('input[name="'+name_measurement+'"]').attr('value', $(this).val());
            }    
        });

        $(document).on('change', '.ingredient_measurement_select_2', function() {
            if($(this).attr('data-id') != undefined){
                let name_measurement = "ingredient_measurement_value_2["+$(this).attr('data-id')+"]";
                $('input[name="'+name_measurement+'"]').attr('value', $(this).val());           
            }    
        });


    });
    
    $('.add').click(function () {
        let count_input;
         if($(this).hasClass('preparation-2')){
             let count_input = $('.preparation-2-input').length;
             console.log('2', count_input);
             let step = count_input + 1;
             $(this).parent().parent().children('.blockk:last').before(' <div class="blockk preparation-2-div"><label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step '+step+'</span></label><div class="transparent-bg"></div><textarea class="form-control steps forfocuss preparation-2-input" name="meal_preparation_2['+count_input+']"></textarea><span class="icon__remove remove preparation-2" data-step="'+ count_input +'" aria-label="Remove step"></span></div>');

            } 
        
            if($(this).hasClass('preparation-1')){
                let count_input = $('.preparation-1-input').length; 
                console.log('1', count_input);
                let step = count_input + 1;
                $(this).parent().parent().children('.blockk:last').before(' <div class="blockk preparation-1-div"><label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step '+step+'</span></label><div class="transparent-bg"></div><textarea class="form-control steps forfocuss preparation-1-input" name="meal_preparation_1['+count_input+']"></textarea><span class="icon__remove remove preparation-1" data-step="'+ count_input +'" aria-label="Remove step"></span></div>');  
            } 

         $('.forfocuss').focusin(function () {
         $(this).parent().addClass('css-czzpt7z');

     });
        $('.forfocuss').focusout(function () {
         $(this).parent().removeClass('css-czzpt7z');
     });
        $(document).ready(function() { 
            $(".forfocuss").focusout(function() { 
                if($(this).val()=='') { 
                      $(this).parent().removeClass('css-czzpt7z');  
                       
                }
                else {
                       $(this).parent().addClass('css-czzpt7z');
                    // If it is not blank.
                  
                }    
            }) .trigger("focusout");
        }); 
    });


     var measurement_array = <?php echo json_encode($measurement_array); ?>;
    $('.add-ingredient').click(function () {   
        
        // var measurement_array = <?php echo json_encode($measurement_array); ?>; 
        var html = '<option value=""> (none) </option>';
        for(var i = 0, len = measurement_array.length; i < len; ++i) {
              html += '<option value="' + measurement_array[i] + '">' + measurement_array[i] + '</option>';

            // html += '<option value="' + measurement_array[i].value + '">' + measurement_array[i].name + '</option>';
            
        }           
         if($(this).hasClass('ingredient-2')){
             let count = $('.ingredient-input-2').length;
             $(this).parent().parent().children('.recipes-form__fieldset:last').before('<div class="recipes-form__fieldset form-group ingredient-2-div"><div class="recipes-form__item"> <div class="css-1juasd6-container"> <label for="item10" class="css-v23pgw"> <span class="css-hlp6ko">Item</span> </label> <input placeholder=" " name="ingredient_item_2['+count+']" type="text" class="forfocuss form-control ingredient-item-2" value=""> </div> </div> <div class="recipes-form__measure"> <div class="css-1juasd6-container"> <label for="measurement10" class="css-1dn068x"> <span class="css-1j7byy8">Measurement</span> </label> <input class="ingredient_measurement_value_2" name="ingredient_measurement_value_2['+count+']" value="" hidden> <select class="form-control ingredient_measurement_select_2" data-id="'+count+'" name="ingredient_measurement_2['+count+']">'+ html +'</select><span class="bs-caret cr""><span class="caret"></span></span> </div> </div><div class="recipes-form__qty"> <div class="css-1juasd6-container"> <label for="qty10" class="css-v23pgw"> <span class="css-hlp6ko">Qty</span> </label> <input placeholder=" " name="ingredient_quantity_2['+count+']" type="text" class="forfocuss form-control ingredient-input-2" value=""> </div> </div>   <span class="icon__remove remove ingredient-2" data-step="'+count+'" aria-label="Remove step"></span> </div>');

            //  $(this).parent().parent().children('.recipes-form__fieldset:last').before('<div class="recipes-form__fieldset form-group ingredient-2-div"> <div class="recipes-form__qty"> <div class="css-1juasd6-container"> <label for="qty10" class="css-v23pgw"> <span class="css-hlp6ko">Qty</span> </label> <input placeholder=" " name="ingredient_quantity_2['+count+']" type="text" class="forfocuss form-control ingredient-input-2" value=""> </div> </div> <div class="recipes-form__measure"> <div class="css-1juasd6-container"> <label for="measurement10" class="css-1dn068x"> <span class="css-1j7byy8">Measurement</span> </label> <select class="form-control" name="ingredient_measurement_2['+count+']"> <option value="10"> (none)</option> <option value="3">cup</option> <option value="21">teaspoon</option> <option value="20">tablespoon</option> <option value="1">bunch</option> <option value="2">cake</option> <option value="4">dash</option> <option value="5">drop</option> <option value="6">gallon</option> <option value="23">gram</option> <option value="7">handful</option> <option value="8">liter</option> <option value="9">milliliter</option> <option value="11">ounce</option> <option value="12">packet</option> <option value="13">piece</option> <option value="14">pinch</option> <option value="22">pint</option> <option value="15">pound</option> <option value="16">quart</option> <option value="17">shot</option> <option value="18">splash</option> <option value="19">sprig</option> </select> </div> </div> <div class="recipes-form__item"> <div class="css-1juasd6-container"> <label for="item10" class="css-v23pgw"> <span class="css-hlp6ko">Item</span> </label> <input placeholder=" " name="ingredient_item_2['+count+']" type="text" class="forfocuss form-control ingredient-item-2" value=""> </div> </div> <span class="icon__remove remove ingredient-2" data-step="'+count+'" aria-label="Remove step"></span> </div>');

            } 
        
            if($(this).hasClass('ingredient-1')){
                let count = $('.ingredient-input-1').length;
                 $(this).parent().parent().children('.recipes-form__fieldset:last').before('<div class="recipes-form__fieldset form-group ingredient-1-div"> <div class="recipes-form__item"> <div class="css-1juasd6-container"> <label for="item10" class="css-v23pgw"> <span class="css-hlp6ko">Item</span> </label> <input placeholder=" " name="ingredient_item_1['+count+']" type="text" class="forfocuss form-control ingredient-item-1" value=""> </div> </div><div class="recipes-form__measure"> <div class="css-1juasd6-container"> <label for="measurement10" class="css-1dn068x"> <span class="css-1j7byy8">Measurement</span> </label> <input class="ingredient_measurement_value_1" name="ingredient_measurement_value_1['+count+']" value="" hidden> <select class="form-control ingredient_measurement_select_1" data-id="'+count+'" name="ingredient_measurement_1['+count+']">'+ html +'</select><span class="bs-caret cr""><span class="caret"></span></span> </div> </div> <div class="recipes-form__qty"> <div class="css-1juasd6-container"> <label for="qty10" class="css-v23pgw"> <span class="css-hlp6ko">Qty</span> </label> <input placeholder=" " name="ingredient_quantity_1['+count+']" type="text" class="forfocuss form-control ingredient-input-1" value=""> </div> </div>  <span class="icon__remove remove ingredient-1" data-step="'+count+'" aria-label="Remove step"></span> </div>');

                // $(this).parent().parent().children('.recipes-form__fieldset:last').before('<div class="recipes-form__fieldset form-group ingredient-1-div"> <div class="recipes-form__qty"> <div class="css-1juasd6-container"> <label for="qty10" class="css-v23pgw"> <span class="css-hlp6ko">Qty</span> </label> <input placeholder=" " name="ingredient_quantity_1['+count+']" type="text" class="forfocuss form-control ingredient-input-1" value=""> </div> </div> <div class="recipes-form__measure"> <div class="css-1juasd6-container"> <label for="measurement10" class="css-1dn068x"> <span class="css-1j7byy8">Measurement</span> </label> <select class="form-control" name="ingredient_measurement_1['+count+']"> <option value="10"> (none)</option> <option value="3">cup</option> <option value="21">teaspoon</option> <option value="20">tablespoon</option> <option value="1">bunch</option> <option value="2">cake</option> <option value="4">dash</option> <option value="5">drop</option> <option value="6">gallon</option> <option value="23">gram</option> <option value="7">handful</option> <option value="8">liter</option> <option value="9">milliliter</option> <option value="11">ounce</option> <option value="12">packet</option> <option value="13">piece</option> <option value="14">pinch</option> <option value="22">pint</option> <option value="15">pound</option> <option value="16">quart</option> <option value="17">shot</option> <option value="18">splash</option> <option value="19">sprig</option> </select> </div> </div> <div class="recipes-form__item"> <div class="css-1juasd6-container"> <label for="item10" class="css-v23pgw"> <span class="css-hlp6ko">Item</span> </label> <input placeholder=" " name="ingredient_item_1['+count+']" type="text" class="forfocuss form-control ingredient-item-1" value=""> </div> </div> <span class="icon__remove remove ingredient-1" data-step="'+count+'" aria-label="Remove step"></span> </div>');
            } 


        $('.forfocuss').focusin(function () {
         $(this).parent().addClass('css-czzpt7z');

       });
        $('.forfocuss').focusout(function () {
         $(this).parent().removeClass('css-czzpt7z');
     });

        $(document).ready(function() { 
            $(".forfocuss").focusout(function() { 
                if($(this).val()=='') { 
                      $(this).parent().removeClass('css-czzpt7z');  
                       
                }
                else {
                       $(this).parent().addClass('css-czzpt7z');
                    // If it is not blank.
                  
                }    
            }) .trigger("focusout");
        }); 
 
    });

    $('body').on('click', '.remove', function () {
        $(this).parent('.recipes-form__fieldset').remove();
        $delete_step = $(this).data('step');
        if($(this).hasClass('ingredient-1')){
            $('.ingredient-1-div').each(function(index,e){
                // console.log('index',index);
                // console.log('e',e);
                if(index >= $delete_step){
                    let name_qty = "ingredient_quantity_1["+index+"]";
                    $(this).find('.ingredient-input-1').attr('name', name_qty);

                    let name_measurement = "ingredient_measurement_1["+index+"]";
                    $(this).find('select').attr('name', name_measurement).attr('data-id', index);

                    let name_item = "ingredient_item_1["+index+"]";
                    $(this).find('.ingredient-item-1').attr('name', name_item);

                    let hidden_input_measurement = "ingredient_measurement_value_1["+index+"]";
                    $(this).find('.ingredient_measurement_value_1').attr('name', hidden_input_measurement);

                    $(this).find('.ingredient-1').attr('data-step',index);
                }
             });      
          }
         /* preparation 2 */
         if($(this).hasClass('ingredient-2')){
            $('.ingredient-2-div').each(function(index,e){
                // console.log('index',index);
                // console.log('e',e);
                if(index >= $delete_step){
                    let name_qty = "ingredient_quantity_2["+index+"]";
                    $(this).find('.ingredient-input-2').attr('name', name_qty);

                    let name_measurement = "ingredient_measurement_2["+index+"]";
                    $(this).find('select').attr('name', name_measurement).attr('data-id', index);

                    let name_item = "ingredient_item_2["+index+"]";
                    $(this).find('.ingredient-item-2').attr('name', name_item);

                    let hidden_input_measurement = "ingredient_measurement_value_2["+index+"]";
                    $(this).find('.ingredient_measurement_value_2').attr('name', hidden_input_measurement);

                    $(this).find('.ingredient-2').attr('data-step',index);
                }
             });      
          }
        /*  */
    });

    $('body').on('click', '.remove', function () {
        $(this).parent('.blockk').remove();
        $delete_step = $(this).data('step');
        console.log('111==', $(this).data('step'));
        /* preparation 1 */
        if($(this).hasClass('preparation-1')){
            $('.preparation-1-div').each(function(index,e){
                // console.log('index',index);
                // console.log('e',e);
                if(index >= $delete_step){
                    let step_no = index + 1; 
                    $(this).find('.css-hlp6ko').text('Step '+step_no);
                    let name_attr = "meal_preparation_1["+index+"]";
                    // console.log(name_attr);
                    $(this).find('.preparation-1-input').attr('name', name_attr);
                    $(this).find('.preparation-1').attr('data-step',index);
                }
             });      
          }
         /* preparation 2 */
        if($(this).hasClass('preparation-2')){
            $('.preparation-2-div').each(function(index,e){
                if(index >= $delete_step){
                    let step_no = index + 1; 
                    $(this).find('.css-hlp6ko').text('Step '+step_no);
                    let name_attr = "meal_preparation_2["+index+"]";
                    $(this).find('.preparation-2-input').attr('name', name_attr);
                    $(this).find('.preparation-2').attr('data-step',index);
                }

             });
            
        }

        /*  */
    });


    $('.forfocuss').focusin(function () {
       $(this).parent().addClass('css-czzpt7z');

});
$(document).ready(function() { 
            $(".forfocuss").focusout(function() { 
                if($(this).val()=='') { 
                      $(this).parent().removeClass('css-czzpt7z');  
                       
                }
                else {
                       $(this).parent().addClass('css-czzpt7z');
                    // If it is not blank.
                  
                }    
            }) .trigger("focusout");

           $('.edit-image-div').css('display','none');
        }); 
    
   //  $('.css-v23pgw').click(function () {
   //     $(this).parent().addClass('css-czzpt7z');
   //     event.stopPropagation();


   // });

    $('.forfocuss').focusout(function () {
       $(this).parent().removeClass('css-czzpt7z');
   });
    //  $('.recipes-form__style-label.simple').addClass('active');
    $('.recipes-form__style-label.two-part-r').click(function () {
        $('.reipe_format').attr('value', '3');
       $('.ingredients2').show();
       $('.preparation2').show();
       $(this).addClass('active');
       $('.recipes-form__style-label.two-part-i').removeClass('active');
       $('.recipes-form__style-label.simple').removeClass('active');

   });

  $('.recipes-form__style-label.two-part-i').click(function () {
    $('.reipe_format').attr('value', '2');
     $('.ingredients2').show();
     $('.preparation2').hide();
     $(this).addClass('active');
     $('.recipes-form__style-label.two-part-r').removeClass('active');
     $('.recipes-form__style-label.simple').removeClass('active');

 });

  $('.recipes-form__style-label.simple').click(function () {
     $('.reipe_format').attr('value', '1');
     $('.ingredients2').hide();
     $('.preparation2').hide();
     $(this).addClass('active');
     $('.recipes-form__style-label.two-part-i').removeClass('active');
     $('.recipes-form__style-label.two-part-r').removeClass('active');

 });
$(document).ready(function() {
    $(window).scroll(function() {
     $('.bootstrap-select').removeClass('open');
    });
      if ($(window).width() < 768) {
     $('.desk').appendTo('.mobile-view');     
     $('.nutrional-info').remove();
    }
    // else{
    //     $('.mobile-view').remove();
    // } 

});

$(document).ready(function(){
  $(".ingredients-new .add").click(function(){
    $(".bottom.add-area").show();
    $(".ingredients-new .add").hide();
  });
  $("#addIngrButton").click(function(){
    $(".bottom.add-area").hide();
    $(".ingredients-new .add").show();
  });


   $("#homeAnalyzeBtn").click(function(){
    $(".ingredients-new .list").show();
     $('#waitingShield').removeClass('hidden');
    //    setTimeout(function() { $("#waitingShield").hide(); }, 1000);
    });

    $('body').on('click','.edit-ingr',function(){
       var index = $(this).attr('data-id');
       $(".edit-ing-"+index).css('display','block');
    });

    $(document).on('click','.edit-ingr-btn',function(){
        var index = $(this).attr('data-id');
        $(".edit-ing-"+index).css('display','none');
    });
    /*  */
    $('body').on('click','.edit-ingr-2',function(){
       var index = $(this).attr('data-id');
       $(".edit-ing-2-"+index).css('display','block');
    });

    $(document).on('click','.edit-ingr-btn-2',function(){
        var index = $(this).attr('data-id');
        $(".edit-ing-2-"+index).css('display','none');
    });

    /*  */

    $('textarea').focus(function(){
  $(this).attr('placeholder','');
});
$('textarea.analyze').focusout(function(){
  $(this).attr('placeholder','For example: \n1 cup orange juice \n3 tablespoons olive oil \n2 carrots');
});
});
</script>