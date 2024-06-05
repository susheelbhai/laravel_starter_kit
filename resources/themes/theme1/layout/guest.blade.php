<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	
	<title> Authenticate {{ config('app.name') }} </title>
    <link href="{{ asset('themes/theme1')}}/css/style.css" rel="stylesheet">
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    {{ $head ?? '' }}
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            {{$slot}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('themes/theme1')}}/vendor/global/global.min.js"></script>
    <script src="{{ asset('themes/theme1')}}/js/custom.min.js"></script>
    <script src="{{ asset('themes/theme1')}}/js/dlabnav-init.js"></script>
	<script src="{{ asset('themes/theme1')}}/js/styleSwitcher.js"></script>
</body>
</html>