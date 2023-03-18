<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title> Contact Us {{ Config::get('settings', 'default')->app_name }}</title>
    </x-slot>

    
    @php
        $banner_data = [
            'img_url'=> asset('storage/images/webpages/banners/' . $data->banner),
            'heading' => 'Contact US',
            'breadcrumb' => [
                'lavel1'=>['name'=>'Home', 'url'=>route('home')],
                'lavel2'=>['name'=>'Contact Us'],
            ],
        ]
    @endphp
    <x-user.section.banner-breadcrumb :data="$banner_data">
        
    </x-user.section.banner-breadcrumb>
    <div class="mb-120 d-block"></div>
    <!-- Contact Area-->
    <x-user.section.contact.wrapper>
        <x-user.section.contact-info :data="$data" />
        <x-user.section.contact-form />
    </x-user.section.contact-wrapper>

    
    <div class="mb-120 d-block"></div>
    <!-- Google Maps-->
    <div class="google-maps-wrapper">
        <iframe
            src="{{$data->map_embad_url}}"
            allowfullscreen=""></iframe>
    </div>


    </x-user-layout>
