


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> About Page Settings | {{ Config::get('settings', 'default')->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Setting" />

    @php
        $details = [
            ['name'=> 'banner','lbl'=> 'Banner', 'image'=>true, 'value'=>$data->banner ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading=" About Page" :details="$details" :action="route('admin.pages.updateAboutPage')" />

</x-admin.app-layout>
