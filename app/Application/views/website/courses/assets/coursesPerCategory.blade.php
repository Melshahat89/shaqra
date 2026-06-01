{{--
    Legacy `innerPagesHead` removed — parent provides DGA hero.
    Keep the original `.wrapper` + .row structure intact so Bootstrap
    grid math inside the Livewire `filter` component stays correct.
--}}
<section class="sec sec_pad_top sec_pad_bottom dga-listing">
    <div class="wrapper">
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
