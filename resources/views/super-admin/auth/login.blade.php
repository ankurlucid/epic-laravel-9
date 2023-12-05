@extends('frontend.layouts.login')

@section('title', 'Login | '.app_name())

@section('content')

<!-- Navbar -->
  @include('frontend.layouts.navbar')
<!-- End Navbar -->
<main class="main-content  mt-0">
   <div class="page-header align-items-start min-vh-100"
       style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
       <span class="mask bg-gradient-dark opacity-6"></span>
       <div class="container my-5">
           <div class="row signin-margin">
               <div class="col-lg-5 col-md-8 col-12 mx-auto">
                   <div class="card z-index-0 fadeIn3 fadeInBottom">
                       
                       <div class="card-body">
                            @include('includes.partials.messages')

                           <form role="form" method="POST" action="{{ route('superadmin.authenticate') }}" class="text-start1 form-login">
                               @csrf
                               @if (Session::has('status'))
                               <div class="alert alert-success alert-dismissible text-white" role="alert">
                                   <span class="text-sm">{{ Session::get('status') }}</span>
                                   <button type="button" class="btn-close text-lg py-3 opacity-10"
                                       data-bs-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               @endif

                               <div class="input-group input-group-outline mt-3 is-filled">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => '', 'pattern' => '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$', 'oninvalid' => 'setCustomValidity("Please fill with valid '.trans('validation.attributes.frontend.email').'.")', 'oninput' => 'setCustomValidity("")', 'title' => trans('validation.attributes.frontend.email'), 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                               </div>
                               @error('uname')
                               <p class='text-danger inputerror'>{{ $message }} </p>
                               @enderror

                               <div class="input-group input-group-outline mt-3 is-filled">
                                    {!! Form::password('password', ['class' => 'form-control password', 'required' => '', 'oninvalid' => 'setCustomValidity("Please fill out '.trans('validation.attributes.frontend.email').'.")', 'oninput' => 'setCustomValidity("")', 'title' => trans('validation.attributes.frontend.password'), 'placeholder' => trans('validation.attributes.frontend.password')]) !!}
                               </div>
                               @error('password')
                               <p class='text-danger inputerror'>{{ $message }} </p>
                               @enderror
                               <div class="form-check form-switch d-flex align-items-center my-3">
                                   <input class="form-check-input" type="checkbox" id="rememberMe">
                                   <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                               </div>
                               <div class="text-center">
                                   <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign
                                       in</button>
                               </div>
                               <p class="text-sm text-center mt-3">
                                   Forgot your password? Reset your password
                                   <a href="{{ route('password.reset') }}"
                                       class="text-primary text-gradient font-weight-bold">here</a>
                               </p>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</main>
@push('js')
<style>
  .help-block{
    display: none !important;
  }
</style>
<script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>

   {!! Html::script('vendor/bootstrap-select-master/js/bootstrap-select.min.js') !!}
    {!! Html::script('assets/js/helper.js') !!}
            <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    {!! Html::script('vendor/jquery-validation/jquery.validate.min.js') !!}
            <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <!-- start: JavaScript Event Handlers for this page -->
    {!! Html::script('assets/js/login.js') !!}
<script>
   $(function () {

       function checkForInput(element) {

           const $label = $(element).parent();

           if ($(element).val().length > 0) {
               $label.addClass('is-filled');
           } else {
               $label.removeClass('is-filled');
           }
       }
       var input = $(".input-group input");
       input.focusin(function () {
           $(this).parent().addClass("focused is-focused");
       });

       $('input').each(function () {
           checkForInput(this);
       });

       $('input').on('change keyup', function () {
           checkForInput(this);
       });

       input.focusout(function () {
           $(this).parent().removeClass("focused is-focused");
       });
   });

</script>
<script>
        jQuery(document).ready(function() {
            // Main.init();
            Login.init();
            
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $('.loginclass').click(function(e){
                var form=$('.form-login'),
                isValid=form.valid();

                if(isValid){
                    $('.loginclass').attr('disabled',true);
                    var emailField = $('input[name="uname"]');
                    var HiddenSlug = $('input[name="businessUrl"]').val(); 
                    if(HiddenSlug){
                        e.preventDefault();
                        var public_url = $('meta[name="public_url"]').attr('content'),
                        email = emailField.val();
                        $.ajax({
                            url: public_url+'checkuser',
                            type: 'POST',
                            data: {'slug':HiddenSlug, 'userName':email},
                            success: function(response){ 
                                $('input[name="businessId"]').val(response['businessid']); 
                                if(response['totalaccounts'] <= 1){
                                    $('input[name="userType"]').val(response['usertype']);
                                    $('.loginclass').removeAttr("disabled");
                                    $('.form-login').submit();
                                }
                                else{
                                    $("#myModal").modal('show');
                                }           
                            }
                        });
                    }
                    else $('.form-login').submit();
                }
            });     
        });
    </script>

@endpush

@endsection
