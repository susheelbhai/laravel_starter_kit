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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon"
    href="{{ asset('storage/images/webpages/logo/' . Config::get('settings')['favicon']) }}">
<!-- All CSS Stylesheet-->
<link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/css/all-css-libraries.css">
<!-- Core Stylesheet-->
<link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />