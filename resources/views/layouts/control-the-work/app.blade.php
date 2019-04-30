<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en"/>
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.control-the-work.favicon')
    <title>{{ env('APP_NAME', 'Control the work') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    {{--    <script src="{{ asset('assets/js/require.min.js') }}"></script>
        <script>
            requirejs.config({
                baseUrl: '.'
            });
        </script>--}}
<!-- Core JS -->
    <script src=" {{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/core.js') }}"></script>
    <script src=" {{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>

    <!-- Dashboard Core -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet"/>
{{--    <script src=" {{ asset('assets/js/dashboard.js') }}"></script>--}}
    {{--    <!-- c3.js Charts Plugin -->
        <link href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/plugins/charts-c3/plugin.js') }}"></script>
        <!-- Google Maps Plugin -->
        <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
        <script src="./assets/plugins/maps-google/plugin.js"></script>--}}
    {{--<!-- Input Mask Plugin -->
        <script src="{{ asset('assets/plugins/input-mask/plugin.js') }}"></script>
        <!-- Datatables Plugin -->
        <script src="{{ asset('assets/plugins/datatables/plugin.js') }}"></script>--}}
<!-- Datatables Plugin -->
    {{--
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    --}}
    {{--
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info {
            display: none;
        }

        table.dataTable thead .sorting_asc {
            background-image: none;
        }
    </style>
    <!-- SweetAlert2 Plugin -->
    <link href="{{ asset('assets/plugins/sweetalert2/8.9.0/dist/sweetalert2.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('assets/plugins/sweetalert2/8.9.0/dist/sweetalert2.all.min.js') }}"></script>
</head>
<body class="">
<div class="page">
    <div class="flex-fill">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logos/logo-control-the-work-150x72.png') }}" class="header-brand-img" alt="Control the work logo">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url({{ asset('assets/images/icons/user-male.svg') }})"></span>
                                <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                      <small class="text-muted d-block mt-1">{{ __(Auth::user()->roles()->first()->name) }}</small>
                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{ route('users.show', ['id' => Auth::user()->id]) }}">
                                    <i class="dropdown-icon fe fe-user"></i> {{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-log-out"></i> {{ __('Sign out') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link active"><i class="fe fe-home"></i> {{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-clock"></i> {{ __('Time control') }}</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="#" class="dropdown-item "> {{ __('Check in & check out') }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
                                <table id="events-table" class="table card-table table-striped table-vcenter">
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
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    {{ __('Open Source time control webapp.') }}
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    {{ __('Copyright') }} ©
                    @php echo date("Y"); @endphp
                    <a href="#">Control the work</a>.
                    {{ __('Open Source time control webapp by') }}
                    <a href="https://www.jesusamieiro.com" target="_blank">Jesús Amieiro</a>.
                    {{ __('All rights reserved.') }}
                </div>
            </div>
        </div>
    </footer>
</div>
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
                    // searchDelay: 1000,
                    processing: true,
                    serverSide: true,
                    // "bAutoWidth": true,  //Disabled auto width calculation....
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
                        {data: 'event_type_id', name: 'event_type_id', "width": "40%", 'searchable': false, 'orderable': false},
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
            // cancelButtonColor: '#d33',
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
                            {{--                        window.location.href = '{{ action('GestionAdministrativaController@index', $administrativo->id) }}'--}}
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

</body>
</html>