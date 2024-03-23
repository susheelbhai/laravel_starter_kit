<section class="contact-area" id="contact">
    <div class="custom-container">
        <div class="custom-row">
            <div class="contact-form-wrap">
                <div class="contact-form-body">
                    <h5 class="section-subtitle">Contact</h5>
                    <h1 class="section-title">Lets get in touch</h1>
                    <p>You can reach us anytime via <a href="mailto:mail@digamite.com">mail@digamite.com</a></p>
                    <form action="#" method="POST" class="contact-form">
                        <div class="input-row">
                            <div class="input-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" name="first_name" placeholder="First Name" />
                            </div>
                            <div class="input-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Your Email" />
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                {{-- <select class="number-prefix">
                                    <option value="uk">UK</option>
                                    <option value="us">US</option>
                                </select> --}}
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" name="phone_number" placeholder="Your Number" />
                            </div>
                            <div class="input-group">
                                <label for="country">Country</label>
                                <input type="text" id="homeland" name="country" placeholder="Your Country" />
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" placeholder="Leave us a message...."></textarea>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group input-checkbox">
                                <input type="checkbox" id="privacy_policy_accept">
                                <label for="privacy_policy_accept">You agree to our <a href="#">terms and
                                        conditions.</a></label>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <button id="submit" class="theme-btn">Get Started</button>
                            </div>
                        </div>
                        <!-- Alert Message -->
                        <div class="input-row">
                            <div class="input-group alert-notification">
                                <div id="alert-message" class="alert-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="contact-infos">
                <div class="contact-infos-inner">
                    <div class="contact-info">
                        <img src="{{ asset('themes/guest') }}/assets/imgs/support-icon.svg" alt="Support" />
                        <h3>Contact Info</h3>
                        <p>
                            +91 7979851485 <br>
                            mail@digamite.com
                        </p>
                    </div>
                    <div class="contact-office-info contact-info">
                        <img src="{{ asset('themes/guest') }}/assets/imgs/map-icon.svg" alt="Map" />
                        <h3>Visit our office</h3>
                        <p>
                            C/O KIRAN DEVI, PANCH-PALASI, VILL-PARASI, P. Chakrdaha, <br>
                              Araria- 854318, Bihar
                        </p>
                    </div>

                    <ul class="contact-social-links">
                        <li>
                            <a href="https://www.facebook.com/digamite" target="_blank">
                                <i class="iconoir-facebook"></i>
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/digamitepvtltd" target="_blank">
                                <i class="iconoir-twitter"></i>
                                Twitter
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/digamitepvtltd/" target="_blank">
                                <i class="iconoir-instagram"></i>
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/digamite" target="_blank">
                                <i class="iconoir-linkedin"></i>
                                linkedin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
