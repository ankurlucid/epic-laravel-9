@extends('super-admin.layout.master')

@section('title')
    Users Limit
@stop
@section('required-styles-for-this-page')
   
    <style>
       .center{
            text-align: center;
       } 

      
    </style>
@endsection
@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users Limit</li>

@endsection
@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Users Limit</h6>

@endsection

@section('content')
{!! displayAlert()!!}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="mb-0">Users Limit</h5>
                    </div>
                    <div class="col-md-3" style="padding-right: 0px !important;">
                        {!! Form::open(['url' => Request::url(), 'method' => 'get', 'class'=>'']) !!}
                        <div class="input-group input-group-outline">
                            <label class="form-label">Search</label>
                            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="height: 37px;border-radius: 0px;">
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px !important;">
                        <button class="btn btn-dark pull-left" style="border-radius: 0px;" type="submit">Search</button>
                        @if(Request::get('search'))
                            <a class="btn btn-dark" style="border-radius: 0px;" href="{{ Request::url() }}">
                                Clear
                            </a>
                        @endif
                        {!! Form::close() !!} 
                    </div>
                    <div class="col-md-3 text-end">
                        <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('users-limit.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add User Limit</a>
                    </div>
                </div>
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
                <table class="table table-striped table-bordered table-hover m-t-10" id="accounts-datatable">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Users(upto)</th>
                            <th>Price</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userLimits as $userLimit)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                               {{$userLimit->maximum_users}} 
                            </td>
                            <td>
                               {{$userLimit->price}}
                            </td>
                            <td class="center">
                                <div>
                                    <a href="{{route('users-limit.show',['users_limit' => $userLimit->id])}}" class="btn btn-xs btn-default tooltips" data-placement="top" data-original-title="View" ><i class="fa fa-share text-primary"></i></a>
                                    <a class="btn btn-xs btn-default tooltips" href="{{route('users-limit.edit',['users_limit' => $userLimit->id])}}" data-placement="top" data-original-title="Edit">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>
                                    <a class="btn btn-xs btn-default tooltips delLink" data-del-url="{{route('users-limit.delete',['id' => $userLimit->id])}}" data-placement="top" data-original-title="Delete" data-entity="contact">
                                        <i class="fa fa-trash-o text-primary"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
                @include('includes.partials.paging', ['entity' => $userLimits])
              </div>
            </div>
        </div>
    </div>

@stop
@section('script-after-page-handler')
<script>
var cookieSlug = "contact";
    $.fn.dataTable.moment('ddd, D MMM YYYY');
    $('#accounts-datatable').dataTable({"searching": false, "paging": false, "info": false });
</script>
{!! Html::script('assets/js/helper.js') !!}
@stop