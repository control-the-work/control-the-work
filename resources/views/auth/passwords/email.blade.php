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
                <form class="card" method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <div class="card-body p-6">
                        <div class="card-title text-center">{{ __('Reset Password') }}</div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="text-muted">{!! __('Enter your email address that you used to register. <br>We will send you an email with a link to reset your password.') !!}</p>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">{{ __('Email address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    {!! __('Forget it, <a href=":url">send me back</a> to the sign in screen.', [
                        'url' => route('login')
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
