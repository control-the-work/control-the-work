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
                <form class="card" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="card-body p-6">
                        <div class="card-title text-center">{{ __('Reset Password') }}</div>

                        {{-- Start Email Address --}}
                        <div class="form-group">
                            <label class="form-label" for="email">{{ __('Email address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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

                        {{-- Start Password Confirm --}}
                        <div class="form-group">
                            <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        {{-- End Password Confirm --}}

                        {{-- Start Submit Button --}}
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
                        </div>
                        {{-- End Submit Button --}}
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
