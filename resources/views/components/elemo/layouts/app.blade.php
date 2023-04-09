<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from themes.webmasterdriver.net/Elemo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Apr 2023 15:39:36 GMT -->

<head>

    <link rel="stylesheet" href="{{ url('storage/css/common.css') }}">
    @relativeInclude('head_tag')
    @isset($head)
        {{ $head }}
    @endisset
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    
    {{ $header }}


    {{ $slot }}


    @relativeInclude('footer')
    @relativeInclude('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="{{ url('storage/js/common.js') }}"></script>
</body>

<!-- Mirrored from themes.webmasterdriver.net/Elemo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Apr 2023 15:39:40 GMT -->

</html>
