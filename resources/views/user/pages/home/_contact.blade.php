<!-- Start Contact Area -->
    <div id="contact" class="section contact-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="top-title">Contact Us</span>
                <h2>Get in Touch</h2>
            </div>

            <div class="contact-form">
                <form id="contactForm">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                    data-error="Please enter your name" placeholder="Evan Edwards">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    data-error="Please enter your email" placeholder="tefri@gmail.com">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_number" id="phone_number" required
                                    data-error="Please enter your number" class="form-control"
                                    placeholder="+1(135) 1984 2020">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="msg_subject" id="msg_subject" class="form-control"
                                    required data-error="Please enter your subject" placeholder="Message subject ">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Your Message</label>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="6" required
                                    data-error="Write your message" placeholder="Write your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="gridCheck" value="I agree to the terms and privacy policy."
                                            class="form-check-input" type="checkbox" id="gridCheck" required>

                                        <label class="form-check-label" for="gridCheck">
                                            I agree to the <a href="terms-conditions.html">terms</a> and <a
                                                href="privacy-policy.html">privacy policy</a>
                                        </label>
                                        <div class="help-block with-errors gridCheck-error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 text-center">
                            <button type="submit" class="default-btn">
                                Send Message
                            </button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->