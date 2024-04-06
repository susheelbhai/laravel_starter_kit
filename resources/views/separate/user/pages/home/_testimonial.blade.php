<style>
    .thumbnail img{
        border-radius: 12px;
    }
</style>
<div class="rts-client-feedback">
    <div class="container">
        <div class="row">
            <!-- start testimonials area -->
            <div class="col-lg-7">
                <div class="rts-title-area reviews text-start pl--30 pt--70">
                    <p class="pre-title">
                        Our Testimonials
                    </p>
                    <h2 class="title">Client’s Feedbacks</h2>

                    <!-- swiper area start -->
                    <div class="swiper mySwipertestimonial">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $i)
                            <div class="swiper-slide">
                                <div class="testimonial-inner">
                                    <p class="disc text-start">
                                        “ {{ $i['message'] }}”
                                    </p>
                                    <div class="testimonial-bottom-one">
                                        <div class="thumbnail">
                                            <img src="{{ asset($i['image']) }}" alt="business-testimonials">
                                        </div>
                                        <div class="details">
                                            <a href="#">
                                                <h5 class="title"> {{ $i['name'] }} </h5>
                                            </a>
                                            <span>{{ $i['designation'] }}</span> <br>
                                            <span>{{ $i['organisation'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <!-- swiper area end -->
                </div>
            </div>
            <!-- end testimonials are -->
            <!-- images area -->
            <div class="col-lg-5">
                <div class="rts-test-one-image-inner">
                    <img src="{{ asset('themes/guest') }}/images/testimonials/01.png" alt="business_testimobials">
                </div>
            </div>
            <!-- image area end -->
        </div>
    </div>
</div>