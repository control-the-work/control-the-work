@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(['action' => 'UserController@store', 'class' => 'form-horizontal card']) !!}

                    @include ('users.form', [
                        'H3text' => __('Add an user'),
                        'submitButtonText' => __('Add an user')])

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
