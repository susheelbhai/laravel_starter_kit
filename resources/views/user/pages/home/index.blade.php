@php
    $page_home = \App\Models\PageHome::whereId(1)->first();
@endphp
<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title>{{ Config::get('settings', 'default')->app_name }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <style>
            .swiper-button-prev,
            .swiper-button-next {
                color: #fff
            }
        </style>
    </x-slot>

    @if ($page_home->slider1 == 1)
        @relativeInclude('_slider1')
    @endif

    @if ($page_home->banner1 == 1)
        @relativeInclude('_banner1')
    @endif

    @if ($page_home->why_us == 1)
        @relativeInclude('_why_us')
    @endif

    @if ($page_home->listings == 1)
        @relativeInclude('_listings')
    @endif

    @if ($page_home->video == 1)
        @relativeInclude('_counter')
    @endif


    @if ($page_home->video == 1)
        @relativeInclude('_video')
    @endif

    @if ($page_home->testimonials == 1)
        @relativeInclude('_testimonials')
    @endif

    @if ($page_home->blogs == 1)
        @relativeInclude('_contact')
    @endif
    @if ($page_home->blogs == 1)
        @relativeInclude('_blogs')
    @endif

</x-user.app-layout>
