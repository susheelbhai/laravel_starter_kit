<div class="col-12 col-lg-5 col-xl-4">
    <div class="contact-side-info mb-4 mb-md-0">
        <h1 class="mb-3"> {!! $contact_data->form_heading1 !!} </h1>
        <p class="mb-4"> {!! $contact_data->form_paragraph1 !!} </p>
        <div class="contact-mini-card-wrapper">
            <!-- Contact Mini Card-->
            <div class="contact-mini-card">
                <div class="contact-mini-card-icon"><i class="bi bi-envelope"></i></div>
                <p>{!! Config::get('settings', 'default')->email; !!}</p>
            </div>
            <!-- Contact Mini Card-->
            <div class="contact-mini-card">
                <div class="contact-mini-card-icon"><i class="bi bi-headphones"></i></div>
                <p>{!! Config::get('settings', 'default')->phone; !!}</p>
            </div>
            <!-- Contact Mini Card-->
            <div class="contact-mini-card">
                <div class="contact-mini-card-icon"><i class="bi bi-tag"></i></div>
                <p> {!! $contact_data->working_hour !!} </p>
            </div>
        </div>
    </div>
</div>