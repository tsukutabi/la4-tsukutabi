@extends('layout.default')
@section('content')
    <script src="{{ asset('packages/bower_components/sly/dist/sly.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/jquery-easing/jquery.easing.js') }}" defer="defer"></script>
    <script src="{{ asset('js/hor.js') }}" defer="defer"></script>
    <script>
        jQuery(function($){
            'use strict';

            // -------------------------------------------------------------
            //   Basic Navigation
            // -------------------------------------------------------------
            (function () {
                var $frame  = $('#basic');
                var $slidee = $frame.children('ul').eq(0);
                var $wrap   = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'basic',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 3,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    pagesBar: $wrap.find('.pages'),
                    activatePageOn: 'click',
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Buttons
                    forward: $wrap.find('.forward'),
                    backward: $wrap.find('.backward'),
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next'),
                    prevPage: $wrap.find('.prevPage'),
                    nextPage: $wrap.find('.nextPage')
                });

                // To Start button
                $wrap.find('.toStart').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the start of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toStart', item);
                });

                // To Center button
                $wrap.find('.toCenter').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the center of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toCenter', item);
                });

                // To End button
                $wrap.find('.toEnd').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the end of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toEnd', item);
                });

                // Add item
                $wrap.find('.add').on('click', function () {
                    $frame.sly('add', '<li>' + $slidee.children().length + '</li>');
                });

                // Remove item
                $wrap.find('.remove').on('click', function () {
                    $frame.sly('remove', -1);
                });
            }());

            // -------------------------------------------------------------
            //   Centered Navigation
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#centered');
                var $wrap  = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'centered',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 4,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });
            }());

            // -------------------------------------------------------------
            //   Force Centered Navigation
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#forcecentered');
                var $wrap  = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'forceCentered',
                    smart: 1,
                    activateMiddle: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });
            }());

            // -------------------------------------------------------------
            //   Cycle By Items
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#cycleitems');
                var $wrap  = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'basic',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Cycling
                    cycleBy: 'items',
                    cycleInterval: 1000,
                    pauseOnHover: 1,

                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });

                // Pause button
                $wrap.find('.pause').on('click', function () {
                    $frame.sly('pause');
                });

                // Resume button
                $wrap.find('.resume').on('click', function () {
                    $frame.sly('resume');
                });

                // Toggle button
                $wrap.find('.toggle').on('click', function () {
                    $frame.sly('toggle');
                });
            }());

            // -------------------------------------------------------------
            //   Cycle By Pages
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#cyclepages');
                var $wrap  = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'basic',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    pagesBar: $wrap.find('.pages'),
                    activatePageOn: 'click',
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Cycling
                    cycleBy: 'pages',
                    cycleInterval: 1000,
                    pauseOnHover: 1,
                    startPaused: 1,

                    // Buttons
                    prevPage: $wrap.find('.prevPage'),
                    nextPage: $wrap.find('.nextPage')
                });

                // Pause button
                $wrap.find('.pause').on('click', function () {
                    $frame.sly('pause');
                });

                // Resume button
                $wrap.find('.resume').on('click', function () {
                    $frame.sly('resume');
                });

                // Toggle button
                $wrap.find('.toggle').on('click', function () {
                    $frame.sly('toggle');
                });
            }());

            // -------------------------------------------------------------
            //   One Item Per Frame
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#oneperframe');
                var $wrap  = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'forceCentered',
                    smart: 1,
                    activateMiddle: 1,
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });
            }());

            // -------------------------------------------------------------
            //   Crazy
            // -------------------------------------------------------------
            (function () {
                var $frame  = $('#crazy');
                var $slidee = $frame.children('ul').eq(0);
                var $wrap   = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'basic',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 3,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    pagesBar: $wrap.find('.pages'),
                    activatePageOn: 'click',
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,

                    // Buttons
                    forward: $wrap.find('.forward'),
                    backward: $wrap.find('.backward'),
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next'),
                    prevPage: $wrap.find('.prevPage'),
                    nextPage: $wrap.find('.nextPage')
                });

                // To Start button
                $wrap.find('.toStart').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the start of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toStart', item);
                });

                // To Center button
                $wrap.find('.toCenter').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the center of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toCenter', item);
                });

                // To End button
                $wrap.find('.toEnd').on('click', function () {
                    var item = $(this).data('item');
                    // Animate a particular item to the end of the frame.
                    // If no item is provided, the whole content will be animated.
                    $frame.sly('toEnd', item);
                });

                // Add item
                $wrap.find('.add').on('click', function () {
                    $frame.sly('add', '<li>' + $slidee.children().length + '</li>');
                });

                // Remove item
                $wrap.find('.remove').on('click', function () {
                    $frame.sly('remove', -1);
                });
            }());
        });
    </script>
    <header class="view_header">
        <img src="" alt="ロゴだよ">
        <h1>タイトル</h1>
        <h2>サブタイトル</h2>
        @include ('elements.search')
        <img src="" alt="顔写真だよ">
        <p>wrriten by オレオレ</p>
    </header>

    <div class="pagespan container">
        <div class="wrap">


            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>

            <div class="frame" id="basic">
                <ul class="clearfix">
                    <li>0</li><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li>
                    <li>10</li><li>11</li><li>12</li><li>13</li><li>14</li><li>15</li><li>16</li><li>17</li><li>18</li>
                    <li>19</li><li>20</li><li>21</li><li>22</li><li>23</li><li>24</li><li>25</li><li>26</li><li>27</li>
                    <li>28</li><li>29</li>
                </ul>
            </div>

            <ul class="pages"></ul>

            <div class="controls center">
                <button class="btn prevPage"><i class="icon-chevron-left"></i><i class="icon-chevron-left"></i> page</button>
                <button class="btn prev"><i class="icon-chevron-left"></i> item</button>
                <button class="btn backward"><i class="icon-chevron-left"></i> move</button>

                <div class="btn-group">
                    <button class="btn toStart">toStart</button>
                    <button class="btn toCenter">toCenter</button>
                    <button class="btn toEnd">toEnd</button>
                </div>

                <div class="btn-group">
                    <button class="btn toStart" data-item="10"><strong>10</strong> toStart</button>
                    <button class="btn toCenter" data-item="10"><strong>10</strong> toCenter</button>
                    <button class="btn toEnd" data-item="10"><strong>10</strong> toEnd</button>
                </div>

                <div class="btn-group">
                    <button class="btn add"><i class="icon-plus-sign"></i></button>
                    <button class="btn remove"><i class="icon-minus-sign"></i></button>
                </div>

                <button class="btn forward">move <i class="icon-chevron-right"></i></button>
                <button class="btn next">item <i class="icon-chevron-right"></i></button>
                <button class="btn nextPage">page <i class="icon-chevron-right"></i><i class="icon-chevron-right"></i></button>
            </div>
        </div>
        <style>
            .view_header{
                overflow: hidden;
            }
            .view_header *{
                float: left;
                margin: 0 auto;
            }

            body { background: #e8e8e8; }
            .container { margin: 0 auto; }

            /* Example wrapper */
            .wrap {
                position: relative;
                margin: 3em 0;
            }

            /* Frame */
            .frame {
                height: 250px;
                line-height: 250px;
                overflow: hidden;
            }
            .frame ul {
                list-style: none;
                margin: 0;
                padding: 0;
                height: 100%;
                font-size: 50px;
            }
            .frame ul li {
                float: left;
                width: 227px;
                height: 100%;
                margin: 0 1px 0 0;
                padding: 0;
                background: #333;
                color: #ddd;
                text-align: center;
                cursor: pointer;
            }
            .frame ul li.active {
                color: #fff;
                background: #a03232;
            }

            /* Scrollbar */
            .scrollbar {
                margin: 0 0 1em 0;
                height: 2px;
                background: #ccc;
                line-height: 0;
            }
            .scrollbar .handle {
                width: 100px;
                height: 100%;
                background: #292a33;
                cursor: pointer;
            }
            .scrollbar .handle .mousearea {
                position: absolute;
                top: -9px;
                left: 0;
                width: 100%;
                height: 20px;
            }

            /* Pages */
            .pages {
                list-style: none;
                margin: 20px 0;
                padding: 0;
                text-align: center;
            }
            .pages li {
                display: inline-block;
                width: 14px;
                height: 14px;
                margin: 0 4px;
                text-indent: -999px;
                border-radius: 10px;
                cursor: pointer;
                overflow: hidden;
                background: #fff;
                box-shadow: inset 0 0 0 1px rgba(0,0,0,.2);
            }
            .pages li:hover {
                background: #aaa;
            }
            .pages li.active {
                background: #666;
            }

            /* Controls */
            .controls { margin: 25px 0; text-align: center; }

            /* One Item Per Frame example*/
            .oneperframe { height: 300px; line-height: 300px; }
            .oneperframe ul li { width: 1140px; }
            .oneperframe ul li.active { background: #333; }

            /* Crazy example */
            .crazy ul li:nth-child(2n) { width: 100px; margin: 0 4px 0 20px; }
            .crazy ul li:nth-child(3n) { width: 300px; margin: 0 10px 0 5px; }
            .crazy ul li:nth-child(4n) { width: 400px; margin: 0 30px 0 2px; }
    </style>

@stop
