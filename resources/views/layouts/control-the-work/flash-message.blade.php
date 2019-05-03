{{ $type='' }}
{{ $message='' }}
@if (Session::get('success'))
    {{ $type = 'success' }}
    {{ $message = Session::get('success') }}
@endif
@if (Session::get('error'))
    {{ $type = 'error' }}
    {{ $message = Session::get('error') }}
@endif
@if (Session::get('warning'))
    {{ $type = 'warning' }}
    {{ $message = Session::get('warning') }}
@endif
@if (Session::get('info'))
    {{ $type = 'info' }}
    {{ $message = Session::get('info') }}
@endif

@if ($message)
    <script type="text/javascript">
        Swal.fire({
            position: 'top-end',
            text: ' {{ __($message) }}',
            type: '{{ $type }}',
            showConfirmButton: false,
            timer: 3000,
        })
    </script>
@endif