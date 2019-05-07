<div class="card-body">
    <h3 class="card-title">{{ $H3text }}</h3>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('name', __('Name') . ' (*)', ['class' => 'form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Name']) }}
                @error('name')
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('surname', __('Surname'), ['class' => 'form-label']) }}
                {{ Form::text('surname', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Surname']) }}
                @error('surname')
                <div class="invalid-feedback">{{ $errors->first('surname') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                {{ Form::label('email', __('Email') . ' (*)', ['class' => 'form-label']) }}
                {{ Form::text('email', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Email']) }}
                @error('email')
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('password', __('Password') . ' (*)', ['class' => 'form-label']) }}
                {{ Form::password('password', ['class' => 'form-control', 'roles' => 'form']) }}
                @error('password')
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('password_confirmation', __('Password confirmation'), ['class' => 'form-label']) }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'roles' => 'form']) }}
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                {{ Form::label('role', __('Role') . ' (*)', ['class' => 'form-label']) }}
                {{ Form::select('role', $roles, $roleSelected, ['class' => 'form-control  custom-select', 'placeholder' => __('Select a role')]) }}
                @error('role')
                <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('timezone', __('Timezone') . ' (*)', ['class' => 'form-label']) }}
                {{ Form::select('timezone', $timezones, $company->timezone, ['class' => 'form-control  custom-select', 'placeholder' => __('Select a timezone')]) }}
                @error('timezone')
                <div class="invalid-feedback">{{ $errors->first('timezone') }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary">{{ __($submitButtonText) }}</button>
</div>
