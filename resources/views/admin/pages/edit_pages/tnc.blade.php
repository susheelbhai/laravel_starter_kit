


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Contact Page Settings | {{ Config::get('settings', 'default')->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Page Manager" />

    @php
        $details = [
            ['name'=> 'content','lbl'=> 'Content', 'type'=>'editor', 'value'=>$data->content, 'placeholder'=> 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14017.914109416573!2d77.34703302383423!3d28.555389930658254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5ccaf6a0617%3A0x59318c70194d0a95!2sCANARA%20BANK%20-%20NOIDA%20SECTOR%2045!5e0!3m2!1sen!2sin!4v1679114987600!5m2!1sen!2sin', 'class'=>'col100' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading=" Terms and Conditions Page" :details="$details" :action="route('admin.pages.updateTncPage')" />

</x-admin.app-layout>
