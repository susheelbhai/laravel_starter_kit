    <!-- contact area start -->
    <div class="rts-contact-area contact-one">
        <div class="container">
            <div class="row align-items-center g-0">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="contact-image-one">
                        <img src="{{ asset('themes/guest') }}/images/contact/01.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="contact-form-area-one">
                        <div class="rts-title-area contact text-start">
                            <p class="pre-title">
                                Make An Appointment
                            </p>
                            <h2 class="title">Request a free quote</h2>
                        </div>
                        <div id="form-messages"></div>
                        <form id="contact-form" action="{{ route('contact') }}" method="post">
                            @csrf
                            <div class="name-email">
                                <input type="text" placeholder="Your Name" name="name" required>
                                <input type="tel" placeholder="Phone Number" name="phone" required>
                            </div>
                            <input type="email" placeholder="Email Address" name="email" required>
                            <input type="text" placeholder="Business Topic" name="subject">
                            <textarea placeholder="Type Your Message" name="message"></textarea>
                            <button type="submit" class="rts-btn btn-primary">Submit Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->

    <!-- map area start -->
    <div class="rts-map-area bg-light-white">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- map area left -->
                    <div class="mapdetails-inner-one">
                        <div class="left-area single-wized">
                            <h5 class="title">Get in touch</h5>
                            <div class="details">
                                <p>Work and general inquiries</p>
                                <a class="number" href="tel:{{ config('app.phone') }}">{{ config('app.phone') }}</a>

                                <p class="time-header">
                                    Assistance hours:
                                </p>
                                <p class="time">
                                    Monday – Friday <br> 6 am to 8 pm IST
                                </p>
                            </div>
                        </div>
                        <div class="right-area single-wized">
                            <h5 class="title">Post Address</h5>
                            <div class="details">
                                
                                <p class="headoffice">
                                    Head Office
                                </p>
                                <p class="office">
                                    {{ config('app.address') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- map area right -->
                </div>
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.542191691623!2d77.31922!3d28.583506999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce459b9eee365%3A0x1c9895c253164bec!2sD%2C%209%2C%20Vyapar%20Marg%2C%20Block%20D%2C%20Sector%203%2C%20Noida%2C%20Uttar%20Pradesh%20201301!5e0!3m2!1sen!2sin!4v1705310436314!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>
    <!-- map area end -->