<div class="col-md-3  col-6 mb-4 d-flex justify-content-center ">
    <a href="{{ $link }}" class="mouseHover col-md-11 py-3">
        <div class="col-md-12 d-flex justify-content-center pb-3"><img src="{{ $image }}" width="72px"
                height="72px" alt=""></div>
        <div class="col-md-12 d-flex justify-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
            <small>{{ $text }}</small></div>
    </a>
</div>
