<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	
    <link href="{{ asset('themes/theme1') }}/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{ asset('themes/theme1') }}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
	<link href="{{ asset('assets/css/input_switch.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/input_image.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/theme1') }}/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="{{ asset('themes/theme1') }}/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="{{ asset('themes/theme1') }}/vendor/nouislider/nouislider.min.css" rel="stylesheet">
    <link href="{{ asset('themes/theme1') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('themes/theme1') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="{{ asset('themes/theme1') }}/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{ asset('themes/theme1') }}/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
	
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('themes/theme1') }}/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('themes/theme1') }}/vendor/pickadate/themes/default.date.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <style>
        .header-right{
            display: flex;
            align-items: center;
        }
    </style>
	{{ $head }}
</head>
<body>

    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>

    <div id="main-wrapper">
        {{ $header_logo ?? ''}}

        @relativeInclude('header')
        @relativeInclude('sidebar')
        
        <div class="content-body">
            @relativeInclude('header.alert')
            <div class="container">
                {{ $slot }}
            </div>
        </div>
        @relativeInclude('footer')
        

	</div>
    @livewireScripts
    
    @relativeInclude('js')

    @if (config('app.watermark') == 1)
    <script>
        var textWatermark = 'Testing';
        var body = document.getElementsByTagName('body')[0];
        var header = document.getElementsByClassName('header')[0];
        var dlabnav = document.getElementsByClassName('dlabnav')[0];
        var navHeader = document.getElementsByClassName('nav-header')[0];
        var background = "url(\"data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='48px' width='80px' >" +
            "<text transform='translate(20, 48) rotate(-30)' fill='rgba(255,128,128, 0.2)' font-size='20' >" + textWatermark + "</text></svg>\")";
        body.style.backgroundImage = background
        header.style.backgroundImage = background
        dlabnav.style.backgroundImage = background
        navHeader.style.backgroundImage = background
    </script>
    @endif
	

</body>
</html>