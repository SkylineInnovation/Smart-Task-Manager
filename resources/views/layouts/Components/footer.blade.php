<!-- FOOTER -->

<footer class="footer">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-md-8 col-sm-8 text-center">
                Copyright © {{ date('Y') }}
                {{-- <a href="{{ env('COPYRIGHT_COMPANY_LINK', 'javascript:;') }}" class="me-3"> --}}
                {{ env('COPYRIGHT_COMPANY_NAME', 'Codexal') }}
                {{-- </a> --}}
                {{-- <br> --}}
            </div>
            {{-- {{ env('POWER_COMPANY_NAME', 'Codexal') }} --}}
            <div class="col-md-4 col-sm-4 col-4 text-end pe-5">
                Power By
                <a href="{{ env('POWER_COMPANY_LINK', 'javascript:;') }}" target="_blank">
                    <img src="{{ asset('assets/logo.png') }}" style="display: inline; height: 20px;">
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
