@extends('super-admin.layout.master')

@section('page-title')
   Edit Business
@stop
@section('title')
    Edit Business
@stop
@section('required-styles-for-this-page')
   
    <style>
      
    	.form-control{
    		border: 1px solid #d2d6da !important;
    		padding: 0.5rem 0.5rem;
    	}

    	fieldset {
		    background: #ffffff !important;
		    border: 1px solid #e6e8e8 !important;
		    border-radius: 5px !important;
		    margin: 20px 0 20px 0 !important;
		    padding: 25px !important;
		    position: relative !important;
		}
      
      	.strong {
    		font-weight: bold;
		}

		label, .form-label{
			margin-bottom: 0.2rem !important;
		}
    </style>
@endsection
@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Business Accounts list</li>

@endsection
@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Edit Business Account</h6>

@endsection
@section('content')
    @include('super-admin.business-account.form')
@stop