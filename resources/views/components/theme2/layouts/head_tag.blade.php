<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<style>
    :root {
        --color1: {{ Config::get('settings')['color1'] }};
        --color2: {{ Config::get('settings')['color2'] }};
        --color3: {{ Config::get('settings')['color3'] }};
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon"
    href="{{ asset('storage/images/webpages/logo/' . Config::get('settings')['favicon']) }}">
<!-- All CSS Stylesheet-->
<link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/css/all-css-libraries.css">
<!-- Core Stylesheet-->
<link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/style.css">