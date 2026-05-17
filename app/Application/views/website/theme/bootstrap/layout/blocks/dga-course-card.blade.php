@php
    $discountApplied = false;
    $discountValue = 0;
    if(userCountry()['code'] == "EG") {
        if($data->discount_egp > 0) { $discountApplied = true; $discountValue = round($data->discount_egp); }
    } else {
        if($data->discount_usd > 0) { $discountApplied = true; $discountValue = round($data->discount_usd); }
    }
@endphp

<article class="dga-course-card" itemscope itemtype="https://schema.org/Course">
    <a href="{{ url('/courses/view/'.$data->slug) }}" class="dga-course-card-img" style="display:block;" itemprop="url">
        <img
            src="{{ medium($data->image) }}"
            alt="{{ $data->title_lang }}"
            loading="lazy"
            itemprop="image"
        >
        @if($discountApplied)
            <span class="dga-course-card-badge dga-course-card-discount">خصم {{ $discountValue }}%</span>
        @elseif($data->created_at && $data->created_at->diffInDays(now()) <= 14)
            <span class="dga-course-card-badge">جديد</span>
        @endif
    </a>

    <div class="dga-course-card-body">
        @if(isset($data->categories) && $data->categories)
            <div class="dga-course-card-category">{{ $data->categories->name_lang }}</div>
        @endif

        <a href="{{ url('/courses/view/'.$data->slug) }}" class="dga-course-card-title" style="display:block;" itemprop="name">
            {{ $data->title_lang }}
        </a>

        <div class="dga-course-card-meta">
            @if(isset($data->courselectures) && $data->courselectures->count())
                <span><i class="fas fa-play-circle"></i> {{ $data->courselectures->count() }} {{ trans('courses.lectures') }}</span>
            @endif
            @if($data->length)
                <span><i class="fas fa-clock"></i> {{ $data->getHoursLectures($data->length) }} {{ trans('website.hours') }}</span>
            @endif
            @if($data->visits > 0)
                <span><i class="fas fa-eye"></i>
                    {{ ($data->visits >= 1000000) ? number_format($data->visits/1000000,1).'M' : (($data->visits >= 1000) ? number_format($data->visits/1000,0).'K' : $data->visits) }}
                </span>
            @endif
        </div>

        <div class="dga-course-card-footer">
            <div class="dga-course-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                {!! $data->PriceText !!}
            </div>
            <a href="{{ url('/courses/view/'.$data->slug) }}" class="dga-btn dga-btn-primary dga-btn-sm">
                التفاصيل
            </a>
        </div>
    </div>
</article>
