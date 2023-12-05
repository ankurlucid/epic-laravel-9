@extends('super-admin.layout.master')
@section('page-title')
User Limit	
@stop
@section('title')
    User Limit
@stop
@section('required-styles-for-this-page')
   
    <style>
       .table tbody tr:last-child td{
            border-width: 0 1px 1px !important;
       } 
       .table tbody tr td{
            border-width: 0 1px 1px !important;
       } 

      
    </style>
@endsection
@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User Limit list</li>

@endsection
@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">User Limit</h6>

@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
                <div>
                    <h5 class="mb-0">Overview</h5>
                </div>
            </div>
            <div class="card-body p-3">
                <div id="panel_overview" class="tab-pane active">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="user-left">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">General Information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>User Limit(upto):</td>
											<td>{{isset($userLimit)?$userLimit->maximum_users:''}}</td>											
										</tr>
										<tr>
											<td>Price</td>
											<td>${{isset($userLimit) ?$userLimit->price:''}}</td>
										</tr>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop