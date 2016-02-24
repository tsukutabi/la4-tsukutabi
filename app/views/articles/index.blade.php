@extends('layout.top_pc')
@section('content')
    @include('elements.nav')
    @include('elements.slider')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/uikit/css/uikit.almost-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @include('elements.nav')
    <br/>
    <ol id="filters" class="fix-filter">
        <li data-filter="amsterdam">Amsterdam</li>
        <li data-filter="tokyo">Tokyo</li>
        <li data-filter="london">London</li>
        <li data-filter="paris">Paris</li>
        <li data-filter="berlin">Berlin</li>
        <li data-filter="sport">Sport</li>
        <li data-filter="fashion">Fashion</li>
        <li data-filter="video">Video</li>
        <li data-filter="art">Art</li>
        <li data-filter="berlin">Berlin</li>
        <li data-filter="sport">Sport</li>
        <li data-filter="fashion">Fashion</li>
        <li data-filter="video">Video</li>
        <li data-filter="art">Art</li>
        <li data-filter="fashion">Fashion</li>
        <li data-filter="video">Video</li>
        <li data-filter="art">Art</li>
    </ol>
    <br/>
    <div role="main">
        <ul id="container" class="tiles-wrap animated">
            @foreach($info as $article)
             <li data-filter-class='["london", "art"]'>
                 <a target="_blank" href="/view/{{$article->id}}">
                 <h2 class="main_title">{{$article->title}}</h2>
                 <p class="sub_title">{{$article->subtitle}}</p>
                 <?php $photo = explode('+',$article->photos) ?>
                 <img class="article_image" src="images/{{$article->user_id}}/{{$photo['0']}}" alt="">
                 <div class="user-data-alia">
                 <img class="uk-border-circle user-face" width="30" height="30" src="<?php if(isset($article->facephoto)){echo '/images/facephoto/'.$article->facephoto; }else{ echo "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTIwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjAgMTIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGRkZGRkYiIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNMTA5LjM1NCw5OS40NzhjLTAuNTAyLTIuODA2LTEuMTM4LTUuNDA0LTEuOTAzLTcuODAxYy0wLjc2Ny0yLjM5Ny0xLjc5Ny00LjczMi0zLjA5My03LjAxMQ0KCQljLTEuMjk0LTIuMjc2LTIuNzc4LTQuMjE3LTQuNDU1LTUuODIzYy0xLjY4MS0xLjYwNC0zLjcyOS0yLjg4Ny02LjE0OC0zLjg0NmMtMi40MjEtMC45NTgtNS4wOTQtMS40MzgtOC4wMTctMS40MzgNCgkJYy0wLjQzMSwwLTEuNDM3LDAuNTE2LTMuMDIsMS41NDVjLTEuNTgxLDEuMDMyLTMuMzY3LDIuMTgyLTUuMzU1LDMuNDVjLTEuOTksMS4yNzEtNC41NzgsMi40MjEtNy43NjUsMy40NTENCgkJQzY2LjQxLDgzLjAzNyw2My4yMSw4My41NTIsNjAsODMuNTUyYy0zLjIxMSwwLTYuNDEtMC41MTUtOS41OTgtMS41NDZjLTMuMTg4LTEuMDMtNS43NzctMi4xODEtNy43NjUtMy40NTENCgkJYy0xLjk5MS0xLjI2OS0zLjc3NC0yLjQxOC01LjM1NS0zLjQ1Yy0xLjU4Mi0xLjAyOS0yLjU4OC0xLjU0NS0zLjAyLTEuNTQ1Yy0yLjkyNiwwLTUuNTk4LDAuNDc5LTguMDE3LDEuNDM4DQoJCWMtMi40MiwwLjk1OS00LjQ3MSwyLjI0MS02LjE0NiwzLjg0NmMtMS42ODEsMS42MDYtMy4xNjQsMy41NDctNC40NTgsNS44MjNjLTEuMjk0LDIuMjc4LTIuMzI2LDQuNjEzLTMuMDkyLDcuMDExDQoJCWMtMC43NjcsMi4zOTYtMS40MDIsNC45OTUtMS45MDYsNy44MDFjLTAuNTAyLDIuODAzLTAuODM5LDUuNDE1LTEuMDA2LDcuODM1Yy0wLjE2OCwyLjQyMS0wLjI1Miw0LjkwMi0wLjI1Miw3LjQ0DQoJCWMwLDEuODg0LDAuMjA3LDMuNjI0LDAuNTgyLDUuMjQ3aDEwMC4wNjNjMC4zNzUtMS42MjMsMC41ODItMy4zNjMsMC41ODItNS4yNDdjMC0yLjUzOC0wLjA4NC01LjAyLTAuMjUzLTcuNDQNCgkJQzExMC4xOTIsMTA0Ljg5MywxMDkuODU3LDEwMi4yOCwxMDkuMzU0LDk5LjQ3OHoiLz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNNjAsNzguMTZjNy42MiwwLDE0LjEyNi0yLjY5NiwxOS41Mi04LjA4OGM1LjM5Mi01LjM5Myw4LjA4OC0xMS44OTgsOC4wODgtMTkuNTE5DQoJCXMtMi42OTYtMTQuMTI2LTguMDg4LTE5LjUxOUM3NC4xMjYsMjUuNjQzLDY3LjYyLDIyLjk0Niw2MCwyMi45NDZzLTE0LjEyOCwyLjY5Ny0xOS41MTksOC4wODkNCgkJYy01LjM5NCw1LjM5Mi04LjA4OSwxMS44OTctOC4wODksMTkuNTE5czIuNjk1LDE0LjEyNiw4LjA4OSwxOS41MTlDNDUuODcyLDc1LjQ2NCw1Mi4zOCw3OC4xNiw2MCw3OC4xNnoiLz4NCjwvZz4NCjwvc3ZnPg0K"; } ?>" alt="">
                 <p class="user-name">written by {{$article->username}}</p>
                 </div>
                 </a>
             </li>
            @endforeach
            <li data-filter-class='["london", "art"]'>
                <img src="../sample-images/image_1.jpg" height="283" width="200">
                <p>London Art</p>
            </li>
            <li data-filter-class='["berlin", "art"]'>
                <img src="../sample-images/image_2.jpg" height="300" width="200">
                <p>Berlin Art</p>
            </li>
            <li data-filter-class='["berlin", "video"]'>
                <img src="../sample-images/image_3.jpg" height="252" width="200">
                <p>Berlin Video</p>
            </li>
            <li data-filter-class='["tokyo", "fashion", "berlin"]'>
                <img src="../sample-images/image_4.jpg" height="158" width="200">
                <p>Tokyo Fashion Berlin</p>
            </li>
            <li data-filter-class='["berlin", "art"]'>
                <img src="../sample-images/image_5.jpg" height="300" width="200">
                <p>Berlin Art</p>
            </li>
            <li data-filter-class='["tokyo", "fashion"]'>
                <img src="../sample-images/image_6.jpg" height="297" width="200">
                <p>Tokyo Fashion</p>
            </li>
            <li data-filter-class='["london", "art"]'>
                <img src="../sample-images/image_7.jpg" height="200" width="200">
                <p>London Art</p>
            </li>
            <li data-filter-class='["tokyo", "video"]'>
                <img src="../sample-images/image_8.jpg" height="200" width="200">
                <p>Tokyo Video</p>
            </li>
            <li data-filter-class='["tokyo", "art"]'>
                <img src="../sample-images/image_9.jpg" height="398" width="200">
                <p>Tokyo Art</p>
            </li>
            <li data-filter-class='["berlin", "fashion"]'>
                <img src="../sample-images/image_10.jpg" height="267" width="200">
                <p>Berlin Fashion</p>
            </li>
            <li data-filter-class='["amsterdam", "art"]'>
                <img src="../sample-images/image_1.jpg" height="283" width="200">
                <p>Amsterdam Art</p>
            </li>
            <li data-filter-class='["paris", "video"]'>
                <img src="../sample-images/image_2.jpg" height="300" width="200">
                <p>Paris Video</p>
            </li>
            <li data-filter-class='["london", "video"]'>
                <img src="../sample-images/image_3.jpg" height="252" width="200">
                <p>London Video</p>
            </li>
            <li data-filter-class='["london", "video"]'>
                <img src="../sample-images/image_4.jpg" height="158" width="200">
                <p>London Video</p>
            </li>
            <li data-filter-class='["amsterdam"," video"]'>
                <img src="../sample-images/image_5.jpg" height="300" width="200">
                <p>Amsterdam Video</p>
            </li>
            <li data-filter-class='["tokyo", "fashion"]'>
                <img src="../sample-images/image_6.jpg" height="297" width="200">
                <p>Tokyo Fashion</p>
            </li>
            <li data-filter-class='["tokyo", "sport"]'>
                <img src="../sample-images/image_7.jpg" height="200" width="200">
                <p>Tokyo Sport</p>
            </li>
            <li data-filter-class='["berlin", "video"]'>
                <img src="../sample-images/image_8.jpg" height="200" width="200">
                <p>Berlin Video</p>
            </li>
            <li data-filter-class='["amsterdam", "fashion"]'>
                <img src="../sample-images/image_9.jpg" height="398" width="200">
                <p>Amsterdam Fashion</p>
            </li>
            <li data-filter-class='["berlin", "sport"]'>
                <img src="../sample-images/image_10.jpg" height="267" width="200">
                <p>Berlin Sport</p>
            </li>
            <li data-filter-class='["paris", "video"]'>
                <img src="../sample-images/image_1.jpg" height="283" width="200">
                <p>Paris Video</p>
            </li>
            <li data-filter-class='["tokyo", "sport"]'>
                <img src="../sample-images/image_2.jpg" height="300" width="200">
                <p>Tokyo Sport</p>
            </li>
            <li data-filter-class='["amsterdam", "art"]'>
                <img src="../sample-images/image_3.jpg" height="252" width="200">
                <p>Amsterdam Art</p>
            </li>
            <li data-filter-class='["berlin", "sport"]'>
                <img src="../sample-images/image_4.jpg" height="158" width="200">
                <p>Berlin Sport</p>
            </li>
            <li data-filter-class='["paris", "art"]'>
                <img src="../sample-images/image_5.jpg" height="300" width="200">
                <p>Paris Art</p>
            </li>
            <li data-filter-class='["berlin", "art"]'>
                <img src="../sample-images/image_6.jpg" height="297" width="200">
                <p>Berlin Art</p>
            </li>
            <li data-filter-class='["london", "art"]'>
                <img src="../sample-images/image_7.jpg" height="200" width="200">
                <p>London Art</p>
            </li>
            <li data-filter-class='["london", "video"]'>
                <img src="../sample-images/image_8.jpg" height="200" width="200">
                <p>London Video</p>
            </li>
            <li data-filter-class='["london", "video"]'>
                <img src="../sample-images/image_9.jpg" height="398" width="200">
                <p>London Video</p>
            </li>
            <li data-filter-class='["paris", "video"]'>
                <img src="../sample-images/image_10.jpg" height="267" width="200">
                <p>Paris Video</p>
            </li>
            <!-- End of grid blocks -->
        </ul>
    </div>
    <script src="{{ asset('packages/bower_components/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('packages/bower_components/wookmark/wookmark.js') }}" defer="defer"></script>
    <script type="text/javascript">(function($) {
            // Instantiate wookmark after all images have been loaded
            var wookmark,
                    container = '#container',
                    $container = $(container),
                    $window = $(window),
                    $document = $(document);

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
            function onScroll() {
                // Check if we're within 100 pixels of the bottom edge of the broser window.
                var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
                        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

                if (closeToBottom) {
                    // Get the first then items from the grid, clone them, and add them to the bottom of the grid
                    var $items = $('li', $container),
                            $firstTen = $items.slice(0, 10).clone().css('opacity', 0);
                    $container.append($firstTen);

                    wookmark.initItems();
                    wookmark.layout(true, function () {
                        // Fade in items after layout
                        setTimeout(function() {
                            $firstTen.css('opacity', 1);
                        }, 300);
                    });
                }
            };
            // Capture scroll event.
            $window.bind('scroll.wookmark', onScroll);
        })(jQuery);

        $(function() {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 700) {
                    $('.fix-filter').addClass('fixed');
                } else {
                    $('.fix-filter').removeClass('fixed');
                    console.log("removed");
                }
            });
        });
    </script>
@stop

