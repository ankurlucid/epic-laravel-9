@extends('Result.masters.app')

@section('page-title')
<span >Posture Lists</span> 
@stop
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
.delete-image{
    margin-bottom: 20px;
}
.table-striped > tbody > tr:nth-child(2n+1) {
    background-color:#ff572236;
}
.table-hover > tbody > tr:hover > td, .table-hover > tbody > tr:hover > th{
 background-color:#ff572236;
}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {
  background-color: #f64c1e !important;
  border-color: #f64c1e !important;
}
.footer-inner .go-top {
  background-color: #f64c1e !important;
}
.openwebcam{
  background: white !important;
  color: #253746 !important;
  font-size: 34px
}
.zoombox{
  position: absolute;
  top: 68px;
  left: 17px;
}
*{
  touch-action: manipulation;
}
.dataTables_length > label {
  margin-top: 0px;
}
@media(min-width: 768px){
  .openmobcam{
    display: none !important;
}
}
@media(max-width: 767px){
  .image1-posture-pre, .image2-posture-pre, .image3-posture-pre, .image4-posture-pre{
    margin-bottom: 20px;
}
.posture-button {
    float: left;
    width: 100%;
}
.posture-d{
    position: relative !important;
}
.h553{
    height: auto !important;
}
.openmobcam label {
 cursor: pointer;
 margin-top: 15px;
 /* Style as you please, it will become the visible UI component. */
}
.openmobcam label i{
  color: #253746;
  font-size: 34px;
}
.openmobcam input {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
.openwebcam{
  display: none;
}
.zoombox{
  position: relative;
  width: 283px;
  left: 10px;
  height: 95px;
  top: -9px;
  overflow: hidden;
}
#app .app-content{
  overflow-x: hidden;
}
.picCropModel .modal-dialog{
  width: 94%;
}
}

@media(min-width: 768px){
  #toggleCam{
    display: none;
}
}
#webcam{
  margin-left: auto !important;
  margin-right: auto;
}
}
.gridLine{
  text-align: center;
}

#posture-analysis-modal .tablenumber td {
  border: 1px solid gray;
  width: 21px;
  height: 14px;
}
#posture-analysis-modal .h553 {
  /*height: 604px;
  max-width: 338px;*/
}

.image1-posture-pre, .image2-posture-pre, .image3-posture-pre, .image4-posture-pre{
  max-width: 100% !important;
  max-height: 538px;
  min-width: 222px;
}

.h553{
  height: 553px;
  max-width: 222px;
  margin-left: auto;
  margin-right: auto;
  position: relative;
}
#canvasPic {
  background-size: contain;
  background-repeat: no-repeat;
}
#imagessize, #rightimagessize , #leftimagessize, #backimagessize{
  float: left;
}
.size_zoom_image {
  width: 60px;
  height: 60px;
  border: 3px solid #253746;
  position: relative;
  bottom: 66px;
}
.size_zoom_image img{
  width: 100%;

}
.tablenumber{
   border-collapse: collapse;
   /*border: 1px solid gray;*/
   /*  border-left: 1px solid gray;
   border-right: 1px solid gray;*/
   border-top: 1px solid gray;
   font-size: 12px;
}
.tablenumber:first-child tr:first-child td{
  border-top: 2px solid gray;
}
.tablenumber td:nth-child(1){
   border-left: 2px solid gray;
}
.tablenumber td:last-child{
   border-right: 2px solid gray;
}
.tablenumber:last-child tr:last-child td{
  border-bottom: 2px solid gray;
}
.tablenumber td{

   border:1px solid gray;
   width: 14px;
   /* height: 14px;*/
}
tr { border: .4pt }
.tablenumber td:nth-child(4),table td:nth-child(8),table td:nth-child(12){
  border-right:2px solid gray;

}
.tablenumber{
  position: relative;
  z-index: 999;
}
.tablenumber{
   height: 77px;
   min-height: 77px;
   table-layout: fixed;
}

.posture-d{
  position: absolute;
  width: 100%;
}
#data-table_length select{
  padding-top: 0px;
  padding-bottom: 0px;
}

.pac-container{
  z-index: 9999;
}
canvas {
  border: 1px dashed rgb(200, 200, 200);
}
.pac-container{
  z-index: 9999;
}
#recurClassDeleteModal{
  z-index: 99999 !important;
}
canvas {
  border: 1px dashed rgb(200, 200, 200);
}
@media (max-width: 767px){
    section#page-title {
        display: none;
    }
    .main-content {
    padding-top: 65px !important;
    position: relative !important;
}
.modal, .modal-dialog {
    z-index: 99999999 !important;
}


}
.confirm{
    background-color: #ff4401 !important;
}
</style>
@stop
@section('content')
{!! Html::script('result/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js') !!}
<!-- start: acc1 -->
<div class="posture_mobile_top">
        <span>Posture </span> <br>Analysis
    </div>
<div class="panel panel-white">
    <div id="waitingShield" class="text-center" data-slug="" style="display: none">
        <div>
            <i class="fa fa-circle-o-notch"></i>
        </div>
    </div>
    <!-- Start mobile view -->

    
    <div class="posture_mobile_details">
        <h2 class="text-center"><strong>Posture</strong>  List</h2>
        <div class="form-group text-center">
            <a class="btn btn-primary" data-toggle="modal" data-target="#selectPosture" href="#">Add New Posture</a>
        </div>
        <table class="table table-striped table-bordered table-hover m-t-10" id="data-table">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th class="center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postures as $key => $posture)
                <tr>
                    <td> {{ $key + 1 }}  </td>
                    <td>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</td>
                    <td> {{ date('Y-m-d',strtotime($posture['updated_at'])) }} </td>
                    <td class="center">
                        @if(($posture['added_from1'] == 0) && ($posture['added_from4'] == 0) && ($posture['added_from4'] == 0) && ($posture['added_from4'] == 0))
                        <div>
                            <span>Under Review</span>
                        </div>
                        @else
                        <div>
                            <a class="btn btn-xs btn-default tooltips posture-preview" href="javascript:void(0)" data-placement="top" data-original-title="Posture Preview" data-posture-id="{{ $posture['id'] }}" data-client-id="{{ $posture['client_id'] }}">
                                <i class="fa fa-eye" style="color:#f94211;"></i>
                            </a>
                            <a class="btn btn-xs btn-default tooltips " href="{{ url('generate/pdf/'.$posture['id']) }}" data-placement="top" data-original-title="Generate PDF">
                                <i class="fa fa-download" style="color:#f94211;"></i>
                            </a>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary go-back float-right hidden-sm hidden-md hidden-lg backtopage view-back-btn" style="display: none;float: right" href="javascript:void(0)" ><i class="fa fa-long-arrow-left"></i>  Back</a>
        <div class="view-posture hidden  posture-mob-design"></div>
    </div>
    <div id="selectPosture" class="modal fade mobile_popup_fixed"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animate-bottom">
                <div class="">
                    <button type="button" class="close selectPostureClass" data-dismiss="modal">×</button>
                    <h4 class="posture_model_heading"><strong>Select</strong> Posture photo</h4>
                </div>
                <div class="select_posture_position">
                    <div class="form-group text-center">
                        <button class="select_all">Select all</button>
                    </div>
                    <ul>
                        <li>
                            <input type="checkbox" name="" id="frontView">
                            <label for="frontView">Front <span>View</span></label>
                        </li>
                        <li>
                            <input type="checkbox" name="" id="rightView">
                            <label for="rightView">Right <span>View</span></label>
                        </li>
                        <li>
                            <input type="checkbox" name="" id="backView">
                            <label for="backView">Back <span>View</span></label>
                        </li>
                        <li>
                            <input type="checkbox" name="" id="leftView">
                            <label for="leftView">Left <span>View</span></label>
                        </li>
                    </ul>
                    <h3>Additional:</h3>
                    <ul>
                        <li>
                            <input type="checkbox" name="" id="BentOver">
                            <label for="BentOver">Bent Over <span>View</span></label>
                        </li>
                        <li>
                            <input type="checkbox" name="" id="SeatedRight">
                            <label for="SeatedRight">Seated Right <span>View</span></label>
                        </li>
                        <li>
                            <input type="checkbox" name="" id="SeatedLeft">
                            <label for="SeatedLeft">Seated Left <span>View</span></label>
                        </li>
                    </ul>
                    <div class="form-group">
                        <div class="text-center">

                            <button type="button" class="btn cancl-btn selectPostureClass posture-btn" data-dismiss="modal">Close</button>
                            <button type="button" id="saveBtnView" class="btn btn-primary posture-btn" data-toggle="modal" data-target="#postureMobileStep" >Done</button>

                          <!--   <button type="button" class="btn cancl-btn posture-btn" data-dismiss="modal">Close</button>
                            <button type="button" id="saveBtnView" class="btn btn-primary posture-btn" data-toggle="modal" data-target="#postureMobileStep" >Done</button> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="postureMobileStep" class="modal fade mobile_popup_fixed"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animate-bottom">
                <div class="">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="posture_model_heading m-0 theme-gray"><strong>Epic Fit</strong> Posture plus</h4>
                </div>
                <div class="posture-step-mobile">
                    <div id="" class="swMain">
                        <div id="step-1" class="posture_step">   
                            <div class="posture_view">
                                <h4 class="theme-gray">FRONT VIEW</h4>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/front-view.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7" style="padding-left: 0px;">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group posture-button">
                                            <div class="text-center">
                                               <!--  <button type="button" class="btn-primary capture-btn">Capture</button> -->

                                                <input type="hidden" name="postureimage" value="">
                                                <input type="hidden" name="posture_id" value="">
                                                <input type="hidden" name="image_name" value="image1">
                                                <label class="btn capture-btn">
                                                  <span>Capture</span> <input type="file" class="hidden" name="image1" data-save="no" onchange="postureFile(this)" accept="image/*">
                                                  </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="posture_step">
                            <div class="posture_view">
                               <h4 class="theme-gray">Right View</h4>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/right-view.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7" style="padding-left: 0px;">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group">
                                            <div class="text-center posture-button">
                                              <!--   <button type="button" class="btn-primary capture-btn">Capture</button> -->

                                                <input type="hidden" name="postureimage" value="">
                                                <input type="hidden" name="posture_id" value="">
                                                <input type="hidden" name="image_name" value="image2">
                                                <label class="btn capture-btn">
                                                  <span>Capture</span> <input type="file" class="hidden" name="image2" data-save="no" onchange="postureFile(this)" accept="image/*">
                                                  </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                        <div id="step-3" class="posture_step">
                            <div class="posture_view">
                                <h4 class="theme-gray">Back View</h4>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/back-view.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7" style="padding-left: 0px;">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group">
                                            <div class="text-center posture-button">
                                             <!--    <button type="button" class="btn-primary capture-btn">Capture</button> -->

                                                <input type="hidden" name="postureimage" value="">
                                                <input type="hidden" name="posture_id" value="">
                                                <input type="hidden" name="image_name" value="image3">
                                                <label class="btn capture-btn">
                                                  <span>Capture</span> <input type="file" class="hidden" name="image3" data-save="no" onchange="postureFile(this)" accept="image/*">
                                                  </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" class="posture_step">
                            <div class="posture_view">
                                <h4 class="theme-gray">Left View</h4>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/left-view.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7" style="padding-left: 0px;">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group">
                                            <div class="text-center posture-button">
                                               <!--  <button type="button" class="btn-primary capture-btn">Capture</button> -->

                                                <input type="hidden" name="postureimage" value="">
                                                <input type="hidden" name="posture_id" value="">
                                                <input type="hidden" name="image_name" value="image4">
                                                <label class="btn capture-btn">
                                                  <span>Capture</span> <input type="file" class="hidden" name="image4" data-save="no" onchange="postureFile(this)" accept="image/*">
                                                  </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <!-- <div id="step-5" class="posture_step">
                            <div class="posture_view">
                                <h2>Left View</h2>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/left-view-1.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button type="button" class="round_btn btn-primary">Capture</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <div id="step-6" class="posture_step">
                            <div class="posture_view">
                                <h2>Seated View</h2>
                                <div class="row">
                                    <div class="col-md-5  col-sm-5  col-xs-5 ">
                                        <img src="{{asset('result/images/seated-view.jpg')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>To ensure that you get an accurate representation of posture you need to ensure that you are relaxed and not trying to correect your natural posture if you are aware of inconsistencies.</p>
                                        <p>Stand facing the camera March in position shaking and relazxing arms stop and place arms and feet in comfortable position.</p>
                                        <p>Take the photo ensuring the camera is square with horizan and that the whole individal is in the photo.</p>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button type="button" class="round_btn btn-primary">Capture</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div> -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Start mobile view -->
<!-- start: PANEL BODY -->
<div class="panel-body">
    <div class="row review-mode">

      <div class="posture-list hide-mobile">
        <div class="col-xs-12" style="margin-bottom: 10px;">
          <a class="btn btn-primary add-posture" style="float:right"  href="javascript:void(0)">Add New Posture</a>
      </div>
      <table class="table table-striped table-bordered table-hover m-t-10" id="data-table">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Date</th>
              <th class="center">Actions</th>
          </tr>
      </thead>
      <tbody>
         @foreach ($postures as $key => $posture)
         <tr>
            <td> {{ $key + 1 }}  </td>
            <td>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</td>
            <td> {{ date('Y-m-d',strtotime($posture['updated_at'])) }} </td>
            <td class="center">
              @if(($posture['added_from1'] == 0) && ($posture['added_from4'] == 0) && ($posture['added_from4'] == 0) && ($posture['added_from4'] == 0))
              <div>
                <span>Under Review</span>
            </div>
            @else
            <div>
                <a class="btn btn-xs btn-default tooltips posture-preview" href="javascript:void(0)" data-placement="top" data-original-title="Posture Preview" data-posture-id="{{ $posture['id'] }}" data-client-id="{{ $posture['client_id'] }}">
                   <i class="fa fa-eye" style="color:#f94211;"></i>
               </a>
               <a class="btn btn-xs btn-default tooltips " href="{{ url('generate/pdf/'.$posture['id']) }}" data-placement="top" data-original-title="Generate PDF">
                   <i class="fa fa-download" style="color:#f94211;"></i>
               </a>
           </div>
           @endif

       </td>
   </tr> 

   @endforeach
</tbody>
</table>
</div>
<div class="create-posture hidden">
   @include('Result.posture.create-posture')
</div>

      

</div>

<a class="btn btn-primary go-back float-right hidden-sm hidden-md hidden-lg backtopage view-back-btn hide-mobile" style="display: none;float: right" href="javascript:void(0)" ><i class="fa fa-long-arrow-left"></i>  Back</a>
        <div class="view-posture hidden  posture-mob-design hide-mobile"></div>
</div>
<div class="modal fade" id="webcam-modal">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close close-webcam" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Click a Picture</h4>
     </div>
     <div class="modal-body">
         <div id="webcam" class="center_line" style="margin-left:112px;"></div>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-info" id="toggleCam" data-toggle="environment">Change to front</button>
         <button type="button" class="btn btn-default close-webcam">Cancel</button>
         <button type="button" class="btn btn-info takesnapshot">Take picture</button>
     </div>
 </div>
</div>
</div>
<!-- end: PANEL BODY -->
</div>
@endsection

@section('required-script')
{!! Html::script('assets/js/posture.js?v='.time()) !!}
{!! Html::script('assets/plugins/Jcrop/js/posture-script.js?v='.time()) !!}
<script>

  jQuery(document).ready(function() {
    $('#data-table').DataTable({searching: false});
});


$(document).on('click','.selectPostureClass',function(){
    uncheckAllSteps();
});

  $(document).on('click','.add-posture',function(){
    $(".posture-list").addClass('hidden');
    $(".create-posture").removeClass('hidden');
});

$(document).on('click','.select_all',function(){
    $("#frontView").prop('checked', true);
    $("#rightView").prop('checked', true);
    $("#backView").prop('checked', true);
    $("#leftView").prop('checked', true);
});

$(document).on('click','#saveBtnView',function(){
    hideAllSteps();
    if($('#frontView').is(":checked")){
        $('#step-1').show();
        return false;
    }else if($('#rightView').is(":checked")){
        $('#step-2').show();
        return false;
    }else if($('#backView').is(":checked")){
        $('#step-3').show();
        return false;
    }else if($('#leftView').is(":checked")){
        $('#step-4').show();
        return false;
    }else{
        uncheckAllSteps();
        resetAllImageSaveData();
        $("#postureMobileStep").modal('hide');
        $('#selectPosture').modal('hide');
    }
});

function hideAllSteps(){
    $("#step-1").hide();
    $("#step-2").hide();
    $("#step-3").hide();
    $("#step-4").hide();
}

function uncheckAllSteps(){
    $("#frontView").prop('checked', false);
    $("#rightView").prop('checked', false);
    $("#backView").prop('checked', false);
    $("#leftView").prop('checked', false); 
}

function resetAllImageSaveData(){
    $('input[type="file"][name="image1"]').data('save', 'no');
    $('input[type="file"][name="image2"]').data('save', 'no');
    $('input[type="file"][name="image3"]').data('save', 'no');
    $('input[type="file"][name="image4"]').data('save', 'no');
}

function forMobileStepsShowHide(image_name){
    $('input[type="file"][name="'+image_name+'"]').data('save', 'yes');

    if($('#frontView').is(":checked") && $('input[type="file"][name="image1"]').data('save') == 'no' ){
        hideAllSteps();
        $('#step-1').show();
    }else if($('#rightView').is(":checked") && $('input[type="file"][name="image2"]').data('save') == 'no'){
        hideAllSteps();
        $('#step-2').show();
    }else if($('#backView').is(":checked") && $('input[type="file"][name="image3"]').data('save') == 'no'){
        hideAllSteps();
        $('#step-3').show();
    }else if($('#leftView').is(":checked") && $('input[type="file"][name="image4"]').data('save') == 'no'){
        hideAllSteps();
        $('#step-4').show();
    }else{
        hideAllSteps();
        uncheckAllSteps();
        resetAllImageSaveData();
        $("#postureMobileStep").modal('hide');
        $('#selectPosture').modal('hide');
        window.location.reload();
    }
    
    $('#postureMobileStep').animate({ scrollTop: 0 }, 'slow');
}
  function postureFile(elem) {
	// get selected file
	var oFile = elem.files[0];
   if(oFile){
       public_url = $('meta[name="public_url"]').attr('content');

       var formGroup = $(elem).closest('.posture-button')
       var image_name = formGroup.find('input[name="image_name"]').val();
       var prePhotoName = formGroup.find('input[name="postureimage"]');
       var posture_id = formGroup.find('input[name="posture_id"]').val();
       var previewPics = $('.'+image_name+'-posture-pre');
       var form_data = new FormData();                  
       form_data.append('fileToUpload', oFile);
       $.ajax({
        url: public_url+'posture/image',
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        beforeSend: function(){
      // $("#waitingShield").show();
      $("#waitingShield").removeClass('hidden');
  },
  success: function(response){
      formData = {};
      formData['posture_id'] = posture_id;
      formData['photoName'] = response;
      formData['image_name'] = image_name;
      $.ajax({
         url: public_url+'save/posture/image',
         data: formData,                         
         method: 'POST',
         beforeSend: function(){
            $("#waitingShield").removeClass('hidden');
        // $("#waitingShield").show();
    },
    success:function(res) {
        $(".delete-image").attr('data-posture-id',res.posture_id);
        $(elem).parent().siblings(".delete-image").attr('data-image-name',image_name);
        if(res.status == 'create'){
           $('input[name="posture_id"]').val(res.posture_id);
           $("#posture-analysis").attr('data-posture-id',res.posture_id);
       }
       $('.'+image_name+'-grid').addClass('hidden');
       previewPics.prop('src', public_url+'posture-images/'+response);

       if($('.posture_mobile_details').is(':visible')) //for mobile view steps
       forMobileStepsShowHide(image_name); 
   
       swal(res.msg);
       destroyJcrop()
   },
   complete: function(){
      setTimeout(function() {
        $("#waitingShield").addClass('hidden');
        $('input[type="file"][name="'+image_name+'"]').val('');
        // $("#waitingShield").hide();
    },2000);
  }
});
  },
  complete: function(){
   setTimeout(function() {
    $("#waitingShield").addClass('hidden');
    $('input[type="file"][name="'+image_name+'"]').val('');
      //  $("#waitingShield").hide();
  },2000);
}
});
   }
};


var constraints = {
  video: true,
  facingMode: "environment"
};
Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90,
  constraints: constraints,
});
$('#toggleCam').on('click',function(){
  var cam =$(this).data('toggle');
  Webcam.reset( '#webcam' );
  if(cam == 'environment'){
    $(this).empty('').text('Change to rear');
    $(this).data('toggle','user');
    var constraints = {
      video: true,
      facingMode: "user"
  };
}else{
    $(this).empty('').text('Change to front');
    $(this).data('toggle','environment');
    var constraints = {
      video: true,
      facingMode: "environment"
  };
}
Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90,
    constraints: constraints,
});
$(this).data('toggle','user');
Webcam.attach('#webcam');
})
var picfrom;
$(document).on('click','.openwebcam', function(e) {
  $('#webcam-modal').modal('show');
  Webcam.attach('#webcam');
  var formGroup = $(this).closest('.posture-button')
  image_name = formGroup.find('input[name="image_name"]').val();
  prePhotoName = formGroup.find('input[name="postureimage"]');
  user_id = formGroup.find('input[name="client_id"]').val();
  posture_id = formGroup.find('input[name="posture_id"]').val();
  previewPics = $('.' + image_name + '-posture-pre');
  picfrom = 'webcamera';
    // cropSelector = formGroup.find('input[name="posturecropSelector"]').val();
    $('.takesnapshot').on('click', function() {
      Webcam.snap(function(data_uri) {
        $.ajax({
          url: public_url+'captcha/image',
          data: { data: data_uri,picfrom:picfrom },                         
          type: 'post',
          beforeSend: function(){
            $("#waitingShield").removeClass('hidden');
            // $("#waitingShield").show();
        },
        success: function(response){
            formData = {};
            formData['posture_id'] = posture_id;
            formData['photoName'] = response;
            formData['image_name'] = image_name;
            $.ajax({
               url: public_url+'save/posture/image',
               data: formData,                         
               method: 'POST',
               beforeSend: function(){
                  $("#waitingShield").removeClass('hidden');
              // $("#waitingShield").show();
          },
          success:function(res) {
              $(".delete-image").attr('data-posture-id',res.posture_id);
              $(".delete-image-"+image_name).attr('data-image-name',image_name);
              // $(".delete-image").attr('data-image-name',image_name);
              if(res.status == 'create'){
                 $('input[name="posture_id"]').val(res.posture_id);
             }
             $('.'+image_name+'-grid').addClass('hidden');
             previewPics.prop('src', public_url+'posture-images/'+response);
             swal(res.msg);
         },
         complete: function(){
            setTimeout(function() {
              $("#waitingShield").addClass('hidden');
              // $("#waitingShield").hide();
          },2000);
        }
    });
        },
        complete: function(){
         setTimeout(function() {
            $("#waitingShield").addClass('hidden');
            //  $("#waitingShield").hide();
        },2000);
     }
 });
        Webcam.reset();
        $('#webcam-modal').modal('hide');
    });
  });
});
$('.close-webcam').click(function() {
  Webcam.reset();
  $('#webcam-modal').modal('hide');
})

$(document).on('click','.save-images',function(){
  swal({
    title: 'Data saved successfully',
    type: 'success',
    allowEscapeKey: false,
		// showCancelButton: true,
		confirmButtonText: 'Ok',
		// cancelButtonText: 'No',
		confirmButtonColor: '#ff4401',
		closeOnConfirm: false
	}, 
	function(isConfirm){
		if(isConfirm){
          swal.close();
          window.location.reload();
      }
  });
})
function fileSelectHandler(elem){
  //  var dataImage = $(this).attr('data-image');
  var formGroup = $(elem).closest('.posture-button');
  // var formGroup = $(elem).closest('.posture-button-'+dataImage);
  console.log(formGroup,$(elem));
  image_name = formGroup.find('input[name="image_name"]').val();
  prePhotoName = formGroup.find('input[name="postureimage"]');
  user_id = formGroup.find('input[name="client_id"]').val();
  posture_id = formGroup.find('input[name="posture_id"]').val();
  previewPics = $('.' + image_name + '-posture-pre');
  var fileUrl = window.URL.createObjectURL(elem.files[0]);
  
  var oFile = elem.files[0];
  var form_data = new FormData();                  
  form_data.append('fileToUpload', oFile);

  $.ajax({
    url: public_url+'captcha/image',
    data: form_data,
    dataType: 'text', 
    type: 'POST',
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function(){
      $("#waitingShield").removeClass('hidden');
      // $("#waitingShield").show();
  },
  success: function(response){
      formData = {};
      formData['posture_id'] = posture_id;
      formData['photoName'] = response;
      formData['image_name'] = image_name;
      $.ajax({
        url: public_url+'save/posture/image',
        data: formData,                         
        method: 'POST',
        beforeSend: function(){
          $("#waitingShield").removeClass('hidden');
          // $("#waitingShield").show();
      },
      success:function(res) {
          $(".delete-image").attr('data-posture-id',res.posture_id);
          $(".delete-image-"+image_name).attr('data-image-name',image_name);
          // $(".delete-image").attr('data-image-name',image_name);
          if(res.status == 'create'){
            $('input[name="posture_id"]').val(res.posture_id);
        }
        $('.'+image_name+'-grid').addClass('hidden');
        previewPics.prop('src', public_url+'posture-images/'+response);
        swal(res.msg);
    },
    complete: function(){
      setTimeout(function() {
        $("#waitingShield").addClass('hidden');
            // $("#waitingShield").hide();
        },2000);
  }
});
  },
  complete: function(){
      setTimeout(function() {
        $("#waitingShield").addClass('hidden');
        // $("#waitingShield").hide();
    },2000);
  }
});
}

//*** Start smartWizard ***
$('#wizard').smartWizard({
  // Properties
    selected: 0,  // Selected Step, 0 = first step   
    keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
    enableAllSteps: false,  // Enable/Disable all steps on first load
    transitionEffect: 'fade', // Effect on navigation, none/fade/slide/slideleft
    contentURL:null, // specifying content url enables ajax content loading
    contentURLData:null, // override ajax query parameters
    contentCache:true, // cache step contents, if false content is fetched always from ajax url
    cycleSteps: false, // cycle step navigation
    enableFinishButton: false, // makes finish button enabled always
    hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
    errorSteps:[],    // array of step numbers to highlighting as error steps
    labelNext:'Next', // label for Next button
    labelPrevious:'Previous', // label for Previous button
    labelFinish:'Finish',  // label for Finish button        
    noForwardJumping:false,
    ajaxType: 'POST',
  // Events
    onLeaveStep: null, // triggers when leaving a step
    onShowStep: null,  // triggers when showing a step
    onFinish: null,  // triggers when Finish button is clicked  
    buttonOrder: ['finish', 'next', 'prev']  // button order, to hide a button remove it from the list
}); 
//*** end smartWizard ***

</script>
@stop
@section('script-handler-for-this-page')


@stop()