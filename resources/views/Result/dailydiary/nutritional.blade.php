@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v=' . time()) !!}
    {!! Html::style('result/plugins/dropzone/cropper.css') !!}
    {!! Html::style('result/plugins/Jcrop/css/jquery.Jcrop.min.css?v='.time()) !!}
    <style type="text/css">
        section#page-title {
            display: none;
        }

        .confirm {
            background-color: #f94211 !important;
        }

        .modal,
        .modal-dialog {
            z-index: 99999999 !important;
        }

        .personal-measurement-mobile .col-xs-12 {
            width: 100% !important;
        }

        .personal_mobile_top {
            background: url(../result/images/DAILY-DIARY-NUTRITION.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
        }

        .personal_dairy_section h2 {
            margin-bottom: 2px;
        }

    </style>

@stop
@section('content')
    <div class="personal_mobile_top">
        @php
            if ($_GET) {
                $queryString = 'Yes';
            } else {
                $queryString = 'No';
            }
            
            $catType = \App\MpMealCategory::pluck('id', 'name')->toArray();
        @endphp
        <span>Daily </span> <br>Diary
        <div class="backtopage">
            <a @if ($queryString == 'Yes') href="{{ url('calendar/daily-dairy?date=' . $eventDate) }}" @else href="{{ url('calendar/daily-dairy') }}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
        </div>
        <input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate"> 
    </div>
    {{-- <form id="nutritionalFormModalMob"> --}}
       <div class="personal_mobile_details" id="NutritionalJournalMob">
        <div class="personal_dairy_section tab-pane nutrional-section">

            <h2 class="c-gray"><strong>NUTRITIONAL</strong><br>JOURNAL</h2>

            <div class="section-1">
                <div class="form-group">
                    <h6 class="measurement-heading"><strong>RECIPE </strong> NAME</h6>
                    <input type="text" name="recipe_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <h6 class="measurement-heading"><strong>WHEN </strong></h6>
                    <select class="form-control" name="cat_id" id="catIdMob">
                        <option value="{{ isset($catType) ? $catType['Breakfast'] : '' }}" data-is-snack="0">Breakfast</option>
                        <option value="{{ isset($catType) ? $catType['Snack'] : '' }}" data-is-snack="1" data-snack-type="1">
                            Snack1</option>
                        <option value="{{ isset($catType) ? $catType['Lunch'] : '' }}" data-is-snack="0">Lunch</option>
                        <option value="{{ isset($catType) ? $catType['Snack'] : '' }}" data-is-snack="1" data-snack-type="2">
                            Snack2</option>
                        <option value="{{ isset($catType) ? $catType['Dinner'] : '' }}" data-is-snack="0">Dinner</option>
                        <option value="{{ isset($catType) ? $catType['Snack'] : '' }}" data-is-snack="1" data-snack-type="3">
                            Snack3</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="add_time_section">
                            <ul class="time_selectable">
                                <li class="manual_time time_opt" data-time-opt="manual">Manual Time Entry</li>
                                <li class="automatic_time time_opt active" data-time-opt="automatic">Automatic Time Entry
                                </li>
                            </ul>
                            <input type="hidden" name="time_opt" id="time_opt" value="automatic">
                            <input type="hidden" name="nutritionalTime" id="automaticTimeMob" value="09:00:00">
                        </div>
                        <div class="form-group add_time_manual clearfix" style="display: none;">
                            <label>Time <a href="javascript:void(0)" class="nav-link nutritionDatetimePickerMob">Change
                                    {{-- <input type="text" class="go_to_sleep event-date-timepicker" value="09:00 AM" name=""> --}}
                                </a>
                            </label>
                            <span class="nutri-time-span nutri-time-span-mob" data-val="09:00:00">09:00 AM</span>

                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group meal-images-section">
                            <input type="hidden" name="clickedPic" id="clickedPic" value="">
                            <input type="file" accept="image/*" capture="" onchange="fileSelectHandlerClick(this)"
                                class="chooseFileBtn" id="chooseFileBtn">
                            <label for="chooseFileBtn">
                                <img src="{{ asset('result/images/camera.png') }}">
                            </label>
                            <h6 class="measurement-heading text-center capture-text"><strong>CAPTURE </strong>YOUR MEAL</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding:0">
                    <hr>
                    <div class="col-xs-6">
                        <!-- <button class="cancel prev1">CANCEL</button> -->
                    </div>
                    <div class="col-xs-6"><button class="next-btn next1">NEXT</button></div>
                </div>
            </div>
            <div class="section-2" style="display:none">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="mealImageBox">
                            <div class="meal_image">
                                <img src="{{ asset('result/images/meal-img.png') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h6 class="measurement-heading hunger-level-mob mt-10 mb-10"><strong>HUNGER LEVEL</strong></h6>
                        <div class="persoanl_rating">
                            <div class="star-rate" id="hunger-level">
                                <input type="radio" id="h3" name="hunger-level" value="3">
                                <label for="h3" title="text">
                                    <span class="select-multiple">Starved</span>
                                </label>

                                <input type="radio" id="h2" name="hunger-level" value="2">
                                <label for="h2" title="text">
                                    <span class="select-multiple">Hungry</span>
                                </label>

                                <input type="radio" id="h1" name="hunger-level" value="1">
                                <label for="h1" title="text">
                                    <span class="select-multiple">Not Hungry</span>
                                </label>
                            </div>
                        </div>
                        <h6 class="measurement-heading serving-size-mob mb-10"><strong>SERVING SIZE </strong></h6>
                        <div class="persoanl_rating">
                            <div class="star-rate" id="serving-size">
                                <input type="radio" id="s3" name="serving-size" value="Large">
                                <label for="s3" title="text">
                                    <span class="select-multiple">LARGE</span>
                                </label>

                                <input type="radio" id="s2" name="serving-size" value="Medium">
                                <label for="s2" title="text">
                                    <span class="select-multiple">MEDIUM</span>
                                </label>

                                <input type="radio" id="s1" name="serving-size" value="Small">
                                <label for="s1" title="text">
                                    <span class="select-multiple">SMALL</span>
                                </label>
                            </div>
                        </div>
                        <h6 class="measurement-heading healthy-mob mb-10"><strong>HOW HEALTHY WAS MY MEAL </strong></h6>
                        <div class="persoanl_rating">
                            <div class="star-rate" id="healthy">
                                <input type="radio" id="h33" name="healthy" value="Unhealthy">
                                <label for="h33" title="text">
                                    <span class="select-multiple">UNHEALTHY</span>
                                </label>

                                <input type="radio" id="h22" name="healthy" value="Average">
                                <label for="h22" title="text">
                                    <span class="select-multiple">AVERAGE</span>
                                </label>

                                <input type="radio" id="h11" name="healthy" value="Healthy">
                                <label for="h11" title="text">
                                    <span class="select-multiple">HEALTHY</span>
                                </label>
                            </div>
                        </div>
                        <h6 class="measurement-heading enjoy-meal-mob mb-10"><strong>HOW MUCH DID I ENJOY MY MEAL </strong></h6>
                        <div class="persoanl_rating">
                            <div class="star-rate" id="enjoy-meal">
                                <input type="radio" id="e3" name="enjoy-meal" value="Not">
                                <label for="e3" title="text">
                                    <span class="select-multiple">NOT</span>
                                </label>

                                <input type="radio" id="e2" name="enjoy-meal" value="Somewhat">
                                <label for="e2" title="text">
                                    <span class="select-multiple">SOMEWHAT</span>
                                </label>

                                <input type="radio" id="e1" name="enjoy-meal" value="Very">
                                <label for="e1" title="text">
                                    <span class="select-multiple">VERY</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12" style="padding:0">
                    <hr>
                    <div class="col-xs-6"><button class="prev-btn prev1">PREV</button></div>
                    <div class="col-xs-6"><button class="next-btn next2">NEXT</button></div>
                </div>
            </div>


            <div class="section-3" style="display:none">
                <div class="row">

                    <div class="col-xs-12">
                        <h6 class="measurement-heading m-0 mb-10"><strong>INGREDIENT</strong> LIST</h6>
                        <textarea class="form-control analyze ingredients ingredients-val-mob" required=""
                            placeholder="FOR EXAMPLE:&#10;2 Slices wholewheat toast&#10;1 Slice cheddar cheese &#10;1 Slice home"
                            rows="8"></textarea>
                         <p class="analyze-error" style="color: red"></p>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a class="btn btn-primary analyze_data_mob" id="homeAnalyzeBtn">ANALYSE</a>
                    </div>
                </div>
                {{--  --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="ingredients-new form-group">
                            <div class="show-all-list-div-mob">
                            </div>
                        </div>
                    </div>
                </div>
                <input hidden id="total_energ_kcal" name="total_energ_kcal" value="" >
                <input hidden id="cal_from_protein" name="cal_from_protein" value="" >
                <input hidden id="cal_from_fat" name="cal_from_fat" value="" >
                <input hidden id="cal_from_carbohydrates" name="cal_from_carbs" value="">
                {{--  --}}
          
                {{-- <div class="col-xs-12 ingredients-new form-group list">
                    <div class="row">
                        <div class="col-md-10 col-xs-8 line">
                            <span class="line-text-0">2 Slices wholewheat toast</span>
                        </div>

                        <div class="col-md-2 col-xs-4">
                            <span class="pull-right delete-ingr"></span>
                            <span class="pull-right edit-ingr edit-measurement"></span>
                        </div>
                    </div>
                    <div class="line-ingr">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group bg-white">

                                    <select class="form-control">
                                        <option>Toast</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-xs-4" style="padding-right: 0;">
                                <div class="form-group">
                                    <input type="text" value="0" class="form-control quantity-sel food-qty-0">
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="form-group bg-white">
                                    <select class="form-control food-measure-0">
                                        <optgroup>
                                            <option>Whole</option>
                                            <option>Serving</option>
                                            <option>Bag</option>
                                            <option>Gram</option>
                                            <option>Ounce</option>
                                            <option>Pound</option>
                                            <option>Kilogram</option>
                                            <option>Cup</option>
                                            <option>Fluid ounce</option>
                                        </optgroup>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <a href="javascript:void(0)" class="btn btn-primary more updateRecipe">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ingredients-new form-group list">
                    <div class="row">
                        <div class="col-md-10 col-xs-8 line">
                            <span class="line-text-0">1 Slice cheddar cheese</span>
                        </div>

                        <div class="col-md-2 col-xs-4">
                            <span class="pull-right delete-ingr"></span>
                            <span class="pull-right edit-ingr edit-measurement"></span>
                        </div>
                    </div>
                    <div class="line-ingr">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group bg-white">

                                    <select class="form-control">
                                        <option>Toast</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-xs-4" style="padding-right: 0;">
                                <div class="form-group">
                                    <input type="text" value="0" class="form-control quantity-sel food-qty-0">
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="form-group bg-white">
                                    <select class="form-control food-measure-0">
                                        <optgroup>
                                            <option>Whole</option>
                                            <option>Serving</option>
                                            <option>Bag</option>
                                            <option>Gram</option>
                                            <option>Ounce</option>
                                            <option>Pound</option>
                                            <option>Kilogram</option>
                                            <option>Cup</option>
                                            <option>Fluid ounce</option>
                                        </optgroup>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <a href="javascript:void(0)" class="btn btn-primary more updateRecipe">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ingredients-new form-group list">
                    <div class="row">
                        <div class="col-md-10 col-xs-8 line">
                            <span class="line-text-0">1 Slice home</span>
                        </div>

                        <div class="col-md-2 col-xs-4">
                            <span class="pull-right delete-ingr"></span>
                            <span class="pull-right edit-ingr edit-measurement"></span>
                        </div>
                    </div>
                    <div class="line-ingr">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group bg-white">

                                    <select class="form-control">
                                        <option>Toast</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-xs-4" style="padding-right: 0;">
                                <div class="form-group">
                                    <input type="text" value="0" class="form-control quantity-sel food-qty-0">
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="form-group bg-white">
                                    <select class="form-control food-measure-0">
                                        <optgroup>
                                            <option>Whole</option>
                                            <option>Serving</option>
                                            <option>Bag</option>
                                            <option>Gram</option>
                                            <option>Ounce</option>
                                            <option>Pound</option>
                                            <option>Kilogram</option>
                                            <option>Cup</option>
                                            <option>Fluid ounce</option>
                                        </optgroup>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <a href="javascript:void(0)" class="btn btn-primary more updateRecipe">Update</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
               <!-- Pie chart start -->
                <div class="wizard nutritionChart nutritionChartMob" style="display: none;">
                    <h6 class="measurement-heading mt-10 mb-10"><strong>NUTRITIONAL  </strong> INFORMATION</h6>
                    <div id="calories-per-serve2" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                    <div class="daily">
                        <div class="barWrapper">
                            <div class="progressText">
                                <span class="daily-text">Daily:</span> <span class="daily-cal">2000</span>cal
                            </div>
                            {{-- <div class="progress daily-red"> --}}
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%;">
                                    {{-- <span class="popOver" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="" aria-describedby="tooltip430234">                                                    --}}
                                    <span class="popOver" data-toggle="tooltip" data-placement="bottom" >                                                   
                                    </span>
                                    <div class="tooltip fade bottom in" role="tooltip" style="top: 0px; left: 21.0243px; display: block;">
                                        <div class="tooltip-arrow" style="left: 50%;">                                                   
                                        </div>
                                        <div class="tooltip-inner">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nutrient-info">
                        <div class="circles">
                            <div class="circle protein">

                                <div class="value protein-val">0</div>
                                <div class="cal">cal</div>
                            </div>
                            <div class="subcal">Protein</div>
                        </div>
                        <div class="circles">
                            <div class="circle carbs">
                                <div class="value carbs-val">0</div>
                                <div class="cal">cal</div>
                            </div>
                            <div class="subcal">Carbs</div>
                        </div>
                        <div class="circles">
                            <div class="circle fat">
                                <div class="value fat-val">0</div>
                                <div class="cal">cal</div>
                            </div>
                            <div class="subcal">Fat</div>
                        </div>
                    </div>
                </div>
                <!-- Pie chart end -->
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <h6 class="measurement-heading mt-10 mb-10"><strong>ACTIVITY </strong> LEVEL</h6>
                        <textarea class="form-control" required="" rows="5" name="activity_label"></textarea>
                    </div>
                    <div class="col-xs-12 form-group">
                        <h6 class="measurement-heading mt-10 mb-10"><strong>GENERAL </strong>NOTES</h6>
                        <textarea class="form-control" required="" rows="5"  name="general_notes"></textarea>
                    </div>


                </div>
                <div class="">
                    <div class="col-xs-6"><button class="prev-btn prev2">PREV</button></div>
                    {{-- <div class="col-xs-6"><button class="cancel">CANCEL</button></div> --}}
                    <div class="col-xs-6"><button class="save saveNutritionalData">SAVE</button></div>
                </div>
                {{-- <div class="col-xs-12" style="padding:0">
                    <hr>
                    <div class="col-xs-6"><button class="prev-btn prev2">PREV</button></div>
                    <div class="col-xs-6"></div>
                </div> --}}
            </div>
        </div>
    </div>
{{-- cropp modal --}}

<div class="modal" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cropperModalLabel">Cropper</h5>
          <button type="button" class="close saveImg" data-dismiss="modal" aria-label="Close">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">  --}}
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
     <div class="modal-body">
        <input type="hidden" name="photoName">
        <div class="img-container">
            <img id="imageCrop" src="" alt="Picture" height="340" width="100%">
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-success cropImg">Crop</button>
 
            <button type="button" class="btn btn-secondary saveImg" data-dismiss="modal">Close</button>
        </div>
      </div>
   </div>
</div>

{{-- crop modal  --}}

    {{-- @include('Result.dailydiary.nutritional-modal') --}}
@stop

@section('required-script')
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
{!! Html::script('result/plugins/dropzone/cropper.js') !!}
{!! Html::script('result/plugins/Jcrop/js/jquery.Jcrop.min.js') !!}
{!! Html::script('result/plugins/Jcrop/js/script.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
           var dt = new Date();
           var time = dt.getHours() + ":" + dt.getMinutes();
           var nutritionalForm =  $('#NutritionalJournalMob');
           nutritionalForm.find('#automaticTimeMob').val(time);


            $('.nutritionDatetimePickerMob').bootstrapMaterialDatePicker({
                date: false,
                shortTime: true,
                format: 'HH:mm:ss',
                currentDate: '09:00 AM'
            }).change(function(e, date) {
                var time = date.format("hh:mm A");
                var timeHH = date.format("HH:mm:ss");
                $('.nutri-time-span-mob').text(time);
                $('.nutri-time-span-mob').data('val', timeHH);
                $("#automaticTimeMob").val(timeHH);
            });
        });
        $(document).on('click', '.edit-measurement', function() {
            $('#edit-measurement').modal('show');
        });

        $('body').on('click', '.manual_time', function() {
            $('.automatic_time').removeClass('active');
            $('.manual_time').addClass('active');
            $('.add_time_manual').show();
        });

        $('body').on('click', '.automatic_time', function() {
            $('.manual_time').removeClass('active');
            $('.automatic_time').addClass('active');
            $('.add_time_manual').hide();
        });
        $('body').on('click', '.next1', function() {
            $('#NutritionalJournalMob #recipe_name_mob').remove();
            var recipe_name = $('#NutritionalJournalMob').find("input[name='recipe_name']").val();
            if(recipe_name == ''){
                $('#NutritionalJournalMob').find("input[name='recipe_name']").after('<label id="recipe_name_mob" class="error">This field is required.</label>');
                 return false;
             }
            $(".personal_mobile_details").scrollTop(0);
            $('.section-2').show();
            $('.section-1').hide();
            $('.section-3').hide();
            $('.section-4').hide();
        });
        $('body').on('click', '.next2', function() {
                $('#NutritionalJournalMob #hunger-level-mob').remove();
                $('#NutritionalJournalMob #serving-size-mob').remove();
                $('#NutritionalJournalMob #healthy-mob').remove();
                $('#NutritionalJournalMob #enjoy-meal-mob').remove();
            var hungerRate = $('#NutritionalJournalMob').find('input[name="hunger-level"]:checked').val();
            if(hungerRate == undefined){
                $('#NutritionalJournalMob #serving-size-mob').remove();
                $('#NutritionalJournalMob #healthy-mob').remove();
                $('#NutritionalJournalMob #enjoy-meal-mob').remove();
                $('#NutritionalJournalMob').find(".hunger-level-mob").after('<label id="hunger-level-mob" class="error">This field is required.</label>');
              return false;
            }
            var servingSize = $('#NutritionalJournalMob').find('input[name="serving-size"]:checked').val();
            if(servingSize == undefined){
                $('#NutritionalJournalMob #hunger-level-mob').remove();
                $('#NutritionalJournalMob #healthy-mob').remove();
                $('#NutritionalJournalMob #enjoy-meal-mob').remove();
                $('#NutritionalJournalMob').find(".serving-size-mob").after('<label id="serving-size-mob" class="error">This field is required.</label>');
              return false;
            }
            var mealRating = $('#NutritionalJournalMob').find('input[name="healthy"]:checked').val();
            if(mealRating == undefined){
                $('#NutritionalJournalMob #hunger-level-mob').remove();
                $('#NutritionalJournalMob #serving-size-mob').remove();
                $('#NutritionalJournalMob #enjoy-meal-mob').remove();
                $('#NutritionalJournalMob').find(".healthy-mob").after('<label id="healthy-mob" class="error">This field is required.</label>');
              return false;
            }
            var mealEnjoyed = $('#NutritionalJournalMob').find('input[name="enjoy-meal"]:checked').val();
            if(mealEnjoyed == undefined){
                $('#NutritionalJournalMob #hunger-level-mob').remove();
                $('#NutritionalJournalMob #serving-size-mob').remove();
                $('#NutritionalJournalMob #healthy-mob').remove();
                $('#NutritionalJournalMob').find(".enjoy-meal-mob").after('<label id="enjoy-meal-mob" class="error">This field is required.</label>');
              return false;
            }
         
            $(".personal_mobile_details").scrollTop(0);
            $('.section-3').show();
            $('.section-1').hide();
            $('.section-2').hide();
            $('.section-4').hide();
        });
        $('body').on('click', '.next3', function() {
            $(".personal_mobile_details").scrollTop(0);
            $('.section-4').show();
            $('.section-1').hide();
            $('.section-2').hide();
            $('.section-3').hide();
        });
        $('body').on('click', '.prev1', function() {
            $('#NutritionalJournalMob #recipe_name_mob').remove();
            $(".personal_mobile_details").scrollTop(0);
            $('.section-1').show();
            $('.section-2').hide();
            $('.section-4').hide();
            $('.section-3').hide();
        });
        $('body').on('click', '.prev2', function() {
            $(".personal_mobile_details").scrollTop(0);
            $('.section-2').show();
            $('.section-1').hide();
            $('.section-4').hide();
            $('.section-3').hide();
        });

        $('body').on('click', '#NutritionalJournalMob .time_opt',function(){
            var timeOpt = $(this).data('time-opt');
            if(timeOpt == 'automatic'){
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes();
                $('#NutritionalJournalMob #automaticTimeMob').val(time);
            }
            $('#NutritionalJournalMob #time_opt').val(timeOpt);
        });

        $('body').on('click', '.saveNutritionalData', function() {    
        //  if($('#nutritionalFormModalMob').valid()){
            var nutritionalForm =  $('#NutritionalJournalMob');
            if ($("#NutritionalJournalMob .list").length == 0) {
                $('#NutritionalJournalMob .analyze-error').html('Please click on Analyze button');
                return false;
              }
            var ingredient_data_1 = {};
            $('#NutritionalJournalMob .list').each(function() {
                let index = $(this).attr('data-id');
                let item_name = $(this).find('.food-match-' + index).val();
                if (item_name) {
                    ingredient_data_1[item_name] = {
                        'qty': $(this).find('.food-qty-' + index).val(),
                        'measure': $(this).find('.food-measure-' + index).val(),
                        'item': item_name,
                    }
                }
            });
            if ($("#NutritionalJournalMob .list").length == 0) {
                $('#NutritionalJournalMob .analyze-error').html('please click on Analyze button');
                return false;
            }
            $('#NutritionalJournalMob #activity-label-mob').remove();
            $('#NutritionalJournalMob #general-notes-mob').remove();
            var activity_label =  nutritionalForm.find('textarea[name="activity_label"]').val();
            if (activity_label == '') {
                $('#NutritionalJournalMob').find("textarea[name='activity_label']").after('<label id="activity-label-mob" class="error">This field is required.</label>');
                return false;
            }
            var general_notes =  nutritionalForm.find('textarea[name="general_notes"]').val();
            if (general_notes == '') {
                $('#NutritionalJournalMob').find("textarea[name='general_notes']").after('<label id="general-notes-mob" class="error">This field is required.</label>');
                return false;
            }
            var formData = {};
            formData['ingredient_data_1'] = ingredient_data_1;
            formData['total_energ_kcal'] = nutritionalForm.find('#total_energ_kcal').val();
            formData['cal_from_protein'] = nutritionalForm.find('#cal_from_protein').val();
            formData['cal_from_fat'] = nutritionalForm.find('#cal_from_fat').val();
            formData['cal_from_carbs'] = nutritionalForm.find('#cal_from_carbohydrates').val();

            formData['is_custom'] = 2;
            formData['eventDate'] = $('.currentDate').attr('data-val');;
            formData['cat_id'] = nutritionalForm.find('#catIdMob').val();
            nutritionalForm.find('#catIdMob option:selected');
            formData['isSnack'] = nutritionalForm.find('#catIdMob option:selected').data('is-snack');
            if (formData['isSnack']) {
                formData['snackType'] = nutritionalForm.find('#catIdMob option:selected').data('snack-type');
            }
            formData['time_opt'] = nutritionalForm.find('#time_opt').val();
            formData['nutritionalTime'] = nutritionalForm.find('#automaticTimeMob').val();
            formData['recipeName'] = nutritionalForm.find('input[name="recipe_name"]').val();
            formData['hungerRate'] = nutritionalForm.find('input[name="hunger-level"]:checked').val();
            formData['servingSize'] = nutritionalForm.find('input[name="serving-size"]:checked').val();
            formData['mealRating'] = nutritionalForm.find('input[name="healthy"]:checked').val();
            formData['mealEnjoyed'] = nutritionalForm.find('input[name="enjoy-meal"]:checked').val();
            formData['activityLabel'] = nutritionalForm.find('textarea[name="activity_label"]').val();
            formData['generalNotes'] = nutritionalForm.find('textarea[name="general_notes"]').val();
            formData['clickedImage'] = nutritionalForm.find('#clickedPic').val();
            // toggleWaitShield('show');
            console.log('formData=', formData);
            $.post(public_url + 'store-nutritional-data', formData, function(response) {
                // toggleWaitShield('hide');
                if (response.status == 'ok') {
                    swal({
                            type: 'success',
                            title: 'Success!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: 'Data saved successfully',
                            showConfirmButton: true,
                        },
                        function(isConfirm) {
                            if (isConfirm)
                                StatsModal.modal('hide');
                                location.reload();

                        });
                } else {
                    swal({
                            type: 'error',
                            title: 'Error!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: response.message,
                            showConfirmButton: true,
                        },
                        function(isConfirm) {
                            if (!isConfirm)
                              location.reload();
                        });
                }
            }, 'json')
        //    }
        });

        function fileSelectHandlerClick(elem){
            $('#waitingShield').removeClass('hidden');
            var picCropModel = $('#cropperModal');
            var fileInput = elem.files[0];
            var fileUrl = window.URL.createObjectURL(elem.files[0]);
            console.log(fileUrl, fileInput);
            var activeForm = $('#NutritionalJournalMob');
            // activeForm.find(".meal_image img").attr("src", fileUrl);
            activeForm.find('#mealImageBox').show();
            var oFile = elem.files[0];
            var form_data = new FormData();                  
            // form_data.append('fileToUpload', oFile);
            form_data.append('data', oFile);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                // url: public_url+'photo/capture-save', // point to server-side PHP script
                url: public_url+'photo/capture-save-meal',
                data: form_data,
                dataType: 'text', 
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    $('#waitingShield').addClass('hidden');
                    console.log('data=', data);
                    $('#imageCrop').attr('src',public_url+'uploads/'+data);
                    picCropModel.find('input[name="photoName"]').val(data);
                    picCropModel.modal('show');
                    // var file = document.querySelector('.chooseFileBtn');
                    //  file.value = '';
                    // activeForm.find("#clickedPic").val(data);
                }
            });
        }

        $('.analyze_data_mob').click(function(){
            $('#waitingShield').removeClass('hidden');
            // recipe_name
            var title= $("input[name='recipe_name']").val();	
            var ingr = $(".ingredients-val-mob").val().split(/\r\n|\n|\r/);
            var formView = 'ingredients-val';
            console.log('title==', title, ingr);
            var newInge =[];
            $.each(ingr,function(key,value){
                newValue= value.trim();
                data = removeTags(newValue);
                if(data != "" && data != false){
                   newInge.push(data);
                }
            })
            console.log('title==', newInge);
            var form = "ingredient-form-1";
            $.post(public_url+'meal-planner/ingredient-meal-mob', {title:title,ingr:newInge,form:form, formView:formView}, function(data){
                 $('#NutritionalJournalMob .analyze-error').html('');
                 $('#waitingShield').addClass('hidden');
                $('.show-all-list-div-mob').html(data.html);
               if ($.isEmptyObject(data.totalNutrientsKCal)) {
                 }else{  
                     $('.nutritionChartMob').css('display', 'block');  
                    //  $('.nutritionChartMob .progress-bar').css('width', 'block');  
                    
                    //  nutritionChartMob  
                    if (typeof(data.totalNutrientsKCal.ENERC_KCAL) != "undefined") {
                            var toatl_cal = Math.round(data.totalNutrientsKCal.ENERC_KCAL.quantity);   
                            $('#total_energ_kcal').attr('value',toatl_cal);
                        } 
                        if ( typeof(data.totalNutrientsKCal.CHOCDF_KCAL) != "undefined") {
                            var toatl_carbohydrates = Math.round(data.totalNutrientsKCal.CHOCDF_KCAL.quantity);
                            $('#cal_from_carbohydrates').attr('value',toatl_carbohydrates);
                            $('.carbs-val').html(toatl_carbohydrates);
                        } 
                        if (typeof(data.totalNutrientsKCal.FAT_KCAL) != "undefined") {
                            var toatl_fat = Math.round(data.totalNutrientsKCal.FAT_KCAL.quantity);
                            $('#cal_from_fat').attr('value',toatl_fat);
                            $('.fat-val').html(toatl_fat);
                        } 
                        if (typeof(data.totalNutrientsKCal.PROCNT_KCAL) != "undefined") {
                            var toatl_protein = Math.round(data.totalNutrientsKCal.PROCNT_KCAL.quantity);
                            $('#cal_from_protein').attr('value',toatl_protein);
                            $('.protein-val').html(toatl_protein);
                        } 

                        var total_cal_progressbar = (toatl_cal*100)/2000;
                        var progress = total_cal_progressbar+'%';
                        console.log('progress',progress);
                        $('.nutritionChartMob .progress-bar').css('width',progress);
                        if(total_cal_progressbar > 100){
                            $('.nutritionChartMob .progress').addClass('daily-red');
                        }
                        $('.nutritionChartMob .tooltip-inner').text(progress);
                        
                        // console.log(total_cal_progressbar);
                        // @if($total_cal > 100) daily-red @endif"
                        /*  */
                        chart = new Highcharts.Chart({
                            credits: { enabled: false },
                            chart: {
                                renderTo: 'calories-per-serve2',
                                type: 'pie'
                            },
                            title: {
                                text: '<strong>'+toatl_cal+'</strong><br>CALORIES',
                                align: 'center',
                                verticalAlign: 'middle',
                                y: 20
                            },
                            plotOptions: {
                                pie: {
                                    shadow: false
                                },
                                series: {
                                    enableMouseTracking: false
                                }
                            },
                            series: [{
                                name: 'Browsers',
                                data: [
                                {
                                    name: 'Protien',
                                    y: toatl_protein,
                                    color:'#6acc00',
                                    dataLabels: {
                                        enabled: false,
                                    }
                                },{
                                    name: 'Carbs',
                                    y: toatl_carbohydrates,
                                    color:'#ffbe61',
                                    dataLabels: {
                                        enabled: false,
                                    }
                                },    
                                {
                                    name: 'Fat',
                                    y: toatl_fat,
                                    color:'#f14647',
                                    dataLabels: {
                                        enabled: false,
                                    }
                                },
                                ],

                                size: '100%',
                                innerSize: '80%',
                                showInLegend:false,
                                dataLabels: {
                                    enabled: false
                                }
                            }]
                        });

                      /*  */
                }
            
            })      
        });


        $('body').on('click','.list-mob .editIngrMob',function(){
            var index = $(this).attr('data-id');
            $(".edit-ing-"+index).css('display','block');
         });

 
        $(document).on('click','.list-mob .editIngrBtnMob',function(){ // cancel
            var index = $(this).attr('data-id');
            $(".edit-ing-"+index).css('display','none');
        });

        $(document).on('click','.list-mob .deleteIngrMob',function(){
            var id =$(this).attr('data-id');
            var ingr = $(".ingredients-val-mob").val().split(/\r\n|\n|\r/);
            var remove_item = $('.full-name-'+id).val();
            ingr.splice( $.inArray(remove_item, ingr) ,1 );
            var new_ingr = ingr.join("\r\n");
            $(".ingredients-val-mob").val(new_ingr);
             $('.analyze_data_mob').trigger("click");
        });

        $(document).on('click','.list-mob .updateRecipeIngrMob',function(){
            var id =$(this).attr('data-id');
            var ingr = $(".ingredients-val-mob").val().split(/\r\n|\n|\r/);
            var remove_item = $('.list-mob .full-name-'+id).attr('data-old');
            var add_item = $('.list-mob .full-name-'+id).val();
            console.log('add_item', remove_item, add_item);
            ingr.splice(ingr.indexOf(remove_item), 1, add_item)
            var new_ingr = ingr.join("\r\n");
            $(".ingredients-val-mob").val(new_ingr);
            $('.analyze_data_mob').trigger("click");
        });

        $(document).on('click','.updateRecipeMob',function(){
            var id =$(this).attr('data-id');
            var ingr = $(".ingredients-val-mob").val().split(/\r\n|\n|\r/);
            var remove_item = $('.full-name-'+id).attr('data-old');
            console.log('remove_item', remove_item);
            let ingr_val = '';
            ingr_val +=	$(".food-qty-"+id).val();
            ingr_val += ' ';
            ingr_val +=	$(".food-measure-"+id).val();
            ingr_val += ' ';
            ingr_val +=	$(".food-match-"+id).val();
            ingr.splice(ingr.indexOf(remove_item), 1, ingr_val)
            var new_ingr = ingr.join("\r\n");
            console.log('new_ingr--',new_ingr);
            $(".ingredients-val-mob").val(new_ingr);
            $('.analyze_data_mob').trigger("click");

        });

       /* crop */
       window.addEventListener('DOMContentLoaded', function () {
            var image = document.getElementById('imageCrop');
            var cropBoxData;
            var canvasData;
            var cropper;
            $('#cropperModal').on('shown.bs.modal', function () {
                    image = document.getElementById('imageCrop');
                    cropper = new Cropper(image, {
                    autoCropArea: 0.5,
                    ready: function () {
                    //Should set crop box data first here
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    },
                    viewMode: 2,
                    autoCropArea: 1,
                    aspectRatio: 1 / 1
               });
                // var entityIdVal = '';
                // var previewPics = '';
                // var prePhotoName = '';
                    // var ifCroppedImgSaved = false,
                        // public_url = $('meta[name="public_url"]').attr('content');	
                        // prePhotoName = $('.profileImage').find('input[name="prePhotoName"]');
                        // entityIdVal = $('.profileImage').find('input[name="entityId"]').val();
                        // var photoHelperVal =$('.profileImage').find('input[name="photoHelper"]').val();
                        // previewPics = $('.'+photoHelperVal+'PreviewPics');
                        // var cropSelector = $('.profileImage').find('input[name="cropSelector"]').val();
            $('.cropImg').click(function(){
                var cropData = cropper.getData();
                var form_data = {};             
                form_data['photoName'] = $('#cropperModal').find('input[name="photoName"]').val();
                form_data['widthScale'] = cropData.scaleX;
                form_data['x1'] = cropData.x;
                form_data['w'] = cropData.width;
                form_data['heightScale'] = cropData.scaleY;
                form_data['y1'] = cropData.y;
                form_data['h'] = cropData.height;
                console.log('image',form_data);
                $.ajax({
                    url: public_url+'calendar/nutritional/image',
                    data: form_data,                         
                    type: 'post',
                    success: function(response){
                         $('#cropperModal').modal('hide');
                         $('#NutritionalJournalMob').find("#clickedPic").val(response);
                         $('#NutritionalJournalMob').find(".meal_image img").attr("src", public_url+'uploads/'+response);
                        // previewPics.prop('src', public_url+'uploads/thumb_'+response);
                        // if(previewPics.hasClass('hidden'))
                        // 	previewPics.removeClass('hidden');
                        // prePhotoName.val(response);
                        // formData = {};
                        // formData['id'] = entityIdVal;
                        // formData['photoName'] = response;
                        // $.ajax({
                        // 	url: public_url+'client/photo/save',
                        // 	data: formData,                         
                        // 	method: 'POST'
                        // });
                    }
                });
            })
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });

       /* crop */

    </script>

@stop
