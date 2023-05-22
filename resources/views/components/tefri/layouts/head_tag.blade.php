<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<style>
    :root {
        --color1: {{ Config::get('settings')['color1'] }};
        --color2: {{ Config::get('settings')['color2'] }};
        --color3: {{ Config::get('settings')['color3'] }};
    }

    .logout_btn{
        border: none;
    background: none;
    margin-left: 24px;
    color: red
    }
</style>

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon"
    href="{{ asset('storage/images/webpages/logo/' . Config::get('settings')['favicon']) }}">


<!-- Links Of CSS File -->
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/owl.carousel.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/flaticon.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/remixicon.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/meanmenu.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/animate.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/magnific-popup.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/odometer.min.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/style.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/dark-mode.css">
		<link rel="stylesheet" href="{{ asset('storage/themes/tefri') }}/css/responsive.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />