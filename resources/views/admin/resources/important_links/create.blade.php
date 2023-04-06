<x-admin.app-layout>
    <x-slot name="head">
        <title> Add Important Link  | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    @php
        $details = [
            ['name'=> 'name','lbl'=> 'Name', 'class'=>'col50' ],
            ['name'=> 'href','lbl'=> 'Href', 'class'=>'col50' ],
            // ['name'=> 'image','lbl'=> 'Image', 'image'=>true, 'class'=>'logo_input' ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Important Link" :details="$details" :action="route('admin.important_links.store')" />

</x-admin.app-layout>
