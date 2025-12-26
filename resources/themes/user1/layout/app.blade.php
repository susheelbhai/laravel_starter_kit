<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/plugins/fontawesome-5.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/plugins/animate.min.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/plugins/unicons.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/vendor_components/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/css/style.css">
    <style>
        .header-main-one .thumbnail a {
            padding: 24px 0;
        }
    </style>
    {{ $head ?? '' }}
</head>

<body>
    
    @relativeInclude('header')
    {{ $slot }}

        @include('user.layouts.footer')

    <!-- start loader -->
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End loader -->

    <!-- progress Back to top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- progress Back to top End -->


    <!-- scripts start form hear -->
    <script src="{{ asset('themes/guest') }}/js/vendor_components/jquery.min.js"></script>
    <script src="{{ asset('themes/guest') }}/js/vendor_components/jqueryui.js"></script>
    <script src="{{ asset('themes/guest') }}/js/vendor_components/waypoint.js"></script>
    <script src="{{ asset('themes/guest') }}/js/plugins/swiper.js"></script>
    <script src="{{ asset('themes/guest') }}/js/plugins/counterup.js"></script>
    <script src="{{ asset('themes/guest') }}/js/plugins/sal.min.js"></script>
    <script src="{{ asset('themes/guest') }}/js/vendor_components/bootstrap.min.js"></script>

    <script src="{{ asset('themes/guest') }}/js/vendor_components/waw.js"></script>
    <script src="{{ asset('themes/guest') }}/js/plugins/contact.form.js"></script>
    <!-- main Js -->
    <script src="{{ asset('themes/guest') }}/js/main.js"></script>
    <!-- scripts end form hear -->
</body>

</html>

