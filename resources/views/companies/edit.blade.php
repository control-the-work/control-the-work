@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{ Form::model($company, [
                    'method' => 'PATCH',
                    'action' => ['CompanyController@update', $company->id],
                    'class' => 'card',
                    ]) }}
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Edit company') }}: {{ $company->name }}</h3>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {{ Form::label('name', trans('Company (*)'), ['class' => 'form-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Company']) }}
                                    @error('name')
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('address', trans('Address'), ['class' => 'form-label']) }}
                                    {{ Form::text('address', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Company address']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('city', trans('City'), ['class' => 'form-label']) }}
                                    {{ Form::text('city', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'City']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    {{ Form::label('postal_code', trans('Postal Code'), ['class' => 'form-label']) }}
                                    {{ Form::text('postal_code', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Postal Code']) }}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {{ Form::label('country', trans('Country'), ['class' => 'form-label']) }}
                                    {{ Form::select('country', $countries, $company->country, ['class' => 'form-control  custom-select', 'placeholder' => trans('Select a country')]) }}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {{ Form::label('timezone', trans('Timezone'), ['class' => 'form-label']) }}
                                    {{ Form::select('timezone', $timezones, $company->timezone, ['class' => 'form-control  custom-select', 'placeholder' => trans('Select a timezone')]) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    {{ Form::label('comments', trans('Comments'), ['class' => 'form-label']) }}
                                    {{ Form::textarea('comments', null, ['class' => 'form-control', 'roles' => 'form', 'placeholder' => 'Comments about the company', 'size' => 'x5']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
