@extends('frontend.layouts.login')

@section('title', 'Password Reset | '.app_name())

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

                           <form role="form" method="POST" action="{{ route('password.forgot') }}" class="text-start1">
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
                                   <label class="form-label">Please enter your registered email address.</label>
                                    {!! Form::email('uname', null, ['class' => 'form-control forgotemailField', 'required' => '', 'pattern' => '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$', 'oninvalid' => 'setCustomValidity("Please fill with valid '.trans('validation.attributes.frontend.email').'.")', 'oninput' => 'setCustomValidity("")', 'title' => trans('validation.attributes.frontend.email'), 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                               </div>
                               @error('uname')
                               <p class='text-danger inputerror'>{{ $message }} </p>
                               @enderror

                               <div class="text-center">
                                     {!! Form::button(trans('labels.frontend.passwords.send_password_reset_link_button'), array('type' => 'submit', 'class' => 'btn bg-gradient-primary w-100 my-4 mb-2')) !!}
                               </div>
                              
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</main>
@push('js')
<script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>

    {!! Html::script('vendor/jquery-validation/jquery.validate.min.js') !!}
    {!! Html::script('assets/js/login.js') !!}

<script>
        jQuery(document).ready(function() {
            // Main.init();
            Login.init();  
        });
    </script>

@endpush

@endsection
