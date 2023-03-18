


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Advanced Settings | {{ $settings->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Setting" />

    @php
        $details = [
            ['name'=> 'short_description','lbl'=> 'Short Description', 'type'=>'textarea', 'value'=>$settings->short_description ],
            ['name'=> 'address','lbl'=> 'Address', 'type'=>'textarea', 'value'=>$settings->address ],
            ['name'=> 'phone','lbl'=> 'phone', 'type'=>'text', 'value'=>$settings->phone ],
            ['name'=> 'email','lbl'=> 'email', 'type'=>'email', 'value'=>$settings->email ],
            ['name'=> 'facebook','lbl'=> 'facebook', 'value'=>$settings->facebook ],
            ['name'=> 'twitter','lbl'=> 'twitter', 'value'=>$settings->twitter ],
            ['name'=> 'linkedin','lbl'=> 'linkedin', 'value'=>$settings->linkedin ],
            ['name'=> 'instagram','lbl'=> 'instagram', 'value'=>$settings->instagram ],
            ['name'=> 'youtube','lbl'=> 'youtube', 'value'=>$settings->youtube ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Advanced Setting" :details="$details" :action="route('admin.settings.advanced')" />

</x-admin.app-layout>
