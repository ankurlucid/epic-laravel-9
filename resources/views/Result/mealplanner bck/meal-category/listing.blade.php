@extends('masters.app')
@section('required-styles')
    {!! Html::style('css/custom.css?v='.time()) !!}
    {!! Html::style('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css?v='.time()) !!}
    {!! Html::style('plugins/sweetalert/sweet-alert.css?v='.time()) !!} 
@stop
    

@section('content')
{!! displayAlert()!!}
 <!-- start: Delete Form -->
    @include('partials.delete_form')
    <!-- end: Delete Form --> 


    <div class="row" style="text-align: center">
        <div class="col-sm-3">
            <div style="margin-left: 15px;display: inline-block;margin-top: 16px;float: left;">Meal Categories list ({{count($mealsCategory)}})</div>
        </div>

        <div class="col-sm-6">
          <div class="checkbox clip-check check-primary" style="display: inline-block; margin-top: 13px">
              
          </div>
        </div>

        <div class="col-sm-3">
            <div style="margin-right: 15px; display: inline-block; float: right">
                <a class="btn btn-primary hide" href="" style ="margin-left: 500px;"><i class="ti-printer"></i> Print Meals</a>
                <a class="btn btn-primary pull-right create-goal" style="margin-top: 7px;" href="{{ route('meal-category.create') }}"><i class="ti-plus"></i> Add New Meal Category</a>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table table-striped table-bordered table-hover m-t-10" id="mp-datatable">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>                         
                            <th class="" width="19%">Created Date</th>
                            <th class="center ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>                   
                      <?php $i = ($mealsCategory->currentPage() - 1) * $mealsCategory->perPage() + 1; ?>
                      
                     @foreach($mealsCategory as $mealcat)
                        <tr class="meal-row" id = "{{ $mealcat->id }}">
                          <input type="hidden" name ="id" id ="cat_id" value ="{{$mealcat->id}}">
                          <td>
                            <a class="id"><?php echo $i;?></a>
                          </td>
                          <td>
                            {{$mealcat->mealcategoryDesc}}
                          </td>                                                  
                          <td>
                            {{setLocalToBusinessTimeZone($mealcat->created_date, 'dateString')}}
                          </td>
                          <td class="center">
                            <div>
                              
                              <a class="btn btn-xs btn-default tooltips edit-meal" href="{{ route('meal-categories.edit',$mealcat->id) }}" data-placement="top" data-original-title="Edit">
                                      <i class="fa fa-pencil" style="color:#ff4401;"></i>
                                  </a>
                              <a class="btn btn-xs btn-default tooltips delete-mealcat" data-entity="mealcat"  data-placement="top" data-original-title="delete" data = "{{ $mealcat->id }}" style ="">
                                  <i class="fa fa-times" style="color:#ff4401;"></i>
                              </a>
                            </div>
                                <div>

                                </div>
                            </td>
                        </tr> 
                        <?php $i++; ?>
                      @endforeach 
                    </tbody>
                </table>
                  

            </div>
        </div>
    </div>
    <div class="pull-right">
      {{ $mealsCategory->links() }}
    </div>
</div>
@stop
@section('required-script')
{!! Html::script('js/jquery-ui.min.js?v='.time()) !!}

{!! Html::script('plugins/bootstrap-select-master/js/bootstrap-select.min.js?v='.time()) !!}
{!! Html::script('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js?v='.time()) !!}
 {!! Html::script('plugins/jquery-validation/jquery.validate.min.js?v='.time()) !!}
{!! Html::script('plugins/sweetalert/sweet-alert.min.js?v='.time()) !!} 
{!! Html::script('js/helper.js?v='.time()) !!}
{!! Html::script('js/meal-planner.js?v='.time()) !!}

<script>
var cookieSlug = "";
$.fn.dataTable.moment('ddd, D MMM YYYY');
$('#mp-datatable').dataTable({"searching": false, "paging": false, "info": false }); 
jQuery(document).ready(function() {
 
})
</script>
@stop
