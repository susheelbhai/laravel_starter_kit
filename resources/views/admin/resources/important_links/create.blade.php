<x-admin.app-layout>

    @php
        $details = [
            ['name'=> 'name','lbl'=> 'Name', ],
            ['name'=> 'href','lbl'=> 'Href', ],
            ['name'=> 'image','lbl'=> 'Image', 'image'=>true, ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Important Link" :details="$details" :action="route('admin.important_links.store')" />

</x-admin.app-layout>
