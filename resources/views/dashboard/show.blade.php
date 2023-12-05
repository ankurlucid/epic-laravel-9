@extends('layouts.app')
@section('required-styles-for-this-page')
    <link id="pagestyle" href="{{ asset('theme') }}/css/custom.css?v={{ rand() }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <link id="pagestyle" href="{{ asset('theme') }}/js/plugins/Jcrop/css/jquery.Jcrop.min.css?v={{ rand() }}" rel="stylesheet" />
    <style>
    /* ---------------------------------------------------------------------- */
        /*  Chartjs
    /* ---------------------------------------------------------------------- */
        .chart-legend>ul {
            list-style-type: none;
            padding-left: 0;
        }

        .chart-legend>ul li {
            clear: both;
            display: inline-block;
            float: left;
            padding: 10px;
            line-height: 25px;
            font-size: 11px;
        }

        .chart-legend>ul li span {
            display: block;
            float: left;
            height: 25px;
            margin-right: 10px;
            width: 25px;
        }

        .legend-xs .chart-legend>ul li {
            line-height: 15px;
        }

        .legend-xs .chart-legend>ul li span {
            height: 15px;
            width: 15px;
            margin-right: 5px;
        }

        .inline .chart-legend>ul li {
            clear: none;
            display: inline-block;
            float: none;
            padding: 10px;
        }

        .full-width {
            max-width: 100% !important;
        }

        .mini-pie {
            height: 170px;
            position: relative;
            width: 300px;
            display: inline-block;
        }

        .mini-pie canvas {
            height: 300px;
            left: 0;
            position: absolute;
            top: 0;
            width: 300px;
        }

        .mini-pie span {
            line-height: 100px;
        }
    </style>
@endsection
@section('title', 'Dashboard')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Dashboard</h6>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 position-relative z-index-2">


            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card  mb-2">
                        <a href="{{ route('calendar-new') }}">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="fa fa-calendar fa-stack-1x fa-inverse opacity-10"></i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Bookings</p>
                                    <h4 class="mb-0">00</h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">Bookings</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mt-4 mb-4">
                    <div class="card  mb-2">
                        <a href="{{ route('clients') }}">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="fa fa-users fa-stack-1x fa-inverse opacity-10"></i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Clients</p>
                                    <h4 class="mb-0">00</h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">Clients
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4 mb-4">
                    <div class="card  mb-2">
                        <a href="{{ route('contacts') }}">
                            <div class="card-header p-3 pt-2 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="fa fa-fax fa-stack-1x fa-inverse"></i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize ">Contacts</p>
                                    <h4 class="mb-0 ">0</h4>
                                </div>
                            </div>
                            <hr class="horizontal my-0 dark">
                            <div class="card-footer p-3">
                                <p class="mb-0 ">Contacts</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4 mb-4">
                    <div class="card ">
                        <a href="{{ route('memberships') }}">
                            <div class="card-header p-3 pt-2 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="fa fa-newspaper-o fa-stack-1x fa-inverse opacity-10"></i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize ">Memberships</p>
                                    <h4 class="mb-0 ">00</h4>
                                </div>
                            </div>
                            <hr class="horizontal my-0 dark">
                            <div class="card-footer p-3">
                                <p class="mb-0 ">Memberships</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4 mb-4">
                    <div class="card ">
                        <a href="{{ route('staffs') }}">
                            <div class="card-header p-3 pt-2 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="fa fa-user-md fa-stack-1x fa-inverse opacity-10"></i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize ">Staff roster</p>
                                    <h4 class="mb-0 ">00</h4>
                                </div>
                            </div>
                            <hr class="horizontal my-0 dark">
                            <div class="card-footer p-3">
                                <p class="mb-0 ">Staff roster</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-12 position-relative z-index-2">

            <div class="card card-body mt-4">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img id="profile-userpic-img" @if(!empty($business))  src="{{ dpSrc($business->logo) }}" alt="{{ $business->trading_name }}" @endif
                                class="w-100 rounded-circle shadow-sm logoPreviewPics previewPics">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                @if(!empty($business)) {{ $business->trading_name }} @endif
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">

                            </p>
                        </div>
                    </div>
                    <hr class="horizontal gray-light my-1">
                    <div class="col-auto" style="text-align: center">
                        <div class="user-image">
                            <div class="form-group upload-group">
                                <input type="hidden" name="prePhotoName" @if(!empty($business))  value="{{ dpSrc($business->logo) }}" @endif>
                                <input type="hidden" name="entityId" @if(!empty($business)) value="{{ $business->id }}" @endif>
                                <input type="hidden" name="saveUrl" value="business/photo/save">
                                <input type="hidden" name="photoHelper" value="logo">
                                <input type="hidden" name="cropSelector" value="">
                                <input type="hidden" id="getPhotoCsrf" name="_token" value="{{ csrf_token() }}" />
                                <div>
                                    <label class="btn btn-primary btn-file">
                                        <span>Change Logo</span>
                                        <input type="file" class="hidden" onChange="fileSelectHandler(this)"
                                            accept="image/*">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="row mt-3">

                        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4 position-relative">
                            <div class="card card-plain h-100">

                                <div class="card-body p-3">

                                    <hr class="horizontal gray-light my-1">
                                    <ul class="list-group">

                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm" style="text-align: center">
                                            @if (!empty($business->website))
                                                <strong class="text-dark">
                                                    <a href="http://{{ $business->website }}" target="_blank"><i
                                                            class="fa fa-twitter" style="font-size: 20px"></i></a>
                                                </strong> &nbsp;
                                            @endif

                                            @if (!empty($business->facebook))
                                                <strong class="text-dark">
                                                    <a href="http://{{ $business->facebook }}" target="_blank"><i
                                                            class="fa fa-facebook" style="font-size: 20px"></i></a>
                                                </strong> &nbsp;
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <hr class="horizontal gray-light my-1">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">General Information</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <hr class="horizontal gray-light my-1">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                class="text-dark">Business Type:</strong> &nbsp;
                                            {{ $business->typeName->bt_value }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Currency:</strong> &nbsp;
                                            {{ $business->currencyInFull }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Time
                                                Zone:</strong> &nbsp; {{ $business->time_zone }}</li>
                                    </ul>
                                </div>

                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Contact Information</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <hr class="horizontal gray-light my-1">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                class="text-dark">Email:</strong> &nbsp; <a
                                                href="mailto:{{ $business->email }}">{{ $business->email }}</a> </li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Phone:</strong> &nbsp; <a
                                                href="tel:{{ $business->phone }}">{{ $business->phone }}</a></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Address:</strong> &nbsp;
                                            {{ $business->address_line_one . ', ' . $business->address_line_two . ', ' . $business->city . ', ' . $business->stateName . ', ' . $countries[$business->country] . ', ' . $business->postal_code }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Users Limit Information</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <hr class="horizontal gray-light my-1">
                                    <ul class="list-group">
                                        @if ($usersLimitData)
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                    class="text-dark"> Users(Upto): </strong> &nbsp;
                                                {{ $usersLimitData['usersLimit'] }} </li>

                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                    class="text-dark"> Price: </strong> &nbsp;
                                                ${{ $usersLimitData['price'] }} </li>
                                        @else
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                    class="text-dark"> </strong> &nbsp; Not Defined </li>
                                        @endif

                                    </ul>
                                </div>

                            </div>

                            <hr class="vertical dark">
                        </div>

                        <div class="col-lg-8 col-md-6 mt-4 mb-4">
                            <div class="card z-index-2 ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                    <h6 class="mb-0">Client Registrations</h6>
                                    <div class="border-radius-lg py-3 pe-1">
                                        <div class="chart">
                                            <canvas id="chart2" class="full-width" width="589" height="350"
                                                style="width: 589px; height: 350px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex ">
                                        <div class="clearfix">
                                            <div class="inline pull-left">
                                                <div id="chart2Legend" class="chart-legend"></div>
                                                <!--Start: legend -->
                                                <div id="barLegend" class="chart-legend">
                                                    <ul class="bar-legend">
                                                        <li>
                                                            <span
                                                                style="background-color:rgba(66,134,244,0.5)"></span>Active
                                                            Clients
                                                        </li>
                                                        <li>
                                                            <span
                                                                style="background-color:rgba(151,187,205,0.5)"></span>Inactive
                                                            Clients
                                                        </li>
                                                        <li>
                                                            <span
                                                                style="background-color:rgba(224,204,130,0.5)"></span>On-Hold
                                                            Clients
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--End: legend -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Clients</h6>
                                <a href="#chartSetting" class="btn bg-gradient-default" data-bs-toggle="modal"
                                    data-type="clientsChart"
                                    data-settingdata="{{ isset($clients_chart) ? $clients_chart : '' }}"
                                    data-bs-target="#chartSetting">
                                    <i style="font-size: 18px" class="fa fa-cog" aria-hidden="true"></i>
                                </a>

                            </div>
                        </div>
                        <div class="card-body pb-0 p-3 mt-4">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="panel panel-white no-radius">
                                    <div class="panel-body">
                                        <div class="text-center" align="center">
                                            <span class="mini-pie pie-style">
                                                <canvas id="chart3" class="full-width"></canvas>
                                                <span>{{ $totalclients }}</span>
                                            </span>
                                        </div>
                                        <div class="margin-top-20 text-center legend-xs inline">
                                            <div id="chart3Legend" class="chart-legend"></div>
                                        </div>
                                    </div>

                                    <?php
                                    $check_border = 3;
                                    $client_chart = $sale_chart = [];
                                    if (isset($clients_chart) && isset($sales_chart)) {
                                        $client_chart[] = json_decode($clients_chart);
                                        $sale_chart[] = json_decode($sales_chart);
                                    }
                                    ?>

                                    @if (count($client_chart))

                                        <div class="panel-footer">
                                            <div class="clearfix padding-5 space5">
                                                @if (array_key_exists('active', $client_chart))
                                                    <?php $check_border = 1; ?>
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">

                                                        <h3 class="text-bold block no-margin">{{ $count_active }}</h3>
                                                        <span
                                                            class="text-light block text-extra-large">{{ $total_active }}%</span>
                                                        <span class="text-bold">Active</span>

                                                    </div>
                                                @endif
                                                @if (array_key_exists('contra', $client_chart))
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 3) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">{{ $count_contra }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_contra }}%</span>
                                                            <span class="text-bold">Contra</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('inactive', $client_chart))
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 3) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">{{ $count_inactive }}
                                                            </h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_inactive }}%</span>
                                                            <span class="text-bold">Inactive</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('on_hold', $client_chart))
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 3) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">{{ $count_onhold }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_onhold }}%</span>
                                                            <span class="text-bold">On Hold</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('pending', $client_chart))
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 3) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">{{ $count_pending }}
                                                            </h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_pending }}%</span>
                                                            <span class="text-bold">Pending</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('other', $client_chart))
                                                    <div class="col-xs-4 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 3) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">{{ $count_other }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_other }}%</span>
                                                            <span class="text-bold">Other</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Clients in Sales Process</h6>
                                <a href="#chartSetting" class="btn bg-gradient-default" data-bs-toggle="modal"
                                    data-type="salesProChart"
                                    data-settingdata="{{ isset($sales_chart) ? $sales_chart : '' }}"
                                    data-bs-target="#chartSetting">
                                    <i style="font-size: 18px" class="fa fa-cog" aria-hidden="true"></i>
                                </a>

                            </div>
                        </div>
                        <div class="card-body pb-0 p-3 mt-4">
                            <div class="row">
                                <div class="col-12 text-start">
                                    <div class="chart">

                                        <div class="panel-body">
                                            <div class="text-center">
                                                <span class="mini-pie pie-style">
                                                    <canvas id="pie_chart2" class="full-width"></canvas>
                                                    <span>{{ $totalclients2 }}</span>
                                                </span>
                                            </div>
                                            <div class="margin-top-20 text-center legend-xs inline">
                                                <div id="pie_2_Legend" class="chart-legend"></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-12 my-auto">

                                    @if (count($sale_chart))
                                        <?php $check_border = 2; ?>
                                        <div class="panel-footer">
                                            <div class="clearfix padding-5 space5">
                                                @if (array_key_exists('sales_pending', $sale_chart))
                                                    <?php $check_border = 1; ?>
                                                    <div class="col-xs-6 text-center no-padding margin-bottom-15">
                                                        <div>
                                                            <h3 class="text-bold block no-margin">{{ $count_lead }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_lead }}%</span>
                                                            <span class="text-bold">Pending</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('pre_consultation', $sale_chart))
                                                    <div class="col-xs-6 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 2) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">
                                                                {{ $count_pre_preconsult }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_pre_preconsult }}%</span>
                                                            <span class="text-bold">Pre-Consultation</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('pre_benchmark', $sale_chart))
                                                    <div class="col-xs-6 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 2) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">
                                                                {{ $count_pre_benchmark }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_pre_benchmark }}%</span>
                                                            <span class="text-bold">Pre-Benchmark</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (array_key_exists('pre_training', $sale_chart))
                                                    <div class="col-xs-6 text-center no-padding margin-bottom-15">
                                                        <div class="<?php if ($check_border < 2) {
                                                            echo 'border-left border-dark';
                                                            $check_border++;
                                                        } else {
                                                            $check_border = 1;
                                                        } ?>">
                                                            <h3 class="text-bold block no-margin">
                                                                {{ $count_pre_training }}</h3>
                                                            <span
                                                                class="text-light block text-extra-large">{{ $total_pre_training }}%</span>
                                                            <span class="text-bold">Pre-Training</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body pb-0 p-3 mt-4">
                            <div class="row">
                                <div class="col-12 text-start">

                                    @include('includes.partials.dashboard_addtask')

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row mt-4">

                <div class="col-lg-12 col-sm-6">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Sales</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Productivity</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">Total
                                Price</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <div class="row mt-4">
                                <div class="col-lg-12 col-12">
                                    <div class="card z-index-2 mt-1">
                                        <div class="card-header p-3 pt-2">

                                        </div>
                                        <div class="card-body p-3 pt-0">
                                            <div class="chart">

                                                <div class="row p-t-10">
                                                    <div class="col-xs-12" style="height: 400px;">
                                                        <canvas id="salesbar" style="position:relative;"></canvas>
                                                        <div class="pull-right now-style sales-cls text-center"
                                                            id="now-tooltip"><strong>TODAY</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="sale-last">
                                                            <div class="last-next-style">
                                                                <div class="area-7days">LAST 7 DAYS</div>
                                                            </div>
                                                        </div>
                                                        <div class="sale-next">
                                                            <div class="last-next-style">
                                                                <div class="area-7days">NEXT 7 DAYS</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row m-t-20">
                                                    <div class="col-xs-12 inline">
                                                        <!--Start: legend -->
                                                        <div id="sales-legend" class="chart-legend"></div>
                                                        <!--End: legend -->
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="row mt-4">
                                <div class="col-lg-12 col-12">
                                    <div class="card z-index-2 mt-2">
                                        <div class="card-header p-3 pt-2">

                                        </div>
                                        <div class="card-body p-3 pt-0">
                                            <div class="chart">
                                                <div class="row">
                                                    <div class="col-xs-12 " style="height: 400px;">
                                                        <canvas id="productivitybar" width="700" height="300"
                                                            style="position:relative;"></canvas>
                                                        <div class="pull-right now-style sales-cls text-center">
                                                            <strong>TODAY</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="sale-last">
                                                            <div class="last-next-style">
                                                                <div class="area-7days">LAST 7 DAYS<br>
                                                                    <span id="last7-per-data"></span>% booked
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="sale-next">
                                                            <div class="last-next-style">
                                                                <div class="area-7days">NEXT 7 DAYS<br>
                                                                    <span id="next7-per-data"></span>% booked
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row m-t-40">
                                                    <div class="col-xs-12 inline">
                                                        <!--Start: legend -->
                                                        <div id="productivity-legend" class="chart-legend"></div>
                                                        <!--End: legend -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body p-3 position-relative">
                                            <div class="row">
                                                <div class="col-md-1 col-sm-1">
                                                    <div>SERVICES</div>
                                                    <div class="number-style">${{ $last_7days_price }}</div>
                                                    <div>
                                                        @if ($last_14days_price > 0)
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="vs. previous 7 days"
                                                                class="epic-tooltip tooltipclass" rel="tooltip">
                                                                <font color="<?php echo $last_7days_price > $last_14days_price ? '#61C561' : '#ff4401'; ?>">
                                                                    <i class="fa fa-chevron-circle-down"></i>
                                                                    ${{ $last_14days_price }}
                                                                </font>
                                                            </span>
                                                        @else
                                                            <sapn data-toggle="tooltip" data-placement="top"
                                                                title="vs. previous 7 days"
                                                                class="epic-tooltip tooltipclass" rel="tooltip">
                                                                No change
                                                            </sapn>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div class="math-symbole">+</div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div>PRODUCTS</div>
                                                    <div class="number-style">$0</div>
                                                    <div>
                                                        <sapn data-toggle="tooltip" data-placement="top"
                                                            title="vs. previous 7 days" class="epic-tooltip tooltipclass"
                                                            rel="tooltip">
                                                            No change
                                                        </sapn>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div class="math-symbole">+</div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div>PACKAGES</div>
                                                    <div class="number-style">$0</div>
                                                    <div>
                                                        <sapn data-toggle="tooltip" data-placement="top"
                                                            title="vs. previous 7 days" class="epic-tooltip tooltipclass"
                                                            rel="tooltip">
                                                            No change
                                                        </sapn>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div class="math-symbole">-</div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div>DISCOUNTS</div>
                                                    <div class="number-style">$0</div>
                                                    <div>
                                                        <sapn data-toggle="tooltip" data-placement="top"
                                                            title="vs. previous 7 days" class="epic-tooltip tooltipclass"
                                                            rel="tooltip">
                                                            No change
                                                        </sapn>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <div class="math-symbole">=</div>
                                                </div>
                                                <div class="col-md-2 vr-line col-sm-2">
                                                    <div>TOTAL SALES</div>
                                                    <div class="number-style">${{ $last_7days_price }}</div>
                                                    <div>
                                                        @if ($last_14days_price > 0)
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="vs. previous 7 days"
                                                                class="epic-tooltip tooltipclass" rel="tooltip">
                                                                <font color="<?php echo $last_7days_price > $last_14days_price ? '#61C561' : '#ff4401'; ?>">
                                                                    <i class="fa fa-chevron-circle-down"></i>
                                                                    ${{ $last_14days_price }}
                                                                </font>
                                                            </span>
                                                        @else
                                                            <sapn data-toggle="tooltip" data-placement="top"
                                                                title="vs. previous 7 days"
                                                                class="epic-tooltip tooltipclass" rel="tooltip">
                                                                No change
                                                            </sapn>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-2  col-sm-2">
                                                    <div>AVERAGE SALE</div>
                                                    <div class="number-style">${{ round($last7daysAverageSale, 2) }}</div>
                                                    <div>

                                                        <span data-toggle="tooltip" data-placement="top"
                                                            title="vs. previous 7 days" class="epic-tooltip tooltipclass"
                                                            rel="tooltip">
                                                            <font color="<?php echo $last_7days_price > $last_14days_price ? '#61C561' : '#ff4401'; ?>">
                                                                <i class="fa fa-chevron-circle-down"></i>
                                                                ${{ round($averageSale, 2) }}
                                                            </font>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>
    </div>

    @include('includes.partials.chart_settings', [
        'client_chart' => $client_chart,
        'sales_chart' => $sale_chart,
    ])

    @include('includes.partials.pic_crop_model')


@endsection

@section('script-after-page-handler')

    <script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>

    <?php /* <script src="{{ asset('theme') }}/js/plugins/chartjs.min.js"></script> */ ?>

    <script src="{{ asset('theme') }}/js/plugins/world.js"></script>

    {!! Html::script('theme/js/dashboard.js?v=' . time()) !!}

    {!! Html::script('theme/js/index.js?v=' . time()) !!}

    <script src="{{ asset('theme') }}/js/plugins/Jcrop/js/jquery.Jcrop.min.js?v={{rand()}}"></script>
    <script src="{{ asset('theme') }}/js/plugins/Jcrop/js/script.js?v={{rand()}}"></script>

    <script src="https://epic.testingserver.in/vendor/moment/moment.min.js"></script>
    <script src="https://epic.testingserver.in/vendor/moment/moment-timezone-with-data.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/2.2.0/moment-range.min.js"></script>

    <script>
        var maxClientRegNum = 84,
            count_active = {{ $count_active }},
            count_contra = {{ $count_contra }},
            count_inactive = {{ $count_inactive }},
            count_onhold = {{ $count_onhold }},
            count_pending = {{ $count_pending }},
            count_other = {{ $count_other }},
            count_lead = {{ $count_lead }},
            count_pre_preconsult = {{ $count_pre_preconsult }},
            count_pre_benchmark = {{ $count_pre_benchmark }},
            count_pre_training = {{ $count_pre_training }},
            MaxNumofClients = {{ $MaxNumofClients }},
            total_inactive_clients_permonth = {{ json_encode($count_inactive_clients) }},
            total_onhold_clients_permonth = {{ json_encode($count_onhold_clients) }},
            // total_new_client_permonth={{ json_encode($count_new_client) }},
            total_new_client_permonth = {{ json_encode($count_new_client) }},
            total_confirmed = {{ json_encode($final_conf) }},
            total_pencilledin = {{ json_encode($final_pencil) }},
            total_conf_time = {{ json_encode($conf_time, 1) }},
            total_pen_time = {{ json_encode($pen_time) }},
            total_notshow_time = {{ json_encode($notshow_time) }},
            total_attended_time = {{ json_encode($attended_time) }},
            total_busy_time = {{ json_encode($busy_time) }},
            total_cls_time = {{ json_encode($cls_time) }},
            total_working_time = {{ json_encode($total_working_time) }},
            max_time = {{ $maxTime }},
            max_value = {{ $maxVal }};
        var bladeType = "Dashboard";
        var sales_chart = <?php echo isset($sales_chart) ? $sales_chart : 0; ?>;
        var clients_chart = <?php echo isset($clients_chart) ? $clients_chart : 0; ?>;


        //var dateA = moment().subtract('months', 6);
        ///var x=dateA.fromNow();
        var formatDate = 1399919400000;
        var responseDate = moment(formatDate).format('DD/MM/YYYY');
        //console.log(x);
        //alert(responseDate);
        dateTo = moment().format('YYYY-MM-DD');
        dateFrom = moment().subtract(6, 'M').format('YYYY-MM-DD');

        @if (Session::has('ifBussHasClients'))
            Index.init();
        @endif
    </script>
@endsection
