@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{ Form::model($user, [
                    'method' => 'PATCH',
                    'action' => ['UserController@update', $user->id],
                    'class' => 'card',
                    ]) }}

                    @include ('users.form', [
                    'H3text' => __('Edit the user'),
                    'submitButtonText' => __('Update the user')])

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
