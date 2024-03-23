<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ========== Start Fonts Style ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600&amp;family=Syne:wght@400;500;600&amp;family=Yantramanav:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    
    <!-- ========== Start Stylesheet ========== -->
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/iconoir.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('themes/guest') }}/assets/css/responsive.css">
    <!-- ========== End Stylesheet ========== -->
	{{ $head }}

</head>

<body>

    <main class="main-page homepage">
        @include('user.layouts.top_header')
        @relativeInclude('header')
        {{ $slot }}
        @include('user.layouts.footer')
    </main>

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('themes/guest') }}/assets/js/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/gsap.min.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/Draggable.min.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/client-marquee.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/theme-custom.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/form1.js"></script>
    <script src="{{ asset('themes/guest') }}/assets/js/subscribe-form.js"></script>
</body>


</html>