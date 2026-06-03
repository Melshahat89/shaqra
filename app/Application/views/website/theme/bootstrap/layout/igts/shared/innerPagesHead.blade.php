<section class="sec sec_pad_top sec_pad_bottom bg_gradient {{ (isMobile()) ? '' : 'sticky-stopper' }}" dir="rtl" lang="ar">
    <div class="wrapper">
        <nav class="dga-breadcrumb mb-2" aria-label="مسار التنقل" style="font-size:13px;opacity:0.85;">
            <a href="{{ url('/') }}" style="color:rgba(255,255,255,0.75);text-decoration:none;">الرئيسية</a>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="2.5" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
            <span style="color:#fff;">{{$title}}</span>
        </nav>
        <section class="title mblg">
            <h1 class="text_white text_capitalize">{{$title}}</h1>
            <p style="color: white;">{{isset($subTitle) ? $subTitle : ''}}</p>
        </section>
    </div>
</section>