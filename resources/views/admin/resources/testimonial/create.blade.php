<x-admin.app-layout>
    <x-slot name="head">
        <title> Add Testimonial | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    @php
        $details = [
            ['name'=> 'name','lbl'=> 'Name', 'class'=>'col50'],
            ['name'=> 'designation','lbl'=> 'Designation', 'class'=>'col50'],
            ['name'=> 'organisation','lbl'=> 'Organisation', 'class'=>'col50'],
            ['name'=> 'message','lbl'=> 'Message', 'class'=>'col50'],
            ['name'=> 'image','lbl'=> 'Image', 'image'=>true, 'class'=>'profile_pic_input' ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Testimonial" :details="$details" :action="route('admin.testimonial.store')" />

</x-admin.app-layout>
