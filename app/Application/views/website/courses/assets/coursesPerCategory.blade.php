{{--
    Legacy `innerPagesHead` removed — parent provides DGA hero.
    Keep the original `.wrapper` + .row structure intact so Bootstrap
    grid math inside the Livewire `filter` component stays correct.
--}}
<section class="sec sec_pad_top sec_pad_bottom dga-listing">
    <div class="wrapper">
        {{-- DGA Search template — search bar must be present on the results page (criterion 10) --}}
        <form class="dga-search dga-results-search" action="{{ url()->current() }}" method="GET" role="search" aria-label="البحث في الدورات" style="margin-bottom: var(--dga-space-3xl);">
            <div class="dga-input-wrap">
                {!! dgaIcon('search-01', '') !!}
                <label for="dga-results-key" class="sr-only">{{ trans('home.search placeholder') }}</label>
                <input id="dga-results-key" type="search" name="key" class="dga-input" value="{{ $key ?? '' }}" placeholder="{{ trans('home.search placeholder') }}" autocomplete="off">
            </div>
            <button type="submit" class="dga-btn dga-btn-primary">
                {!! dgaIcon('search-01', '') !!}
                {{ trans('website.Search') }}
            </button>
        </form>
        <div class="with_aside_flex aside_sm">
            <div tag id="categoryList" class="list-view">
                <div class="course_card_list">
                    <div class="row">
                        @livewire('filter', ['talks' => false, 'events' => false, 'type' => $type, 'key' => $key, 'slug' => $slug])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
