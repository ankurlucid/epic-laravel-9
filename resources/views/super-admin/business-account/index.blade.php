@extends('super-admin.layout.master')

@section('title')
    Business Accounts
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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bussiness Accounts</li>

@endsection
@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Business Accounts</h6>

@endsection

@section('content')
{!! displayAlert()!!}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Business Accounts</h5>
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
                <table class="table table-striped table-bordered table-hover table-flush m-t-10" id="accounts-datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Full Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creared Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($businessAccounts as $account)
                        <tr>
                            <td>
                                {{$account->getFullNameAttribute()}}
                            </td>
                            <td>
                               {{$account->email}} 
                            </td>
                            <td>
                               {{$account->created_at->format('d-m-Y H:i:s')}} 
                            </td>
                            <td class="">
                               @if($account->confirmed == '0')
                                <span class="label label-warning">In Process</span>
                                @endif
                                @if($account->confirmed == '1')
                                <span class="label label-info">Activated</span>
                                @endif
                                @if($account->confirmed == '2')
                                <span class="label label-warning">Under Review</span>
                                @endif
                                @if($account->confirmed == '3')
                                <span class="label label-warning">On Hold</span>
                                @endif
                            </td>
                            <td class="center">
                                <div>
                                    <a href="{{route('superadmin.businessAccount.view',['id' => $account->id])}}" class="btn btn-xs btn-default tooltips" data-placement="top" data-original-title="View" ><i class="fa fa-share text-primary"></i></a>
                                    <a class="btn btn-xs btn-default tooltips" href="{{route('superadmin.businessAccount.edit',['id' => $account->id])}}" data-placement="top" data-original-title="Edit">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>
                                    <a class="btn btn-xs btn-default tooltips delLink2" data-del-url="{{route('superadmin.businessAccount.delete',['id' => $account->id])}}">
                                        <i class="fa fa-trash-o text-primary"></i>
                                    </a>
                                    <a class="btn btn-xs btn-default tooltips sendLink" data-send-url="{{route('superadmin.businessAccount.sendConfirmationEmail',['id' => $account->id])}}" data-toggle="tooltip" data-placement="top" title="Send Confirmation Email">
                                        <i class="fa fa-envelope text-primary" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
                @include('includes.partials.paging', ['entity' => $businessAccounts])
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