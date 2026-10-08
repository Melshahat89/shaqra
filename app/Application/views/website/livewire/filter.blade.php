{{-- ══════════════════════════════════════════════════════════
     COURSES FILTER (Livewire) — DGA / Shaqra design
     All wire:model bindings preserved; only markup + CSS classes.
══════════════════════════════════════════════════════════ --}}
<div class="row dga-filter-wrap" dir="rtl">

    {{-- ── SIDEBAR FILTER ── --}}
    <aside class="col-md-3 dga-filter-side">
        <div class="dga-filter-card" id="{{ (isMobile() || (count($items) < 2)) ? '' : 'test1' }}">

            {{-- Header --}}
            <div class="dga-filter-head">
                <h3>
                    {!! dgaIcon('filter', '', ['width' => 18, 'height' => 18]) !!}
                    {{ trans('website.Filter') }}
                </h3>
                <button type="button" class="dga-filter-toggle" data-toggle="collapse"
                        data-target="#dgaFilterBody" aria-expanded="true" aria-controls="dgaFilterBody"
                        aria-label="إظهار / إخفاء الفلاتر">
                    {!! dgaIcon('arrow-down-01', '', ['height' => 16]) !!}
                </button>
            </div>

            {{-- Active filters chips --}}
            @php
                $activeCount = 0;
                if($key)        $activeCount++;
                if($sortBy !== null && $sortBy !== '') $activeCount++;
                if($speciality) $activeCount++;
                if($rating)     $activeCount++;
                if($duration)   $activeCount++;
            @endphp
            @if($activeCount > 0)
            <div class="dga-filter-active">
                <span class="dga-filter-active-label">
                    {{ $activeCount }} {{ trans('website.Filter') }}
                </span>
                <button type="button" wire:click="resetFilter" class="dga-filter-clear">
                    {!! dgaIcon('cancel-01', '', ['height' => 12]) !!}
                    {{ trans('website.Reset Filter') }}
                </button>
            </div>
            @endif

            {{-- Body --}}
            <div class="collapse multi-collapse {{ (isMobile()) ? '' : 'show' }} dga-filter-body" id="dgaFilterBody">
                <form action="" method="GET" wire:submit.prevent="updateFilter">

                    {{-- Search --}}
                    <div class="dga-filter-group">
                        <label class="dga-filter-label" for="key">
                            {!! dgaIcon('search-01', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.Search') }}
                        </label>
                        <div class="dga-filter-input-wrap">
                            <input type="text" id="key" name="key"
                                   wire:model.debounce.400ms="key"
                                   class="dga-filter-input"
                                   placeholder="{{ trans('website.Search Placeholder') }}"
                                   autocomplete="off">
                            @if($key)
                            <button type="button" class="dga-filter-input-clear"
                                    wire:click="$set('key', '')" aria-label="مسح البحث">
                                {!! dgaIcon('cancel-01', '', ['height' => 12]) !!}
                            </button>
                            @endif
                        </div>
                    </div>

                    {{-- Sort --}}
                    <div class="dga-filter-group">
                        <label class="dga-filter-label" for="sort">
                            {!! dgaIcon('sorting-05', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.Sort By') }}
                        </label>
                        <div class="dga-filter-select-wrap">
                            <select id="sort" name="sort" wire:model="sortBy" class="dga-filter-select">
                                <option value="">{{ trans('website.Release Date') }}</option>
                                <option value="0">{{ trans('website.New to old') }}</option>
                                <option value="1">{{ trans('website.Old to new') }}</option>
                            </select>
                            {!! dgaIcon('arrow-down-01', 'dga-filter-select-icon', ['height' => 14]) !!}
                        </div>
                    </div>

                    {{-- Speciality --}}
                    <div class="dga-filter-group">
                        <label class="dga-filter-label" for="filter-categories">
                            {!! dgaIcon('folder-01', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.Speciality') }}
                        </label>
                        <div class="dga-filter-select-wrap">
                            <select id="filter-categories" name="categories" wire:model="speciality" class="dga-filter-select">
                                <option value="">{{ trans('account.Select specialization') }}</option>
                                @foreach(allCategories() as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name_lang }}</option>
                                @endforeach
                            </select>
                            {!! dgaIcon('arrow-down-01', 'dga-filter-select-icon', ['height' => 14]) !!}
                        </div>
                    </div>

                    {{-- Ratings --}}
                    <div class="dga-filter-group">
                        <span class="dga-filter-label">
                            {!! dgaIcon('star', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.Ratings') }}
                        </span>
                        <div class="dga-filter-stars">
                            @foreach([5,4,3,2] as $r)
                            <label class="dga-filter-star-row {{ $rating == $r ? 'is-checked' : '' }}">
                                <input type="radio" name="rating" value="{{ $r }}" wire:model="rating" class="dga-vis-hidden">
                                <span class="dga-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                    {!! dgaIcon('star', '{{ $i <= $r ? \'dga-star-on\' : \'dga-star-off\' }}', ['width' => 14, 'height' => 14]) !!}
                                    @endfor
                                </span>
                                <span class="dga-filter-star-text">{{ number_format($r, 1) }} {{ $r > 1 ? 'فأكثر' : '' }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Duration (courses only) --}}
                    @if(!$talks && !$events)
                    <div class="dga-filter-group">
                        <span class="dga-filter-label">
                            {!! dgaIcon('clock-01', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.Duration') }}
                        </span>
                        <div class="dga-filter-pills">
                            @php
                                $durations = [
                                    '0:2'    => '0-2 '.trans('website.hours'),
                                    '3:6'    => '3-6 '.trans('website.hours'),
                                    '7:16'   => '7-16 '.trans('website.hours'),
                                    '17:100' => '+17 '.trans('website.hours'),
                                ];
                            @endphp
                            @foreach($durations as $value => $label)
                            <label class="dga-filter-pill {{ $duration === $value ? 'is-checked' : '' }}">
                                <input type="radio" name="duration" value="{{ $value }}" wire:model="duration" class="dga-vis-hidden">
                                <span>{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Reset bottom --}}
                    @if($activeCount > 0)
                    <button type="button" wire:click="resetFilter" class="dga-filter-reset-btn">
                        {!! dgaIcon('reload', '', ['width' => 14, 'height' => 14]) !!}
                        {{ trans('website.Reset Filter') }}
                    </button>
                    @endif

                </form>
            </div>
        </div>
    </aside>

    {{-- ── RESULTS COLUMN ── --}}
    <section class="{{ (count($items) < 1) ? 'col-12' : 'col-md-9' }} dga-results-col" style="background-color: unset !important;">

        {{-- Results header --}}
        <div class="dga-results-head">
            <div class="dga-results-count">
                @if(count($items) > 0)
                    <strong>{{ $items->total() }}</strong>
                    <span>{{ trans('home.courses') }}</span>
                @else
                    <span>لا توجد نتائج</span>
                @endif
                @if($key)
                <span class="dga-results-query">{{ trans('website.Search') }}: «{{ $key }}»</span>
                @endif
            </div>

            {{-- Inline quick sort (top of cards) --}}
            <div class="dga-results-sort">
                <label for="quickSort">{{ trans('website.Sort By') }}:</label>
                <select id="quickSort" wire:model="sortBy" class="dga-filter-select dga-filter-select--sm">
                    <option value="">{{ trans('website.Release Date') }}</option>
                    <option value="0">{{ trans('website.New to old') }}</option>
                    <option value="1">{{ trans('website.Old to new') }}</option>
                </select>
            </div>
        </div>

        {{-- Empty state --}}
        @if(count($items) < 1)
        <div class="dga-empty">
            <div class="dga-empty-icon">
                {!! dgaIcon('search-01', '', ['height' => 56]) !!}
            </div>
            <h3>لم نعثر على نتائج تطابق بحثك</h3>
            <p>جرّب تعديل الفلاتر أو إعادة ضبطها للعثور على دورات تناسبك</p>
            <button type="button" wire:click="resetFilter" class="dga-btn dga-btn-green">
                {!! dgaIcon('reload', '', ['width' => 14, 'height' => 14]) !!}
                {{ trans('website.Reset Filter') }}
            </button>
        </div>
        @else

        {{-- Loading state (Livewire) --}}
        <div wire:loading.delay class="dga-results-loading">
            <div class="dga-spinner"></div>
            <span>جاري التحميل...</span>
        </div>

        {{-- Course cards --}}
        <div wire:loading.remove>
            @foreach($items as $item)
                @include('website.courses.assets.courseCardList', ['data' => $item])
            @endforeach
        </div>

        <div class="global-pagenation flexBetween dga-pagination">
            {{ $items->links('website.livewire.livewire-pagination') }}
        </div>
        @endif

    </section>
</div>
