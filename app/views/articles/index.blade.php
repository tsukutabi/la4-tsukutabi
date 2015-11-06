@extends('layout.default')
@section('content')
    @include('elements.navi')
    @include('elements.slider')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/uikit/css/uikit.almost-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/wookmark/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/wookmark/css/overview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @include('elements.navi')

    {{--<div class="uk-slidenav-position" data-uk-slider>--}}
        {{--<div class="uk-slider-container">--}}
            {{--<ul class="uk-slider uk-grid-width-medium-1-4">--}}
                {{--<li>あああああ</li>--}}
                {{--<li>あああああ</li><li>あああああ</li><li>あああああ</li><li>あああああ</li><li>あああああ</li><li>あああああ</li>--}}

            {{--</ul>--}}
        {{--</div>--}}

        {{--<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>--}}
        {{--<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>--}}
    {{--</div>--}}

    {{--<script>--}}

    {{--</script>--}}
    <ol id="filters" class="filter-list">
        <li data-filter="amsterdam">Amsterdam</li>
        <li data-filter="tokyo">Tokyo</li>
        <li data-filter="london">London</li>
        <li data-filter="paris">Paris</li>
        <li data-filter="berlin">Berlin</li>
        <li data-filter="sport">Sport</li>
        <li data-filter="fashion">Fashion</li>
        <li data-filter="video">Video</li>
        <li data-filter="art">Art</li>
    </ol>
        <ul id="container" class="tiles-wrap animated">
    @foreach($info as $article)
        <a href="/view/{{ $article->id }}" class="link" target="_blank" data-filter-class='["berlin", "art"]'>
            <li class="link">
                <h2 class="wook_h2">{{ $article->title }}</h2>
                <?php $photo = explode('+',$article->photos);?>
                <img  src="images/{{$article->user_id}}/{{ $photo[0] }}" class="img-rounded wook_img" width="200" >
                <p class="wook_p">{{ $article->subtitle }}</p>
                <p class="wook_by"> writen by だれだれ</p>
            </li>
        </a>
    @endforeach

        <a href="" class="link" data-filter-class='["berlin", "Fashion"]'>
            <li>
                <h1>aa</h1>
            </li>
        </a>
        </ul>
    <script src="{{ asset('packages/bower_components/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('packages/bower_components/wookmark/wookmark.js') }}" defer="defer"></script>
    <script type="text/javascript">(function($) {
            // Instantiate wookmark after all images have been loaded
            var wookmark;
            imagesLoaded('#container', function() {
                wookmark = new Wookmark('#container', {
                    fillEmptySpace: true // Optional, fill the bottom of each column with widths of flexible height
                });
            });

            // Setup filter buttons when jQuery is available
            var $filters = $('#filters li');

            /**
             * When a filter is clicked, toggle it's active state and refresh.
             */
            function onClickFilter(e) {
                var $item = $(e.currentTarget),
                        activeFilters = [],
                        filterType = $item.data('filter');

                if (filterType === 'all') {
                    $filters.removeClass('active');
                } else {
                    $item.toggleClass('active');

                    // Collect active filter strings
                    $filters.filter('.active').each(function() {
                        activeFilters.push($(this).data('filter'));
                    });
                }

                wookmark.filter(activeFilters, 'and');
            }

            // Capture filter click events.
            $('#filters').on('click.wookmark-filter', 'li', onClickFilter);
        })(jQuery);
    </script>
@stop

