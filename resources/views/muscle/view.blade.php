@extends('layouts.app')

@section('required-styles-for-this-page')

    <style>
        .numbers{
            color: #fff;
        }
    </style>
@endsection
@section('title', 'Muscles List')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $muscle->title }} Details</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">{{ $muscle->title }}</h6>

@endsection

@section('content')
	<div class="row mt-4">
        <div class="col-lg-12">
            <h3 class="mt-3 mb-2"><span class="text-secondary" style="font-weight: 400;">Muscle Name:</span> {{ $muscle->title }}</h3>
        </div>
        <div class="col-lg-6">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card-body px-5 bg-cover overflow-hidden pb-2" >
                        <img src="{{ $muscle->getMuscleCoverImageUrl() }}" style="width: 100%; height:100%;" />
                    </div>
                </div>
                
                @if( $muscle->region != null)
                <div class="col-md-12">
                    <div class="card bg-gradient-dark mb-4 mt-4 mt-lg-0">
                        <div class="card-body p-3">
                            <div class="numbers">
                                <h5 class="text-white font-weight-bolder mb-0">
                                    Region
                                </h5>
                                
                                    {!!  $muscle->region !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if( $muscle->general_description != null)
                <div class="col-md-12">
                    <div class="card bg-gradient-dark mb-4 mt-4 mt-lg-0">
                        <div class="card-body p-3">
                            <div class="numbers">
                                <h5 class="text-white font-weight-bolder mb-0">
                                    General Description
                                </h5>
                                
                                    {!!  $muscle->general_description !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if( $muscle->related_muscle != null)
                <div class="col-md-12">
                    <div class="card bg-gradient-dark mb-4 mt-4 mt-lg-0">
                        <div class="card-body p-3">
                            <div class="numbers">
                                <h5 class="text-white font-weight-bolder mb-0">
                                    Related Muscle
                                </h5>
                                
                                    {!!  $muscle->related_muscle !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6">

                            @if( $muscle->antagonist != null)
                            <div class="card bg-gradient-dark mb-2 mt-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bolder mb-0">
                                            Antagonist
                                        </h5>
                                        
                                            {!!  $muscle->antagonist !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->common_injuries != null)
                            <div class="card bg-gradient-dark mb-2 mt-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bolder mb-0">
                                            Common Injuries
                                        </h5>
                                        
                                            {!!  $muscle->common_injuries !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->resistance_exercises != null)
                            <div class="card bg-gradient-dark mb-2 mt-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bolder mb-0">
                                            Resistance Exercises
                                        </h5>
                                        
                                            {!!  $muscle->resistance_exercises !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->stretches != null)
                            <div class="card bg-gradient-dark mb-2 mt-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bolder mb-0">
                                            Stretches
                                        </h5>
                                        
                                            {!!  $muscle->stretches !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            @if( $muscle->origin != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Origin
                                        </h5>
                                        
                                            {!!  $muscle->origin !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->insertion != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Insertion
                                        </h5>
                                        
                                            {!!  $muscle->insertion !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->major_arteries != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Major Arteries
                                        </h5>
                                        
                                            {!!  $muscle->major_arteries !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->neural_innervation != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Neural Innervation
                                        </h5>
                                        
                                            {!!  $muscle->neural_innervation !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->concentric != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Concentric
                                        </h5>
                                        
                                            {!!  $muscle->concentric !!}
                                       
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->eccentric != null)

                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Eccentric
                                        </h5>
                                        
                                            {!!  $muscle->eccentric !!}
                                       
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if( $muscle->isometric_function != null)
                            <div class="card bg-gradient-dark mb-1 mt-1 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="numbers">
                                        <h5 class="text-white font-weight-bold mb-0">
                                            Isometric Function
                                        </h5>
                                       
                                            {!!  $muscle->isometric_function !!}
                                        
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 overflow-hidden">
                    <img src="{{ $muscle->getMuscleImageUrl() }}"  style="width: 100%; height: 100%;" />
                </div>
            </div>
        </div>
    </div>
    
@endsection
  
@section('required-script-for-this-page')
<script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>
  
@endsection