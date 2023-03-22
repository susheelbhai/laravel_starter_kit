<div class="client-feedback-area bg-gray pt-120 pb-120">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-9 col-md-8 col-lg-7">
        <div class="section-heading text-center">
          <h6>Testimonials</h6>
          <h2>Read some reviews from our beloved clients about our work.</h2>
          <p>It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="client-feedback-content">
      <div class="client-feedback-slides">
        <!-- Single Feedback Slide -->
        @foreach ($testimonials as $i)
        <div>
          <div class="card feedback-card border-0 p-2 shadow-sm">
            <div class="card-body p-5 p-sm-4 p-md-5">
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb rounded-circle me-2 position-relative"><img class="rounded-circle" src="{{ asset('storage/common/images/testimonials/').'/'.$i->image }}" alt=""><span class="rounded-circle"><i class="bi bi-check"></i></span></div>
                <div class="client-name">
                  <h6 class="fz-14 mb-0">{{ $i->name }}</h6>
                  <p class="mb-0 fz-12">{{ $i->designation }}</p>
                </div>
              </div>
              <p class="text-dark mb-0 fw-bold">{{ $i->message }}</p>
            </div>
          </div>
        </div>
        @endforeach
        
        
      </div>
    </div>
  </div>
</div>