


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Contact Page Settings | {{ Config::get('settings', 'default')->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Page Manager" />

    @php
        $details = [
            ['name'=> 'banner','lbl'=> 'Change Banner', 'image'=>true, 'value'=>asset('storage/images/webpages/banners/' . $data->banner), 'class'=>'banner_img_input' ],
            ['name'=> 'working_hour','lbl'=> 'Working Hours', 'value'=>$data->working_hour, 'placeholder'=> 'We are open from 9am — 5pm business days.', 'class'=>'col50' ],
            ['name'=> 'form_heading1','lbl'=> 'Contact Form Heading 1', 'value'=>$data->form_heading1, 'placeholder'=> 'Lets talk about all things!', 'class'=>'col50' ],
            ['name'=> 'form_paragraph1','lbl'=> 'Contact Form Paragraph 1', 'type'=>'textarea', 'value'=>$data->form_paragraph1, 'placeholder'=> 'Write to us or give us a call. We will reply to you as soon as possible. But yes, it can take up to 24 hours.', 'class'=>'col50' ],
            ['name'=> 'map_embad_url','lbl'=> 'Map Embad Url', 'type'=>'textarea', 'value'=>$data->map_embad_url, 'placeholder'=> 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14017.914109416573!2d77.34703302383423!3d28.555389930658254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5ccaf6a0617%3A0x59318c70194d0a95!2sCANARA%20BANK%20-%20NOIDA%20SECTOR%2045!5e0!3m2!1sen!2sin!4v1679114987600!5m2!1sen!2sin', 'class'=>'col50' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading=" About Page" :details="$details" :action="route('admin.pages.updateContactPage')" />

</x-admin.app-layout>
