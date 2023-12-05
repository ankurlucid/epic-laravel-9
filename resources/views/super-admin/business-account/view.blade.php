@extends('super-admin.layout.master')
@section('page-title')
Business Account	
@stop
@section('title')
    Business Accounts
@stop
@section('required-styles-for-this-page')
   
    <style>
       .table tbody tr:last-child td{
            border-width: 0 1px !important;
       } 

      
    </style>
@endsection
@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Business Accounts list</li>

@endsection
@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Business Account</h6>

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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2">General Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{ isset($businessAccount) ? $businessAccount->name.' '.$businessAccount->last_name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Web Url:</td>
                                            <td>{{ isset($businessAccount) ? url('/').'/login/'.$businessAccount->web_url : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td><a href="mailto:{{ isset($businessAccount) ? $businessAccount->email : '' }}">{{ isset($businessAccount) ? $businessAccount->email : '' }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td>{{ isset($businessAccount) ? $businessAccount->telephone : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Referral:</td>
                                            <td>{{ isset($businessAccount) ? $businessAccount->referral : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Created Date:</td>
                                            <td>{{ isset($businessAccount) ? $businessAccount->created_at->format('d-m-Y H:i:s') : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>What are your expectations?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($businessAccount->client_management == '1')
                                        <tr>
                                            <td>Client Management</td>
                                        </tr>
                                        @endif
                                        @if($businessAccount->business_support == '1')
                                        <tr>
                                            <td>Business Support</td>
                                        </tr>
                                        @endif
                                        @if($businessAccount->Knowledge == '1')
                                        <tr>
                                            <td>Knowledge</td>
                                        </tr>
                                        @endif
                                        @if($businessAccount->resources == '1')
                                        <tr>
                                            <td>Tools &amp; Resources</td>
                                        </tr>
                                        @endif
                                        @if($businessAccount->mentoring == '1')
                                        <tr>
                                            <td>Mentoring</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Verification Status</td>
                                            <td>
                                                @if($businessAccount->confirmed == '0')
                                                <span class="badge bg-warning text-white">In Process</span>
                                                @endif
                                                @if($businessAccount->confirmed == '1')
                                                <span class="badge bg-info text-white">Activated</span>
                                                @endif
                                                @if($businessAccount->confirmed == '2')
                                                <span class="badge bg-warning text-white">Under Review</span>
                                                @endif
                                                @if($businessAccount->confirmed == '3')
                                                <span class="badge bg-warning text-white">On Hold</span>
                                                @endif
                                            </td>
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