@extends('layouts.control-the-work.app')

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    {{ __('Users') }}
                </h1>
            </div>
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Users') }}</h3>
                            <a href="{{ action('UserController@create') }}" type="button" class="btn btn-primary ml-auto">{{ __('New user') }}</a>
                        </div>
                        <div class="table-responsive">
                            <table id="users-table" class="table card-table table-striped table-vcenter ">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Verified') }}</th>
                                    <th>{{ __('Actions') }}</th>
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
            $(document).ready(function () {
                $(function () {
                    $('#users-table').DataTable({
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
                        ajax: '{{ action('UserController@listDatatables') }}',
                        columns: [
                            {data: 'name_surname', name: 'name_surname', "width": "20%", 'searchable': false, 'orderable': false},
                            {data: 'email', name: 'email', "width": "25%", 'searchable': false, 'orderable': false},
                            {data: 'role_name', name: 'role_name', "width": "20%", 'searchable': false, 'orderable': false},
                            {data: 'email_verified_at', name: 'email_verified_at', "width": "15%", 'searchable': false, 'orderable': false, "defaultContent": "<i>Not set</i>"},
                            {data: 'actions', name: 'actions', "width": "20%", 'searchable': false, 'orderable': false},
                        ]
                    });
                });
            });

            $('#users-table').on('click', '.btn.delete[data-remote]', function (e) {
                console.log($(this).data('remote'));
                var url = $(this).data('remote');
                deleteUser(url);
            });

            function deleteUser(url) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec6c62',
                    confirmButtonText: '{{ __('Delete the user') }}',
                    cancelButtonText: '{{ __('Cancel') }}',
                }).then((result) => {
                    console.log(result);
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function () {
                                Swal.fire({
                                    position: 'top-end',
                                    title: ' {{ __('Deleted!') }} ',
                                    text: ' {{ __('The user has been deleted.') }}',
                                    type: "success",
                                    timer: 1500,
                                }).then(function () {
                                    $('#users-table').DataTable().draw(false);
                                })
                            },
                            error: function () {
                                Swal.fire({
                                    title: ' {{ __('Error!') }} ',
                                    text: ' {{ __('The user has not been deleted.') }}',
                                    type: 'error',
                                });
                            }
                        })
                    }
                });
            }
        }
    </script>
@endsection