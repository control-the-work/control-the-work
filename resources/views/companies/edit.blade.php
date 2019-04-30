@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <form class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ __('Edit company') }}: {{ $company->name }}</h3>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" placeholder="Company" value="{{ $company->name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Address') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('Company address') }}" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('City') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('City') }}" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Postal Code') }}</label>
                                        <input type="number" class="form-control" placeholder="{{ __('Postal Code') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Country') }}</label>
                                        <select class="form-control custom-select">
                                            <option value="">Germany</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label class="form-label">{{ __('Comments') }}</label>
                                        <textarea rows="5" class="form-control" placeholder="{{ __('Comments about the company') }}" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post-footer')
@endsection