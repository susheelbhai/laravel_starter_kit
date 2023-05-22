<div class="col-12 col-lg-7">
    <div class="contact-form">
        @php
            $details = [['name' => 'name', 'lbl' => 'Full Name', 'class' => 'col-12'], ['name' => 'email', 'lbl' => 'Email Address', 'class' => 'col-6'], ['name' => 'phone', 'lbl' => 'Phone Number', 'class' => 'col-6'], ['name' => 'subject', 'lbl' => 'Topic', 'class' => 'col-12'], ['name' => 'message', 'lbl' => 'Message', 'type' => 'textarea', 'class' => 'col-12']];
        @endphp
        <x-user.form.form1 method="post" heading="Add Category" :details="$details" :action="''" />

    </div>
</div>
