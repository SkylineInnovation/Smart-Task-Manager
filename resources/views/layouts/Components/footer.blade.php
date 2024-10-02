<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © {{ date('Y') }}
                {{-- <a href="{{ env('COPYRIGHT_COMPANY_LINK', 'javascript:;') }}" class="me-3"> --}}
                {{ env('COPYRIGHT_COMPANY_NAME', 'Codexal') }},
                {{-- </a> --}}
                {{-- <br> --}}
                Power By
                <a href="{{ env('POWER_COMPANY_LINK', 'javascript:;') }}" target="_blank">
                    {{-- {{ env('POWER_COMPANY_NAME', 'Codexal') }} --}}
                    <img src="{{ asset('assets/logo.png') }}" style="display: inline; height: 20px;">
                </a>

            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
