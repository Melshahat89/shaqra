<div class="trainers_item">

    <figure class="img">
        <a href="#">
            <img class="instructor_card_image " style="object-fit: contain;" src="{{ medium($data->logo) }}" loading="lazy" alt="{{ $data->title_lang }}">
        </a>
    </figure>   

    <footer class="trainers_item_content text_center">
{{--        <h5 class="trainers_item_content_title mbxs">--}}
{{--            <a href="#">{{ $data->title_lang }}</a>--}}
{{--        </h5>--}}
        <p><small>{{ $data->title_lang }}</small></p>
    </footer>
</div>