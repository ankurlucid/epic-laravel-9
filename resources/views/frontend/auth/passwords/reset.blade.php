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

                           <form role="form" method="POST" action="{{ route('password.reset') }}" class="text-start1">
                                <input type="hidden" name="token" value="{{ $token }}">

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
                                   {!! Form::label('uname', trans('validation.attributes.frontend.email'), ['class' => 'form-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('email', 'uname', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                                    </div>
                               </div>
                               @error('uname')
                               <p class='text-danger inputerror'>{{ $message }} </p>
                               @enderror

                               <div class="input-group input-group-outline mt-3 is-filled">
                                   {{!! Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'form-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) !!}
                                    </div>
                               </div>

                               <div class="input-group input-group-outline mt-3 is-filled">
                                   {!! Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) !!}
                                    </div>
                               </div>

                               <div class="text-center">
                                    {!! Form::submit(trans('labels.frontend.passwords.reset_password_button'), ['class' => 'btn bg-gradient-primary w-100 my-4 mb-2']) !!}
                               </div>
                              
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</main>

@endsection
