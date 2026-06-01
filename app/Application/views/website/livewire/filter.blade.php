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
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                    </svg>
                    {{ trans('website.Filter') }}
                </h3>
                <button type="button" class="dga-filter-toggle" data-toggle="collapse"
                        data-target="#dgaFilterBody" aria-expanded="true" aria-controls="dgaFilterBody"
                        aria-label="إظهار / إخفاء الفلاتر">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
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
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
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
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
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
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    {{-- Sort --}}
                    <div class="dga-filter-group">
                        <label class="dga-filter-label" for="sort">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M6 12h12M10 18h4"/>
                            </svg>
                            {{ trans('website.Sort By') }}
                        </label>
                        <div class="dga-filter-select-wrap">
                            <select id="sort" name="sort" wire:model="sortBy" class="dga-filter-select">
                                <option value="">{{ trans('website.Release Date') }}</option>
                                <option value="0">{{ trans('website.New to old') }}</option>
                                <option value="1">{{ trans('website.Old to new') }}</option>
                            </select>
                            <svg class="dga-filter-select-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Speciality --}}
                    <div class="dga-filter-group">
                        <label class="dga-filter-label" for="categories">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                            </svg>
                            {{ trans('website.Speciality') }}
                        </label>
                        <div class="dga-filter-select-wrap">
                            <select id="categories" name="categories" wire:model="speciality" class="dga-filter-select">
                                <option value="">{{ trans('account.Select specialization') }}</option>
                                @foreach(allCategories() as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name_lang }}</option>
                                @endforeach
                            </select>
                            <svg class="dga-filter-select-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Ratings --}}
                    <div class="dga-filter-group">
                        <span class="dga-filter-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            {{ trans('website.Ratings') }}
                        </span>
                        <div class="dga-filter-stars">
                            @foreach([5,4,3,2] as $r)
                            <label class="dga-filter-star-row {{ $rating == $r ? 'is-checked' : '' }}">
                                <input type="radio" name="rating" value="{{ $r }}" wire:model="rating" class="dga-vis-hidden">
                                <span class="dga-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $i <= $r ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" class="{{ $i <= $r ? 'dga-star-on' : 'dga-star-off' }}">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
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
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
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
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                        </svg>
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
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="8" y1="11" x2="14" y2="11"/>
                </svg>
            </div>
            <h3>لم نعثر على نتائج تطابق بحثك</h3>
            <p>جرّب تعديل الفلاتر أو إعادة ضبطها للعثور على دورات تناسبك</p>
            <button type="button" wire:click="resetFilter" class="dga-btn dga-btn-green">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                </svg>
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
