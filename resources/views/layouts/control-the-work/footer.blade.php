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
                <a href="https://www.controlthework.com" target="_blank">Control the work</a>.
                {{ __('Open Source time control webapp by') }}
                <a href="https://www.jesusamieiro.com" target="_blank">Jesús Amieiro</a>.
                {{ __('All rights reserved.') }}
            </div>
        </div>
    </div>
</footer>