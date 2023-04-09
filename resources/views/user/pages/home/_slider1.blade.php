<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($slider1 as $i)
            <div class="swiper-slide">
                <div class="welcome-area bg-gradient">
                    <!-- Background Shape -->
                    <div class="background-shape">
                        <div class="circle1 wow fadeInRightBig" data-wow-duration="4000ms"></div>
                        <div class="circle2 wow fadeInRightBig" data-wow-duration="4000ms"></div>
                        <div class="circle3 wow fadeInRightBig" data-wow-duration="4000ms"></div>
                        <div class="circle4 wow fadeInRightBig" data-wow-duration="4000ms"></div>
                    </div>
                    <!-- Background Animation -->
                    <div class="background-animation">
                        <div class="item1"></div>
                        <div class="item2"></div>
                        <div class="item3"></div>
                        <div class="item4"></div>
                        <div class="item5"></div>
                    </div>
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-between">
                            <!-- Welcome Content -->
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="welcome-content">
                                    <ul class="mb-0 ps-1 d-flex align-items-center wow fadeInUp"
                                        data-wow-duration="1s" data-wow-delay="200ms">
                                        <li>{{ $i->heading1 }}</li>
                                        {{-- <li>Vanilla JS</li>
                                  <li>v2.0.0</li> --}}
                                    </ul>
                                    <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="300ms">
                                        {{ $i->heading2 }} </h2>
                                    <p class="mb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="400ms">
                                        {{ $i->paragraph1 }} </p>
                                    <div class="hero-btn-group wow fadeInUp" data-wow-duration="1s"
                                        data-wow-delay="500ms">
                                        <a class="btn btn-warning mt-3 me-3" href="{{ $i->btn_url }}"
                                            target="{{ $i->btn_target }}">{{ $i->btn_name }}</a>
                                        {{-- <a class="btn btn-light btn-minimal mt-3" href="#"
                                            target="_blank">Reviews (4.9/5.0)</a> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Welcome Thumb -->
                            <div class="col-12 col-sm-8 col-md-6">
                                <div class="welcome-thumb ms-lg-5 wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="1s"><img
                                        src="{{ asset('storage/images/webpages/banners/' . $i->image1) }}"
                                        alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
    <!-- If we need pagination -->
    {{-- <div class="swiper-pagination"></div> --}}

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    {{-- <div class="swiper-scrollbar"></div> --}}
</div>



<script>
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        // direction: 'vertical',
        loop: true,

        // If we need pagination
        // pagination: {
        //     el: '.swiper-pagination',
        // },
        slidesPerView: 1,
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        // scrollbar: {
        //     el: '.swiper-scrollbar',
        // },
    });
</script>