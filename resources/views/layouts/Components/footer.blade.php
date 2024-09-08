<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © {{ date('Y') }}
                <a href="{{ env('COPYRIGHT_COMPANY_LINK') }}" target="_blank">
                    {{ env('COPYRIGHT_COMPANY_NAME') }}
                </a>
                <br>
                Power By
                <a href="{{ env('POWER_COMPANY_LINK') }}" target="_blank">
                    {{ env('POWER_COMPANY_NAME') }}
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
