@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
    section#page-title {
        display: none;
    }
   
    .panel-white-me{
        border: 0px !important;
    }
    .my-div,#health-section-row>#visits>.panel-wrapper>.panel-body{
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
    .panel-body img{
        margin-top: 10px;
    }
    .health-section-area{
        padding-top: 10px;
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
    @endphp
    <span>Personal</span> <br>Statistics
    <div class="backtopage">
        <a @if($queryString =='Yes') href="{{url('calendar/daily-dairy?date='.$eventDate)}}" @else href="{{url('calendar/daily-dairy')}}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
</div>
<div class="personal_mobile_details">
    <div class="stastic_list">
            <input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate"> 
            {{-- <input hidden value="{{$eventDate}}" class="clickDate">  --}}
            <input hidden value="{{$statisticsData['id']}}" class="statistics-main-id"> 
           
        <ul>
            <li>
                <h3 class="statisticsItem" data-mainName="bfp_kg" data-name="bfp">{{$statisticsData['bfp_kg']}}</h3>
                <span>BFP<br>(%)</span>
                <div class="stat_edit">
                     <a class="staticEditBtn" data-name="BFP" data-mainName="bfp_kg" data-label="%" data-val="{{$statisticsData['bfp_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                    {{-- <a data-toggle="modal" data-target="#staticEdit" href="#"><i class="fa fa-pencil"></i> Edit</a> --}}
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="smm_kg" data-name="smm" >{{$statisticsData['smm_kg']}}</h3>
                <span>SMM<br>(kg)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-label="kg" data-mainName="smm_kg" data-name="SMM" data-val="{{$statisticsData['smm_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="bmr_kg" data-name="bmr">{{$statisticsData['bmr_kg']}}</h3>
                <span>BMR<br>(KCal)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="bmr_kg" data-label="KCal" data-name="BMR" data-val="{{$statisticsData['bmr_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="bmi_kg" data-name="bmi">{{$statisticsData['bmi_kg']}}</h3>
                <span>BMI<br>(kg/m<sup>2</sup>)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="bmi_kg" data-label="kg/m2" data-name="BMI" data-val="{{$statisticsData['bmi_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="sleep_kg" data-name="bfm">{{$statisticsData['sleep_kg']}}</h3>
                <span>BFM<br>(kg)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="sleep_kg" data-label="kg" data-name="BFM" data-val="{{$statisticsData['sleep_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="h_w_ratio" data-name="hw">{{$statisticsData['h_w_ratio']}}</h3>
                <span>H/W<br>Ratio</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="h_w_ratio" data-label="" data-name="H/W Ratio" data-val="{{$statisticsData['h_w_ratio']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="vis_eat_kg" data-name="vis_fat">{{$statisticsData['vis_eat_kg']}}</h3>
                <span>Visceral<br>Fat</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="vis_eat_kg" data-label="kg" data-name="Vis Fat" data-val="{{$statisticsData['vis_eat_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="pulsed_kg" data-name="pulse">{{$statisticsData['pulsed_kg']}}</h3>
                <span>Pulse<br>(bpm)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="pulsed_kg" data-label="bpm" data-name="Pulse" data-val="{{$statisticsData['pulsed_kg']}}"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </li>
            <li>
                <h3 class="statisticsItem" data-mainName="bp_mm" data-name="bp">{{$statisticsData['bp_mm']}}/{{$statisticsData['bp_hg']}}</h3>
                <span>Blood Pressure<br>(mmHg)</span>
                <div class="stat_edit">
                    <a class="staticEditBtn" data-mainName="bp_mm" data-label="mmHg" data-name="Blood Pressure" data-val="{{$statisticsData['bp_mm']}}" data-val2="{{$statisticsData['bp_mm']}}"><i class="fa fa-pencil"></i> Edit</a>
                    <input class="staticEditBtn bp-hg-val" data-mainName="bp_hg" data-val="{{$statisticsData['bp_hg']}}" hidden>
                </div>
            </li>
            <input class="staticEditBtn" data-mainName="extra_input" data-val="{{$statisticsData['extra_input']}}" hidden>
        </ul>
    </div>
    <!-- Edit popup model start -->
    @include('Result.dailydiary.static-modal')
    <!-- Edit popup model end -->
    <!-- graph popup model start -->
     <div class="personal_mob_graph">
        @include('Result.dailydiary.graph-mob')
    </div>
    <!-- graph popup model start -->
</div>
@stop
@section('required-script')
{!! Html::script('result/plugins/chartjs/dist/Chart.bundle.min.js') !!}
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<script>
    $( document ).ready(function() {
        var duration = '6';
        var bodypart = 'bfp';
        $.ajax({
            url: public_url + 'filter-personal-stastic/' + bodypart + '/' + duration,
            method: "get",
            success: function (data) {
                $(".graph").hide();
                $(".filter-div").show();
                $(".filter-div").html(data)
                // $("input[name='filterDate']").attr("checked", false);
                // $("input[name='filterDate'][value=" + duration + "]").attr("checked",true);
                // $("input[name='filterDate'] + label").removeClass("checked");
                // $("input[name='filterDate'][value=" + duration + "] + label").addClass("checked");
            }
        });
     });

    $(document).on('click','.statisticsItem',function(){
        $('#waitingShield').removeClass('hidden');
        var formData = {};
        formData['updated_field'] = $(this).attr('data-mainName');
        formData['bodypart'] = $(this).attr('data-name');
        formData['duration'] = '6';
        $.post(public_url+'calendar/personal-statistics-graph',formData,function(response){
            if(response.status == 'ok'){
               $('.personal_mob_graph').html(response.mob_html);
               var duration = '6';
               var bodypart = formData['bodypart'];
                $.ajax({
                    url: public_url + 'filter-personal-stastic/' + bodypart + '/' + duration,
                    method: "get",
                    success: function (data) {
                        $(".graph").hide();
                        $(".filter-div").show();
                        $(".filter-div").html(data)
                    }
                });
                $('#waitingShield').addClass('hidden');
            }else{    
            }
        },'json');
    });

    $(document).on('click','.staticEditBtn',function(){
        $('.bp-hg-value').attr("hidden",true);
        $('.blood_pressure').addClass('hidden');
        $('#add_goal .goalStaticEditVal').val('');
        var name = $(this).attr('data-name');
        var label = $(this).attr('data-label');
        var val = $(this).attr('data-val');
        var mainName = $(this).attr('data-mainName');
        var personalStatisticId = $('.statistics-main-id').val();
        // console.log('personalStatisticId ==', personalStatisticId );
        var currentDate = $('.currentDate').val();
        if(mainName == 'bp_mm'){
            var bp_hg = $('.bp-hg-val').attr('data-val');
            console.log('bp_hg=',bp_hg);
            var bpHgVal = '/'+bp_hg;
            $('.bp-hg-value').html(bpHgVal);
            $('.bp-hg-value').removeAttr('hidden');
            $('.blood_pressure').removeClass('hidden');
            $('.newStaticEditValForHb').val(bp_hg);
          }
        console.log('currentDate=', currentDate);
        $('.staticName').html(name);
        $('#Current .staticValue').html(val);
        $('.currentDate').html(currentDate);
        $('.newStaticEditVal').val(val);
        $('#Current .edit-value').val(val);
        $('.staticLabel').html(label);
        $('.current-date-calendar').val(currentDate); 
        $('.savePersonalStats').attr('data-name',mainName);
        $('.saveGoalPersonalStats').attr('data-name',mainName);
        // var d = new Date();
        // var selectedDatetimeMoment = moment(currentDate);
        // var formattedDate = selectedDatetimeMoment.format('DD MMM YYYY');
        // $('.goalDate').html(formattedDate);
        $.ajax({
            url: public_url + 'calendar/goal-personal-statistics-mob/' + mainName + '/' + personalStatisticId,
            method: "get",
            success: function (data) {
                if(data.data){
                    console.log(data.data.due_date);
                    if(mainName == 'bp_mm'){
                        $('#Goal .staticValue').html(data.data.value);
                        $('#Goal .bp-hg-value').html('/'+data.bp_hg.value);  
                        $('.goal-bp-hg').val(data.bp_hg.value);  
                     } 
                    $('#Goal .staticValue').html(data.data.value);
                    $('.goalStaticEditVal').val(data.data.value);
                    $('.current-date-calendar').val(data.data.due_date);
                    var selectedDatetimeMoment = moment(data.data.due_date);
                    var formattedDate = selectedDatetimeMoment.format('DD MMM YYYY');
                    $('#Goal .goalDate').html(formattedDate);
                } else {
                    $('#Goal .staticValue').html('');  
                    $('#Goal .goalDate').html('');
                }  
            }
        });
        $('#staticEdit').modal('show');
    });

    $(document).on('click','input[name=filterDate]', function(){
        $('#waitingShield').removeClass('hidden');
        var duration = $(this).val();
        var bodypart = $(this).attr('bodypart');
        console.log('bodypart', bodypart);
        $.ajax({
            url: public_url + 'filter-personal-stastic/' + bodypart + '/' + duration,
            method: "get",
            success: function (data) {
                $('#waitingShield').addClass('hidden');
                $(".graph").hide();
                $(".filter-div").show();
                $(".filter-div").html(data)
            }
        });
    })

    $('body').on('click','.savePersonalStats',function(){
        var editItemName = $(this).attr('data-name');
        var formData = {};
        formData['eventDate'] = $('.currentDate').attr('data-val');
        formData['id'] = $('.statistics-main-id').val();
        formData['updated_field'] = editItemName;
        $('.staticEditBtn').each(function(){
            var item_name = $(this).attr('data-mainName');
            if(item_name == editItemName ){
                formData[item_name] = $('.newStaticEditVal').val();
            } else {
                formData[item_name] = $(this).attr('data-val');
            }
        });
        if( formData['updated_field'] == "bp_mm"){
           formData['bp_hg'] = $('.newStaticEditValForHb').val();
        }
        $.post(public_url+'calendar/store-statistics-data-mob',formData,function(response){
            if(response.status == 'ok'){
                swal({
                    type: 'success',
                    title: 'Success!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(isConfirm)
                      location.reload();
                    //    $('#edit_current').modal('hide');
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Error!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(!isConfirm)
                    $('#edit_current').modal('hide');
                });
            }
        },'json');
    });

  $('body').on('click','.saveGoalPersonalStats',function(){
        var editItemName = $(this).attr('data-name');
        var formData = {};
         formData['personalStatisticId'] = $('.statistics-main-id').val();
         formData['due_date'] = $('.current-date-calendar').val();
         formData['field_name'] = editItemName;
         formData['value'] = $('.goalStaticEditVal').val();
         if(formData['field_name'] == 'bp_mm'){
            formData['field_name_bp_hg'] = $('.goal-bp-hg').val();
         }
         /* format */
         var selectedDatetimeMoment = moment($('.current-date-calendar').val());
         var formattedDate = selectedDatetimeMoment.format('DD MMM YYYY');
        /* format */
        $.post(public_url+'calendar/store-goal-statistics-mob',formData,function(response){
            if(response.status == 'ok'){
                swal({
                    type: 'success',
                    title: 'Success!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(isConfirm){
                       $('.goal_tab .staticValue').html( formData['value']);
                       $('.goal_tab .bp-hg-value').html( '/'+formData['field_name_bp_hg']);  
                       $('.goalDate').html(formattedDate);
                       $('#add_goal').modal('hide');
                    }
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Error!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(!isConfirm)
                      location.reload();
                });
            }
        },'json');
    });

    $(document).on('click','.edit-popup-save',function(){
        var formData = {};
        formData['id'] = $(this).data('id');
        formData['field'] = $(this).data('field');
        formData['value'] = $('.edit-field-value-'+formData['id']).val();
        if( formData['field'] == "bp_mm"){
           formData['bp_hg'] = $('.edit-field-bp-hg-'+formData['id']).val();
        }
        console.log('formData--', formData);
        $.post(public_url+'calendar/store-list-statistics-data',formData,function(response){
            if(response.status == 'ok'){
                swal({
                    type: 'success',
                    title: 'Success!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(isConfirm)
                      location.reload();
                    //    $('#edit_current').modal('hide');
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Error!',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    text: response.message,
                    showConfirmButton: true,     
                }, 
                function(isConfirm){
                    if(!isConfirm)
                    $('#Edit-popupp-'+formData['id']).modal('hide');
                });
            }
        },'json');
        //   alert('edit-popup-click');
    });

</script>
@stop