<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title> Terms & Conditions | {{ Config::get('settings', 'default')->app_name }}</title>
        <style>
            .navbar {background: black}
        </style>
    </x-slot>

    
    <div class="mb-120 d-block"></div>
    
    <div class="container">
        {!! $data->content !!}
    </div>


    </x-user-layout>
