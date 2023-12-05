@extends('layouts.app')
@section('required-styles-for-this-page')
   <style>
       .custom_btn_css{

            padding:1px 5px !important;
            background: #fff !important;
            font-size: 11px !important;
            border:1px solid #c8c7cc !important;
            border-radius: 3px !important;
       } 

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      thead th{
        padding: 0.75rem 1.5rem;
        opacity: .7;
        font-weight: bolder;
        color: #7b809a;
        text-transform: uppercase;
        font-size: 0.65rem
      }
    </style>
@endsection
@section('title', 'Dashboard')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Client list</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Recipe list</h6>

@endsection

@section('content')

  @include('includes.partials.delete_form')

<div class="d-sm-flex justify-content-between">
    <div>
        <h4 class="text-dark">Recipe List</h4>
    </div>
    <div>
       
        <a class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" href="{{ route('meals.create') }}">
            Add Recipe
        </a>
        <a class="btn btn-icon btn-outline-dark ms-2" href="">
            <i class="fa fa-plus text-xs position-relative"></i>
            Select CSV File
        </a>
        
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {!! Form::open(['url' => Request::url(), 'method' => 'get', 'class'=>'']) !!}
                <div class="row">
                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-6" style="padding-right: 0px !important;">
                                <div class="form-group">
                                    <select class="form-select border border-2 p-2" name="filter" data-style="select-with-transition" title=""
                                        data-size="100" style="height: 37px;border-radius: 0px;"> 
                                        <option value="">--Select--</option>
                                        @foreach($mealCategories as $mealCategory)
                                          <option value="{{$mealCategory->name}}" {{Request::get('filter') == $mealCategory->name?'selected':''}}>{{$mealCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 0px !important;">
                                <button class="btn btn-dark pull-left" type="submit" style="border-radius: 0px;">Filter</button> 
                                @if(Request::get('filter'))
                                    <a class="btn btn-dark" style="border-radius: 0px;" href="{{ Request::url() }}">
                                        Clear
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-right: 0px !important;">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" style="height: 37px;border-radius: 0px;">
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px !important;">
                            <button class="btn btn-dark pull-left" style="border-radius: 0px;">Search</button> 
                            @if(Request::get('search'))
                              <a class="btn btn-dark" style="border-radius: 0px;" href="{{ Request::url() }}">
                                  Clear
                              </a>
                            @endif
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible text-white mx-4" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif        
            <div class="table-responsive">
                 <input type="hidden" name="operateAsClient" value="">

                <table class=" table-striped" id="datatable-search">
                    <thead class="thead-light">
                        <th class="center mw-70 w70" width="7%">Photo</th>
                        <th width="15%">Recipe Name</th>
                        <th width="40%">Recipe Description</th>
                        <th width="15%">Recipe Category</th>
                        <th width="15%">Staff</th>
                      <th width="8%" class="center">Actions</th>
                    </thead>
                    <tbody>
                        @if(!$meals->isEmpty())
                        @foreach($meals as $mealInfo)
                            <tr data-status="{{  strtolower( $mealInfo->id ) }}" data-id="{{ $mealInfo->id }}">
                                <td style="padding: 0.75rem 1.5rem;">
                                    <div class="d-flex text-xs align-items-center">
                                        @php 
                                            $mealImg = $mealInfo->mealimages()->pluck('mmi_img_name')->first();
                                        @endphp
                                        <img src="{{ dpSrc($mealImg) }}" alt="{{ $mealInfo->mealname }}" class="mw-50 mh-50" style="max-width: 50px; max-height: 50px;"/>
                                    </div>
                                </td>
                                <td class="text-xs font-weight-normal">
                                    {{ $mealInfo->name ?? ''}}
                                </td>
                                <td class="text-xs">
                                    {!! $mealInfo->description ?? '' !!}
                                </td>
                                <td class="text-xs font-weight-normal">
                                    @php
                                        $catName = '';
                                        if(count($mealInfo->categories)){
                                          $i = 0;
                                          foreach ($mealInfo->categories as $mealcat) {
                                            if($i == 0)
                                              $catName .= $mealcat->name;
                                            else
                                              $catName .= ', '.$mealcat->name;
                                            $i++;
                                          }
                                        }
                                    @endphp
                                  {{ $catName }}
                                </td>
                                <td class="text-xs font-weight-normal">
                                    {{$mealInfo->staff->fullName ?? '--'}}
                                </td>
                                
                                <td>
                                    <div>
                                        <button class="btn btn-xs custom_btn_css btn-default tooltips viewModal" data-id="{{$mealInfo->id}}">
                                            <i class="fa fa-share text-primary" style="color:#253746;"></i>
                                        </button>
                                        <a class="btn btn-xs btn-default custom_btn_css tooltips " href="{{ route('meals.download', $mealInfo->id) }}" data-placement="top" data-original-title="Download">
                                          <i class="fa fa-download" style="color:#253746;"></i>
                                        </a>
                                        <a class="btn btn-xs btn-default custom_btn_css tooltips " href="{{ route('meals.edit', $mealInfo->id) }}" data-placement="top" data-original-title="Edit">
                                            <i class="fa fa-pencil" style="color:#253746;"></i>
                                        </a>
                                        <a class="btn btn-xs btn-default custom_btn_css tooltips delLink" href="{{ route('meals.destroy', $mealInfo->id) }}" data-placement="top" data-original-title="Delete" data-entity="Meal">
                                            <i class="fa fa-trash-o" style="color:#253746;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                                    
                @include('includes.partials.paging', ['entity' => $meals])
            </div>         
        </div>
    </div>
</div>

<div class="modal fade model-design" id="viewmealsmodal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Recipe Details</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body bg-white">
            <div class="breakfast_view">
              <h1 id="recipeTitle"></h1>
              <img src="" class="mainimg" id="mealImage">
              <div class="description_section">
                  <ul>
                      <li>
                          <div class="icon">
                            <img src="{{asset('assets/images/discription-icon.png')}}">
                          </div>
                          <div class="right_hd">
                              <h3>Description</h3>
                          </div>
                      </li>
                      <li>
                          <div class="icon">
                              <img src="{{asset('assets/images/time-icon.png')}}">
                          </div>
                            {{-- <h4>Prep<br>Time</h4> --}}
                            <h4>Time</h4>
                            <div class="right_hd">
                              <span id="preprationTimeHrs" class="value"></span>
                              <span class="time-hrs"  style="display: none">Hour</span>
                              <span id="preprationTime" class="value"></span>
                              <span class="time-min" style="display: none">Minutes</span>
                            </div>
                          {{-- <div class="right_hd">
                              <span id="preprationTime" class="value"></span>
                              <span>Minutes</span>
                          </div> --}}
                      </li>
                      <li>
                          <div class="icon">
                            <img src="{{asset('assets/images/serving-icon.png')}}">
                          </div>
                            <h4>Serving Size</h4>
                          <div class="right_hd">
                              <span id="servingSize" class="value"></span>
                          </div>
                      </li>
                  </ul>
                  <div class="description_data class-name-text">
                  </div>
              </div>
              <div class="bottom_data">
                 
              </div>
                <div class="bootom_area">
                    <h3><span>Calories:</span><span id="calories"></span></h3>
                    <p id="nutriData"></p>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
   


@endsection

@section('script-after-page-handler')
    
    <script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('theme') }}/js/plugins/datatables.js"></script>
     {!! Html::script('assets/js/helper.js') !!}
    {!! Html::script('assets/js/meal-planner.js') !!}
    <script>
        var cookieSlug = "client";
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: false,
            fixedHeight: false,
        });

        $(document).ready(function() {
            
            $('.dataTable-bottom').remove()
        });

    </script>
 <script>
    /* uplode excel file */
    function excelFileHandler($this){
      toggleWaitShield("show");
      var elem = $($this),
          files = elem[0].files,
          formData = new FormData();

      $.each(files, function(key, value){
        formData.append(key, value);
      });
      formData.append('import-type',elem.data('import-type'));
      $.ajax({
        url: public_url+'excel-to-db',
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(response){
          toggleWaitShield("hide");
          uplodePopup(response.status, response.msg)
        }
      });
    }

    function uplodePopup(status, msg){
      swal({
        title: msg,
        type: (status=='success')?"success":"error",
        showCancelButton: false,
        confirmButtonColor: "#253746",
        confirmButtonText: "Ok",
        allowOutsideClick: true
      }, 
      function(){
        // for success
      });
    }
  </script>

</script>

@endsection
