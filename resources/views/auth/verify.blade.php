@extends('layouts.control-the-work.page-single')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('assets/images/logos/logo-control-the-work-150x72.png') }}" class="h-8" alt="Control the work logo">
                    </a>
                </div>
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title text-center">{{ __('Verify Your Email Address') }}</div>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
            </div>
        </div>
    </div>
@endsection