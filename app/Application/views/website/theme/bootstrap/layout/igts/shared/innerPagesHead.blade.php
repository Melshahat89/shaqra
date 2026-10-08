<section class="sec sec_pad_top sec_pad_bottom bg_gradient {{ (isMobile()) ? '' : 'sticky-stopper' }}" dir="rtl" lang="ar">
    <div class="wrapper">
        {{-- DGA Platforms Code — Breadcrumb (current page non-interactive, aria-current) --}}
        <nav class="dga-breadcrumb" aria-label="مسار التنقل">
            <ol>
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li>
                    {!! dgaIcon('arrow-left-01', 'dga-breadcrumb-sep', ['width' => 16, 'height' => 16]) !!}
                    <span aria-current="page">{{ $title }}</span>
                </li>
            </ol>
        </nav>
        <section class="title mblg">
            <h1 class="text_white text_capitalize">{{ $title }}</h1>
            @if(isset($subTitle) && $subTitle)
                <p style="color: white;">{{ $subTitle }}</p>
            @endif
        </section>
    </div>
</section>
