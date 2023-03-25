<x-admin.app-layout>

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
