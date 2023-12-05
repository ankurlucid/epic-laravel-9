@extends('Result.masters.app')
@section('required-styles')
<!-- start: Bootstrap datepicker --> 
{!! Html::style('assets/plugins/datepicker/css/datepicker.css?v='.time()) !!}
<!-- end: Bootstrap datepicker -->

{{-- <!-- Start: NEW timepicker css -->  
{!! Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?v='.time()) !!} --}}
<!-- End: NEW timepicker css -->

<!-- Start: NEW datetimepicker css -->
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css?v='.time()) !!}
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/custom-css-style.css?v='.time()) !!}
<!-- End: NEW datetimepicker css -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

{!! Html::style('result/css/custom.css?v='.time()) !!}

<style type="text/css">
    @media (max-width: 767px){
        section#page-title {
            display: none;
        }
        #app > footer{
            display: none;
        }
        .modal, .modal-dialog {
            z-index: 99999999 !important;
        }
    }

    .fasting-color {
        background: #FF571B;
        width: 26px;
        padding: 10px;
    }

    .eating-color {
        background: gray;
        width: 26px;
        padding: 10px;
    }

    .none-color {
        background: #E5E4E2;
        width: 26px;
        padding: 10px;
    }
    .flex-class{
        display: flex;
    }
    .color-info{
        display: flex;
    }

    .progres-bar-orange {
        background: #FF571B;
    }

    .progres-bar-yello {
        
        background: #E5E4E2;
    }

    .progres-bar-gray {
        background: gray;
    }
    .m_date {
        display: flex;
        flex-direction: column-reverse;
    }

    .fasting-start {
        border: 1px solid lightyellow;
    }
    
    .eating-end {
        border: 1px solid lightyellow;
    }
 </style>

@stop
@section('content')
<div class="fasting_mobile_top">
    <h1><span>EPIC </span> Nutrition</h1>
    <h2><span>Intermittent </span> Fasting</h2>
</div>
<div class="panel panel-white">
    <!-- Start mobile view -->
    <div class="fasting_mobile_details">
        <!-- Fasting History Start -->
        <div class="fasting_history">            
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                   <h2 class="mobile-page-heading"><strong>Fasting/Eating</strong> <br>History! </h2> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url($preUrl) }}">Back</a>
                    </div>
                </div>
            </div>       
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Your recent <span class="textChange">Fasting/Eating </span> history for the past 7 days.</label>
                    </div>
                    <div class="color-info">
                        
                            <span class="flex-class">
                                Fasting <div class="fasting-color" style="margin-left:10px"></div>
                            </span>
                            <span class="flex-class" style="margin-left:20px">
                                Eating <div class="eating-color" style="margin-left:10px"></div>    
                            </span>
                            <span class="flex-class" style="margin-left:20px">
                                None <div class="none-color" style="margin-left:10px"></div>    
                            </span>
                        
                    </div>
                    <!-- #c0c0c0 -->

                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div class="tab-pane active fastingTab" id="tabs-2" role="tabpanel">
                            @include('Result.fasting.history-graph.common_view')
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--  Fasting History  End -->
        
    </div>
</div>

<div id="chunkPopup" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animate-bottom chunk-popup-html">
            
        </div>
    </div>
</div>

@stop
@section('required-script')
    <!-- Start:  NEW datetimepicker js -->
{!! Html::script('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js?v='.time()) !!}
<!-- End: NEW datetimepicker js -->

<!-- Start:  NEW timepicker js -->
{!! Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js?v='.time()) !!} -->
<!-- End: NEW timepicker js -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

    // POPUP FOR CHUNK CLASS
    $(document).on('click','.chunk-class',function(){

        var fastingId = $(this).attr('data-id');
        var fastingType = $(this).attr('data-type');
        
        $.ajax({
            method: 'POST',
            url: "{{route('getChunkFastGraph')}}",
            data: {
                'fastingId':fastingId,
                'fastingType':fastingType
            },
            success: function (data) {

                $('.chunk-popup-html').html(data);
                $('#chunkPopup').modal('show');
            }   
        });
    });

    // POPUP FOR CUSTOM CLASS
    $(document).on('click','.custom-method',function(){

        var fastingId = $(this).attr('data-id');
        var fastingType = $(this).attr('data-type');
        
        $.ajax({
            method: 'POST',
            url: "{{route('getCustomFastGraph')}}",
            data: {
                'fastingId':fastingId,
                'fastingType':fastingType
            },
            success: function (data) {

                $('.chunk-popup-html').html(data);
                $('#chunkPopup').modal('show');
            }   
        });
    });

    $(document).on('click','.eating-tab',function(){
       $('.textChange').html('eat'); 
    })

    $(document).on('click','.fasting-tab',function(){
        $('.textChange').html('fast');   
    })
  $(document).on('click', '.arrow-btn-click',function(){
    var date = $(this).attr('data-date');
    var type = $(this).attr('data-btn');
    var graphType = 'fasting';
    $('#waitingShield').removeClass('hidden');
    $.ajax({
          url: public_url + 'filter-fast-graph',
          method: "get",
          data: {'date':date,'type':type,'graphType':graphType},
          success: function(data) {
            $('#waitingShield').addClass('hidden');
              if(data.status == 'ok'){
                
                $(".fastingTab").html(data.html);
                    
              }    
          }
      });
  });

  $(document).on("click",".refreshGraph",function(){

    var sDate = $('.previousDate').attr('data-date');
    var eDate = $('.nextDate').attr('data-date');
    var graphType = 'fasting';
    $('#waitingShield').removeClass('hidden');
    $.ajax({
          url: public_url + 'filter-fast-graph',
          method: "get",
          data: {'sDate':sDate,'eDate':eDate,'graphType':graphType},
          success: function(data) {
            $('#waitingShield').addClass('hidden');
              if(data.status == 'ok'){
                
                $(".fastingTab").html(data.html);
                    
              }    
          }
      });

  });
</script>

@stop