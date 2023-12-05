@extends('layouts.app')

@section('required-styles-for-this-page')

    <!-- start: Bootstrap Select Master -->
    {!! Html::style('theme/vendor/bootstrap-select-master/css/bootstrap-select.min.css?v='.time()) !!}
    <!-- end: Bootstrap Select Master -->
    {!! Html::style('theme/vendor/sweetalert/sweet-alert.css?v='.time()) !!}

    <style>
        .btn-default.tooltips.viewModal,
        .btn-default.tooltips {
            width: 22px;
            height: 22px;
            margin-bottom: 2px;
        }

        nav.flex.items-center.justify-between {
            text-align: center;
        }

        p.text-sm.text-gray-700.leading-5 {
            margin-top: 8px;
        }

        .rightts {
            float: right !important;
            width: 100%;
            text-align: center;
        }
    </style>

@endsection
@section('title', 'Dashboard')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Client list</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Client list</h6>

@endsection

@section('content')


    <div class="row mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
            <!-- Card Profile -->
            @if (session('status'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                            <span class="text-sm">{{ Session::get('status') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Card General Details -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>General Details</h5>
                </div>
                <div class="card-body pt-0">

                    @yield('form')
                    
                </div>

            </div>

        </div>
    </div>

    </div>
    </div>



@endsection

@section('required-script-for-this-page')
    {!! Html::script('theme/vendor/jquery-validation/jquery.validate.min.js?v='.time()) !!}
    {!! Html::script('theme/vendor/jquery-ui/jquery-ui.min.js?v='.time()) !!}
    <script type="text/javascript">
        $.validator.setDefaults({
            errorElement : "span", // contain the error msg in a small tag
            errorClass : 'help-block',
            errorPlacement : function(error, element) {// render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
                    error.appendTo($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore : ':hidden',
            success : function(label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error');
            },
            highlight : function(element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').addClass('has-error');
                // add the Bootstrap error class to the control group
            },
            unhighlight : function(element) {// revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            }
        });
    </script>

    <!-- start: Bootstrap Select Master -->
    {!! Html::script('theme/vendor/bootstrap-select-master/js/bootstrap-select.min.js?v='.time()) !!}
    <!-- end: Bootstrap Select Master -->

    <!-- {!! Html::script('theme/vendor/moment/moment.min.js') !!}
    {!! Html::script('theme/vendor/moment/moment-timezone-with-data.js') !!}
    {!! Html::script('assets/js/set-moment-timezone.js') !!}  -->

    <!-- start: Country Code Selector -->
    {!! Html::script('assets/plugins/intl-tel-input-master/build/js/utils.js?v='.time()) !!}
    {!! Html::script('assets/plugins/intl-tel-input-master/build/js/intlTelInput.js?v='.time()) !!}
    <!-- end: Country Code Selector -->

    <!-- start: Bootstrap Typeahead -->
    {!! Html::script('assets/plugins/bootstrap3-typeahead.min.js?v='.time()) !!}
    <!-- end: Bootstrap Typeahead -->

    <!-- start: Bootstrap timepicker -->
     <!--{!! Html::script('theme/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!} -->
    <!-- end: Bootstrap timepicker -->
    
    <!-- Start:  NEW timepicker js -->
    {!! Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js?v='.time()) !!}
    <!-- End: NEW timepicker js -->   
    
    <!-- start: Bootstrap daterangepicker -->
    {!! Html::script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js?v='.time()) !!}
    <!-- end: Bootstrap daterangepicker -->

    @yield('script')
    {!! Html::script('theme/vendor/sweetalert/sweet-alert.min.js?v='.time()) !!}
    {!! Html::script('assets/js/helper.js?v='.time()) !!}
    {!! Html::script('assets/js/business-helper.js?v='.time()) !!}
    {!! Html::script('assets/js/business.js?v='.time()) !!}

    <!-- start: Client-Membership Modal -->
    {!! Html::script('assets/js/client-membership.js?v='.time()) !!}
    <!-- end: Client-Membership Modal -->
    @if(isset($isError) && $isError)
    <script type="text/javascript">
        swal({
           title: "{{$msg}}",
           allowOutsideClick: false,
           showCancelButton: false,
           confirmButtonText: 'Back',
           confirmButtonColor: '#ff4401',
           cancelButtonText: "No"
        }, 
        function(isConfirm){
            if(isConfirm){
              window.location.href = "{{route('clients')}}"; 
            }
        });
    </script>
    @endif
   
@stop()