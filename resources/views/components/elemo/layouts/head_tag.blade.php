<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<style>
    :root {
        --color1: {{ Config::get('settings')['color1'] }};
        --color2: {{ Config::get('settings')['color2'] }};
        --color3: {{ Config::get('settings')['color3'] }};
    }

    .logout_btn {
        border: none;
        background: none;
        margin-left: 24px;
        color: red
    }
</style>
<!--Bootstrap -->
<link rel="stylesheet" href="{{ asset('storage/themes/elemo/css/bootstrap.min.css')}}" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="{{ asset('storage/themes/elemo/css/style.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('storage/themes/elemo/css/custom.css')}}" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="{{ asset('storage/themes/elemo/css/owl.carousel.css')}}" type="text/css">
<!--FontAwesome Font Style -->
<link href="assets/css/fontawesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
<link rel="stylesheet" id="switcher-css" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/switcher.css')}}" media="all" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/blue.css')}}" title="blue" media="all"
    data-default-color="true" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/pink.css')}}" title="pink" media="all" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/orange.css')}}" title="orange" media="all" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/green.css')}}" title="green" media="all" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/red.css')}}" title="red" media="all" />
<link rel="alternate stylesheet" type="text/css" href="{{ asset('storage/themes/elemo/switcher/css/purple.css')}}" title="purple" media="all" />
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
