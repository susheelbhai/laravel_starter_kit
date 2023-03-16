<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:00:42 GMT -->

<head>

    <link rel="stylesheet" href="{{ url('storage/css/common.css') }}">
    @relativeInclude('head_tag')
    @isset($head)
        {{ $head }}
    @endisset

</head>

<body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-light" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>

    {{ $header }}

    {{ $slot }}


    @relativeInclude('footer')
    @relativeInclude('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <script src="{{ url('storage/js/common.js') }}"></script>


</body>

<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:03:19 GMT -->

</html>
