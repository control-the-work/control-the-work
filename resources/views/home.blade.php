@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    {{ __('Dashboard') }}
                </h1>
            </div>
            <div class="row row-cards">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Actions') }}</h3>
                        </div>
                        <div class="mt-3 ml-3">
                            @foreach($eventTypes as $eventType)
                                <p>
                                    <button type="button" class="btn btn-primary btn-lg start mr-2" id="{{ $eventType->id }}"><i class="fa fa-play-circle"></i> {{ __('Start') }} {{ __($eventType->name) }} </button>
                                    <button type="button" class="btn btn-danger btn-lg stop" id="{{ $eventType->id }}"><i class="fa fa-stop-circle"></i> {{ __('End') }} {{ __($eventType->name) }}</button>
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('User time control log') }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="events-table" class="table card-table table-striped table-vcenter ">
                                <thead>
                                <tr>
                                    <th>{{ __('Event') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post-footer')
    <script type="text/javascript">
        window.onload = function () {
            $('.start').on('click', function ($event) {
                if (!($(this).hasClass('disabled'))) {
                    var confirmButtonText = $(this).html();
                    var eventId = $(this).attr('id');
                    storeEvent(confirmButtonText, eventId, true);
                }
            });
            $('.stop').on('click', function ($event) {
                var confirmButtonText = $(this).html();
                var eventId = $(this).attr('id');
                storeEvent(confirmButtonText, eventId, false);
            });
            $(document).ready(function () {
                $(function () {
                    $('#events-table').DataTable({
                        processing: true,
                        serverSide: true,
                        scrollX: false,
                        @if (App::getLocale() === 'es')
                        "language": {
                            "url": "{{ url('https://cdn.datatables.net/plug-ins/1.10.18/i18n/Spanish.json') }}",
                        },
                        @endif
                        "pageLength": 10,
                        "columnDefs": [
                            {className: "dt-head-left dt-body-left", "targets": [0]},
                            {className: "dt-head-center dt-body-center", "targets": [1, 2]},
                        ],
                        ajax: '{{ action('EventController@listDatatables') }}',
                        columns: [
                            {data: 'event_type_id', name: 'event_type_id', "width": "30%", 'searchable': false, 'orderable': false},
                            {data: 'date', name: 'date', "width": "30%", 'searchable': false, 'orderable': false},
                            {data: 'time', name: 'time', "width": "30%", 'searchable': false, 'orderable': false},
                        ]
                    });
                });
            });
        };

        function disableButtons() {
            $('button, input:button').prop('disabled', true);
        }

        function enableButtons() {
            $('button, input:button').prop('disabled', false);
        }

        function storeEvent(confirmButtonText, eventId, isStart) {
            disableButtons()
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ec6c62',
                confirmButtonText: confirmButtonText,
                cancelButtonText: '{{ __('Cancel') }}',
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    $.ajax({
                        url: '{{ action('EventController@store') }}',
                        type: 'POST',
                        data: {
                            _method: 'POST',
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            eventId: eventId,
                            isStart: isStart,
                        },
                        success: function () {
                            Swal.fire({
                                position: 'top-end',
                                title: ' {{ __('Created!') }} ',
                                text: ' {{ __('The event has been created.') }}',
                                type: "success",
                                timer: 1500,
                            }).then(function () {
                                $('#events-table').DataTable().draw(false);
                            })
                        },
                        error: function () {
                            Swal.fire({
                                title: ' {{ __('Error!') }} ',
                                text: ' {{ __('The event has not been created.') }}',
                                type: 'error',
                            });
                        }
                    })
                }
                enableButtons();
            });
        }
    </script>
@endsection