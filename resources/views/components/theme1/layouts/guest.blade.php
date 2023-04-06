
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" href="{{ url('storage/css/common.css') }}">
            @relativeInclude('head_tag')
        @if (isset($head))
            {{ $head }}
        @endif

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                {{$slot}}
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        
            @relativeInclude('js')
    <script src="{{ url('storage/js/common.js') }}">  </script>
    </body>
</html>

