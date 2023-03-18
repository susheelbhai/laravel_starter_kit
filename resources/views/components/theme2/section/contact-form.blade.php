<div class="col-12 col-lg-7">
    <div class="contact-form">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label class="form-label" for="name">Full Name:</label>
                    <input class="form-control mb-30" id="name" type="text"
                        placeholder="Designing World" value="" name="name" required>
                </div>
                <div class="col-12 col-lg-6">
                    <label class="form-label" for="email">Email Address:</label>
                    <input class="form-control mb-30" id="email" type="email"
                        placeholder="care.designingworld@gmail.com" name="email" value=""
                        required>
                </div>
                <div class="col-12 col-lg-6">
                    <label class="form-label" for="phone">Phone Number:</label>
                    <input class="form-control mb-30" id="phone" type="text"
                        placeholder="care.designingworld@gmail.com" name="phone" value=""
                        required>
                </div>
                <div class="col-12">
                    <label class="form-label" for="subject">Topics:</label>
                    <input class="form-control mb-30" id="subject" type="text"
                        placeholder="Presale Questions" name="subject" value="">
                </div>
                <div class="col-12">
                    <label class="form-label" for="message">Message:</label>
                    <textarea class="form-control mb-30" id="description" name="description" placeholder="Message"></textarea>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary w-100" type="submit">Send Now</button>
                </div>
            </div>
        </form>
    </div>
</div>