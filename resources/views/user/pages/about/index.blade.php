<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title>About Us {{ Config::get('settings', 'default')->app_name; }}</title>
    </x-slot>

    @php
        $banner_data = [
            'img_url'=> asset('storage/images/webpages/banners/' . $data->banner),
            'heading' => 'About US',
            'breadcrumb' => [
                'lavel1'=>['name'=>'Home', 'url'=>route('home')],
                'lavel2'=>['name'=>'About Us'],
            ],
        ]
    @endphp
    
    <x-user.section.banner-breadcrumb :data="$banner_data" />
    
      <div class="mb-120 d-block"></div>
      
      

    @include('user.pages.about._about-us')
    @include('user.pages.about._vision')
    @include('user.pages.about._counterup')
    {{-- @include('user.pages.about._team') --}}
    @include('user.pages.about._testimonials')
    @include('user.pages.about._partners')

    <x-slot name="custom_js">
        <script>
            $(window).on('scroll load', function() {
                $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
            });

        </script>
        <script>
            $('.style1').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: false,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 1
                    },
                    400: {
                        items: 1,
                        margin: 20
                    },
                    500: {
                        items: 1,
                        margin: 20
                    },
                    768: {
                        items: 2,
                        margin: 20
                    },
                    991: {
                        items: 2,
                        margin: 20
                    },
                    1000: {
                        items: 3,
                        margin: 20
                    }
                }
            });

        </script>
        <script>
            $('.style2').owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                autoWidth: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2,
                        margin: 20
                    },
                    400: {
                        items: 2,
                        margin: 20
                    },
                    500: {
                        items: 3,
                        margin: 20
                    },
                    768: {
                        items: 4,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 20
                    },
                    1000: {
                        items: 6,
                        margin: 20
                    }
                }
            });

        </script>

        <script src="http://localhost/slist/storage/theme/theme2/js/inner.js"></script>
    </x-slot>
</x-user.app-layout>


