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
                    <form class="card" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body p-6">
                            <div class="card-title text-center">{{ __('Login to your account') }}</div>

                            {{-- Start Email Address --}}
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('Email address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @enderror
                            </div>
                            {{-- End Email Address --}}

                            {{-- Start Password --}}
                            <div class="form-group">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('email') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @enderror
                            </div>
                            {{-- End Password --}}

                            {{-- Start Remember Checkbox --}}
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label" id="remember-span">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            {{-- End Remember Checkbox --}}

                            {{-- Start Submit Button --}}
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Sign in') }}</button>
                            </div>
                            {{-- End Submit Button --}}
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            {{ __('Don\'t have account yet?') }} <a href="./register.html">{{ __('Sign up') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection