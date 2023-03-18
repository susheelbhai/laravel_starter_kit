


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Advanced Settings | {{ $settings->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Setting" />

    @php
        $details = [
            ['name'=> 'short_description','lbl'=> 'Short Description', 'type'=>'textarea', 'value'=>$settings->short_description, 'class'=>'col50' ],
            ['name'=> 'address','lbl'=> 'Address', 'type'=>'textarea', 'value'=>$settings->address, 'class'=>'col50' ],
            ['name'=> 'phone','lbl'=> 'phone', 'type'=>'text', 'value'=>$settings->phone, 'class'=>'col50' ],
            ['name'=> 'email','lbl'=> 'email', 'type'=>'email', 'value'=>$settings->email, 'class'=>'col50' ],
            ['name'=> 'facebook','lbl'=> 'facebook', 'value'=>$settings->facebook, 'class'=>'col50' ],
            ['name'=> 'twitter','lbl'=> 'twitter', 'value'=>$settings->twitter, 'class'=>'col50' ],
            ['name'=> 'linkedin','lbl'=> 'linkedin', 'value'=>$settings->linkedin, 'class'=>'col50' ],
            ['name'=> 'instagram','lbl'=> 'instagram', 'value'=>$settings->instagram, 'class'=>'col50' ],
            ['name'=> 'youtube','lbl'=> 'youtube', 'value'=>$settings->youtube, 'class'=>'col50' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Advanced Setting" :details="$details" :action="route('admin.settings.advanced')" />

</x-admin.app-layout>
