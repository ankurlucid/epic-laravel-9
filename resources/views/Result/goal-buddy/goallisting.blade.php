@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v='.time()) !!}
    {!! Html::style('result/plugins/DataTables/media/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('result/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::style('result/plugins/sweetalert/sweet-alert.css') !!} 
    <style type="text/css">
    .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {
        background-color: #f64c1e;
        border-color: #f64c1e;
    }
    .navbar .navbar-header {
        border-bottom: 0px;
    }    
    section#page-title {
        display: none;
    }
    .flexx{
        flex-direction: column!important;
       display: flex;
    }
    .modal-content{
        background: white;
    }
    </style>
@stop
    

@section('content')
{!! displayAlert()!!}
 <!-- start: Delete Form -->
    @include('includes.partials.delete_form')
    <!-- end: Delete Form -->
    <!-- Mobile view start --> 
    <div class="goal_mobile_top">
        <span>Be Smarter</span> <br>Lifestyle Design
    </div>
    <div class="goal_listdetails_mobile">
        <div class="goal-action">
            <div class="col-xs-12 col-sm-12 goal-action-item text-center">
                <i class="ti-plus"></i>
                <a class="create-goal" href="{{ route('goal-buddy.create') }}"> Set New <br> <span>Be Smarter Goal</span></a>
            </div>
            <div class="col-xs-12 col-sm-12 goal-action-item" style="text-align: center;">
                <div class="checkbox clip-check check-primary">
                    <input type="checkbox" name="goal_hide" id="hide-compleate-goal-mob" value="1" class="">
                    <label for="hide-compleate-goal-mob" class="hide-goal" style="text-align: left">Hide Completed Goals</label>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="mobile_list_data">
            <h3 class="title">Be Smarter Goal List</h3>
                @foreach($goals as $goalInfo)
                <div class="goal-row-mob goal-row flexx @if($goalInfo->gb_goal_status == 1) completed @endif" id = "{{$goalInfo->id}}">
                    <input type="hidden" name ="goal_id" id ="goal-id" value ="{{$goalInfo->id}}">
                    <div class="" style="order:1"><a class="goal-name-mob">{{isset($goalInfo->gb_goal_name )?$goalInfo->gb_goal_name :null}}</a>
                        
                    </div> 
                    <div class="" style="order:2">
                        {{ isset($goalInfo->gb_due_date )?dbDateToDateString($goalInfo->gb_due_date):null }}
                    </div>
                    {{-- <div>
                        <div class="progress progress-striped progress-xs" style="margin-bottom:10px" >
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="@if($totalpersent) {{$totalpersent}}  @else {{$totalpersent}} @endif" style="width: @if($totalpersent) {{$totalpersent}}%  @else   {{$totalpersent}}% @endif">
                            </div>
                            <div class="mobileProgerss">{{ round($totalpersent,2) }}% Completed</div>
                        </div>                                
                    </div> --}}
                    <div class="list_action_details list-habit-mob-{{$goalInfo->id}}" style="display: none;order:5">
                        <h3>Milestones</h3>
                        <div class="col-md-12 milestones-mob hide" id="milestones-mob-{{$goalInfo->id}}">
                            <strong>Milestones:</strong>
                            <div class="checkbox clip-check check-primary" style ="">
                                <?php $persent=1; $totalpersent=0; ?>
                                @if(isset($goalInfo->goalBuddyMilestones)) 
                                <?php  $milestonesNo=$goalInfo->goalBuddyMilestones->count();
                                if($milestonesNo > 0 )
                                    $milestonesPercentage=100/$milestonesNo; 
                                ?>
                                @foreach($goalInfo->goalBuddyMilestones as $milestonesInfo)
                                <input type="checkbox" name="milestone_compleate" id="milestone-compleate-{{$milestonesInfo->id}}"<?php echo $milestonesInfo->gb_milestones_status ? ' checked="checked"' : '' ?> value="1" class="milestone-goal-mob" data-milestones-id="{{$milestonesInfo->id}}" data-percentage="{{$milestonesPercentage}}" autocomplete="off" />
                                <label for="milestone-compleate-{{$milestonesInfo->id}}">   <strong>{{$milestonesInfo->gb_milestones_name}}</strong></label>
                                </br>
                                <?php 
                                if($milestonesInfo->gb_milestones_status==1)
                                    $totalpersent+=$milestonesPercentage; ?> 
                                @endforeach 
                                @endif
                            </div>
                        </div>
                        <p><strong>Completed:</strong> <span style="margin-left:30px">01/05</span></p>
                        <div class="habits-mob" id="habit-mob-{{$goalInfo->id}}" data-id="{{$goalInfo->id}}">
                            @if(isset($goalInfo->goalBuddyHabit)) 
                            <table class="table-responsive">
                                <tr>
                                    <th>Habits</th>
                                    <th>Completed</th>
                                    <th>Missed</th>
                                    <th>Success</th>
                                </tr>
                                <input type ="hidden" name ="goal_name" id ="goal-name" value ="{{isset($goalInfo->gb_goal_name )?$goalInfo->gb_goal_name :null}} ">
                                @foreach($goalInfo->goalBuddyHabit as $habitsInfo)
                                <tr>
                                    <td>
                                        <a data-toggle="modal" data-target="#habit-modal" class="listing-habit-name" data="{{ $habitsInfo->id }}"><span>{{$habitsInfo->gb_habit_name}}</span></a>
                                        <span>{{isset($habitsInfo->gb_habit_seen )?$habitsInfo->gb_habit_seen :null}}</span>
                                    </td>
                                    <td>
                                        <span class="completed-habit">{{isset($completed[$habitsInfo->id] )?$completed[$habitsInfo->id] :null}}</span>
                                    </td>
                                    <td>
                                        <span class="missed-habit">{{isset($missed[$habitsInfo->id])?$missed[$habitsInfo->id] :null}}</span>
                                    </td>
                                    <td>
                                        <span class="success-habit">{{ round($success[$habitsInfo->id],2) }}%</span>
                                    </td>
                                </tr>
                                @endforeach 
                            </table>                                    
                            @endif
                        </div>
                    </div>
                    <div style="order:3">
                        <div class="progress progress-striped progress-xs" style="margin-bottom:10px;" >
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="@if($totalpersent) {{$totalpersent}}  @else {{$totalpersent}} @endif" style="width: @if($totalpersent) {{$totalpersent}}%  @else   {{$totalpersent}}% @endif">
                            </div>
                            <div class="mobileProgerss">{{ round($totalpersent,2) }}% Completed</div>
                        </div>                                
                    </div>
                    <div class="listmobile_action" style="order:4">
                        <a class="tooltips" href="{{ route('goal-buddy.edit', $goalInfo->id) }}" data-placement="top" data-original-title="Edit">
                            <i class="fa fa-pencil" style="color:#ff4401;"></i> Edit
                        </a>
                        <a class="tooltips delete-goal-mob" data-entity="goal"  data-placement="top" data-original-title="delete" data = "{{ $goalInfo->id }}" style ="margin-left:15px;">
                            <i class="fa fa-times" style="color:#ff4401;"></i> Delete
                        </a>
                    </div>

                </div>
                @endforeach 
                <!-- start: Paging Links -->
                {!! $goals->render() !!}
                   <!--habit model-->
                   @include('Result.goal-buddy.habitmodel')    
                   <!--habit model-->
                {{-- {{ $goals->links() }} --}}
                <!-- end: Paging Links -->
            </div>
            {{--  --}}
        </div>
        <!-- Mobile view end -->
        <div class="hidemobile">
    <div class="row goal-action" style="text-align: center; display: flex">
        <div class="col-xs-6 col-sm-9 goal-action-item" style="text-align: right;">
          <div class="checkbox clip-check check-primary" style="display: inline-block; margin-top: 13px">
              <input type="checkbox" name="goal_hide" id="hide-compleate-goal" value="1" class="">
              <label for="hide-compleate-goal" class="hide-goal" style="text-align: left"><strong>Hide Completed Goals</strong></label>
          </div>
        </div>

        <div class="col-xs-6 col-sm-3 goal-action-item">
            <div style="margin-right: 15px; display: inline-block; float: right">
                <a class="btn btn-primary hide" href="{{ route('goal-buddy.print') }}" style ="margin-left: 500px;"><i class="ti-printer"></i> Print Goals</a>
                <a class="btn btn-primary pull-right create-goal" style="margin-top: 7px;" href="{{ route('goal-buddy.create') }}"><i class="ti-plus"></i> Set New Goal</a>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                {{-- <table class="table table-striped table-bordered table-hover m-t-10" id="goal-datatable"> --}}

                <table class="table table-striped table-bordered table-hover m-t-10" >
                    <thead>
                        <tr>
                           <th>Goal Name</th>
                            <th>Shared</th>
                            <th>Due Date</th>
                            <th width="19%">Progress</th>
                            <th class="center ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($goals as $goalInfo)
                        <tr class="goal-row  @if($goalInfo->gb_goal_status == 1) completed @endif" id = "{{$goalInfo->id}}">
                        <input type="hidden" name ="goal_id" id ="goal-id" value ="{{$goalInfo->id}}">
                            <td><a class="goal-name">{{isset($goalInfo->gb_goal_name )?$goalInfo->gb_goal_name :null}}</a>
                              <br>
                              <div class="col-md-12 milestones hide" id="milestones-{{$goalInfo->id}}">
                                 <strong>Milestones:</strong>
                                 <!--div class="checkbox clip-check check-primary" style="margin-left: 21px;">
                                                <input type="checkbox" name="goal_compleate" id="goal-compleate-{{$goalInfo->id}}"  @if($goalInfo->gb_goal_status)  checked @endif value="1" class="compleate-goal">
                                                <label for="goal-compleate-{{$goalInfo->id}}"><strong>Goal Completed</strong></label>
                                  </div-->
                                  <div class="checkbox clip-check check-primary" style ="">
                                               <?php $persent=1; $totalpersent=0; ?>
                                           @if(isset($goalInfo->goalBuddyMilestones)) 
                                           <?php  $milestonesNo=$goalInfo->goalBuddyMilestones->count();
                                              
                                                  if($milestonesNo > 0 )
                                                   $milestonesPercentage=100/$milestonesNo; 
                                                 
                                            ?>
                                            @foreach($goalInfo->goalBuddyMilestones as $milestonesInfo)
                                        
                                          <input type="checkbox" name="milestone_compleate" id="milestone-compleate-desktop-{{$milestonesInfo->id}}"<?php echo $milestonesInfo->gb_milestones_status ? ' checked="checked"' : '' ?> value="1" class="milestone-goal" data-milestones-id="{{$milestonesInfo->id}}" data-percentage="{{$milestonesPercentage}}" autocomplete="off" />
                                                  
                                                      <label for="milestone-compleate-desktop-{{$milestonesInfo->id}}"><strong>
                                                     {{$milestonesInfo->gb_milestones_name}}</strong></label>
                                                      </br>
                                                     <?php 
                                             if($milestonesInfo->gb_milestones_status==1)
                                                $totalpersent+=$milestonesPercentage; ?> 
                                                   @endforeach 
                                                  @endif
                                       
                                                
                                  </div>
                                 </div>
                            </td>
                            <td>
                             {{ isset($goalInfo->gb_goal_seen )?$goalInfo->gb_goal_seen :null }} 
                            </td>  
                            <td>
                              {{ isset($goalInfo->gb_due_date )?dbDateToDateString($goalInfo->gb_due_date):null }}
                            </td>
                            <td>
                              <div class="progress progress-striped progress-xs" style="margin-bottom:10px" >
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="@if($totalpersent) {{$totalpersent}}  @else {{$totalpersent}} @endif" style="width: @if($totalpersent) {{$totalpersent}}%  @else   {{$totalpersent}}% @endif">
                                    </div>

                                </div>
                                
                               <p><strong>Milestones:</strong> <span class ="progress-percentage">{{ round($totalpersent,2) }}%</span></p>

                               <div class="col-md-12 habits hide" id="habit-{{$goalInfo->id}}">
                                @if(isset($goalInfo->goalBuddyHabit))  
                                  <strong>Habits:</strong>
                                  <input type ="hidden" name ="goal_name" id ="goal-name" value ="{{isset($goalInfo->gb_goal_name )?$goalInfo->gb_goal_name :null}} ">

                               
                                 @foreach($goalInfo->goalBuddyHabit as $habitsInfo)
                                 <a data-toggle="modal" data-target="#habit-modal-desktop" class="listing-habit-name" data="{{ $habitsInfo->id }}"><span>{{$habitsInfo->gb_habit_name}}</span></a>

                                 <span>{{isset($habitsInfo->gb_habit_seen )?$habitsInfo->gb_habit_seen :null}}</span>
                                  
                                  <p><strong>Completed: </strong><span class="completed-habit">{{isset($completed[$habitsInfo->id] )?$completed[$habitsInfo->id] :null}}</span><br />
                                  <strong>Missed: </strong><span class="missed-habit">{{isset($missed[$habitsInfo->id])?$missed[$habitsInfo->id] :null}}</span><br />
                                  <strong>Success: </strong><span class="success-habit">{{ round($success[$habitsInfo->id],2) }}%</span></p>

                                 @endforeach 
                                 @endif

                                  </div>


                            </td>
                            <td class="center">
                                <div>
                                    <a class="btn btn-xs btn-default tooltips" href="{{ route('goal-buddy.edit', $goalInfo->id) }}" data-placement="top" data-original-title="Edit">
                                            <i class="fa fa-pencil" style="color:#ff4401;"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-xs btn-default tooltips delete-goal" data-entity="goal"  data-placement="top" data-original-title="delete" data = "{{ $goalInfo->id }}" style ="margin-left:57px;margin-top:-43px;">
                                        <i class="fa fa-times" style="color:#ff4401;"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
                    <!-- start: Paging Links -->
                    {!! $goals->render() !!}
                    {{-- {{ $goals->links() }} --}}
                    <!-- end: Paging Links -->

                             <!--habit model-->
                              @include('Result.goal-buddy.habitmodel-desktop')    
                            <!--habit model-->

            </div>
        </div>
    </div>
</div>
</div>
@stop
@section('required-script')
{!! Html::script('result/js/jquery-ui.min.js') !!}

<!-- start: Moment Library -->
{!! Html::script('result/plugins/moment/moment.min.js') !!}
<!-- end: Moment Library -->
 {!! Html::script('result/plugins/bootstrap-select-master/js/bootstrap-select.min.js') !!}
{!! Html::script('result/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}
{!! Html::script('result/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js') !!}  
 {!! Html::script('result/plugins/jquery-validation/jquery.validate.min.js') !!}
{!! Html::script('result/plugins/sweetalert/sweet-alert.min.js') !!} 
{!! Html::script('result/js/form-wizard-goal-buddy.js?v='.time()) !!}
{!! Html::script('result/js/helper.js?v='.time()) !!}
{!! Html::script('result/plugins/DataTables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('result/plugins/DataTables/media/js/dataTableDateSort.js') !!}
{!! Html::script('result/plugins/DataTables/media/js/dataTables.bootstrap.min.js') !!}

{!! Html::script('result/js/goal-buddy.js?v='.time()) !!}

<script>
var cookieSlug = "goal";
$(document).ready(function(){
    $.fn.dataTable.moment('ddd, D MMM YYYY');
    $('#goal-datatable').dataTable({"searching": false, "paging": false, "info": false , "orderable": false});
})

</script>
@stop
