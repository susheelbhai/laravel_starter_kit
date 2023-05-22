<!-- Start Testimonial Area -->
    <div class="section testimonial-area ptb-100">
        <div class="container">
            <div class="testimonial-wrap">
                <div class="section-title">
                    <span class="top-title">Testimonial</span>
                    <h2>What Our Client Say About Us</h2>
                </div>

                <div class="testimonial-slide owl-carousel owl-theme">
                    <div class="testimonial-item">
                        <div class="testimonial-img">
                            <img src="{{ asset('storage/themes/tefri') }}/images/client-say/client-say-2.jpg" alt="Image">
                            <i class="ri-double-quotes-r"></i>
                        </div>
                        <p>“Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                            Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin
                            molestie malesuada. Mauris blandit aliquet elit eget”</p>
                        <h3>McDonald Smith </h3>
                        <span>CEO & Founder</span>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-img">
                            <img src="{{ asset('storage/themes/tefri') }}/images/client-say/client-say-3.jpg" alt="Image">
                            <i class="ri-double-quotes-r"></i>
                        </div>
                        <p>“Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                            Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin
                            molestie malesuada. Mauris blandit aliquet elit eget”</p>
                        <h3>Juhon Dew</h3>
                        <span>Founder</span>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-img">
                            <img src="{{ asset('storage/themes/tefri') }}/images/client-say/client-say-4.jpg" alt="Image">
                            <i class="ri-double-quotes-r"></i>
                        </div>
                        <p>“Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                            Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin
                            molestie malesuada. Mauris blandit aliquet elit eget”</p>
                        <h3>Adam smith</h3>
                        <span>CEO & Founder</span>
                    </div>
                </div>

                <img src="{{ asset('storage/themes/tefri') }}/images/client-say/shape-1.jpg" class="shape shape-1" alt="Image">
                <img src="{{ asset('storage/themes/tefri') }}/images/client-say/shape-2.jpg" class="shape shape-2" alt="Image">
                <img src="{{ asset('storage/themes/tefri') }}/images/client-say/shape-3.jpg" class="shape shape-3" alt="Image">
                <img src="{{ asset('storage/themes/tefri') }}/images/client-say/shape-4.jpg" class="shape shape-4" alt="Image">
                <img src="{{ asset('storage/themes/tefri') }}/images/client-say/shape-5.jpg" class="shape shape-5" alt="Image">
            </div>
        </div>
    </div>
    <!-- End Testimonial Area -->


    <!-- Start Doctors Area -->
    <div class="section doctors-area pt-100 bg-color-ffffff pt-100 pb-70">
        <div class="container">
            <div class="section-title wow fadeInUp delay-0-2s">
                <span class="top-title">Our Doctors</span>
                <h2>Meet Our Specialized Doctors</h2>
            </div>

            <div class="row">

                {{-- @foreach ($doctors as $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-doctor wow fadeInUp delay-0-4s">
                            <img src="{{ url('storage/doctor/images/profile/'.$item->profile_pic) }}" alt="Image">
                            <h3>Dr. {{ $item->name }}</h3>
                            <span> @if(isset($item['degree'])) {{ $item['degree']['degree_name'] }} @endif </span>

                            <ul>
                                <li>
                                    <a href="https://facebook.com/" target="_blank">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/" target="_blank">
                                        <i class="ri-twitter-line"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://linkedin.com/" target="_blank">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://instagram.com/" target="_blank">
                                        <i class="ri-instagram-line"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach --}}


            </div>
        </div>
    </div>
    <!-- End Doctors Area -->