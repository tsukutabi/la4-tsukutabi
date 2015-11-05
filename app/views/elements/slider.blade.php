<link rel="stylesheet" href="{{ asset('packages/bower_components/slider-pro/dist/css/slider-pro.css') }}">

<div class="slider-pro" id="my-slider">
    <div class="sp-slides">
        <!-- Slide 1 -->
        <div class="sp-slide">
            <h1 class="sp-layer slider_h1">つくたび</h1>
            <img class="sp-image" src="images/slider/image01.jpg"/>
        </div>

        <!-- Slide 2 -->
        <div class="sp-slide">
            <p>Lorem ipsum dolor sit amet</p>
            <img class="sp-image" src="images/slider/image02.jpg"/>
        </div>

        <!-- Slide 3 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image03.jpg"/>
        </div>

        <!-- Slide 4 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image04.jpg"/>
        </div>
        <!-- Slide 5 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image05.jpg"/>
        </div>
        <!-- Slide 6 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image06.jpg"/>
        </div>
        <!-- Slide 7 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image07.jpg"/>
        </div>
        <!-- Slide 8 -->
        <div class="sp-slide">
            <p class="sp-layer">consectetur adipisicing elit</p>
            <img class="sp-image" src="images/slider/image08.jpg"/>
        </div>

        <div class="sp-thumbnails">
            <img class="sp-thumbnail" src="images/slider/image01.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image02.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image03.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image04.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image05.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image06.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image07.jpg"/>
            <img class="sp-thumbnail" src="images/slider/image08.jpg"/>
         </div>

    </div>
</div>
<script src="{{ asset('packages/bower_components/slider-pro/dist/js/jquery.sliderPro.min.js') }}"></script>
<script type="text/javascript">
    jQuery( document ).ready(function( $ ) {
        $( '#my-slider' ).sliderPro({
            forceSize: 'fullWidth',
            arrows: true,
            height: 200,
            thumbnailWidth: 192,
            thumbnailHeight: 100,
            loop:true,
            buttons:false,

        });
    });
</script>