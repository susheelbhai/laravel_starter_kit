<x-admin.app-layout>
    <x-slot name="head">
        <title> Edit Testimonial | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    @php
        $details = [
            ['name'=> 'name','lbl'=> 'Name', 'class'=>'col50', 'value'=> $data->name],
            ['name'=> 'designation','lbl'=> 'Designation', 'class'=>'col50', 'value'=> $data->designation],
            ['name'=> 'organisation','lbl'=> 'Organisation', 'class'=>'col50', 'value'=> $data->organisation],
            ['name'=> 'message','lbl'=> 'Message', 'class'=>'col50', 'value'=> $data->message],
            ['name'=> 'image','lbl'=> 'Image', 'image'=>true, 'class'=>'profile_pic_input', 'value'=> asset('storage/common/images/testimonials/').'/'.$data->image ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch', 'value'=> $data->is_active ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Testimonial" :details="$details" :action="route('admin.testimonial.update', $data->id)">
        @method('patch')
        <x-slot name="thead">

        </x-slot>
    </x-admin.form.form1>

</x-admin.app-layout>
