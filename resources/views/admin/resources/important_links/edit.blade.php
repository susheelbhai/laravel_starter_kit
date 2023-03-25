<x-admin.app-layout>

    @php
        $details = [
            ['name'=> 'name','lbl'=> 'category Name', 'value'=> $data->name, 'class'=>'col50'],
            ['name'=> 'href','lbl'=> 'Href', 'value'=> $data->href, 'class'=>'col50'],
            // ['name'=> 'image','lbl'=> 'Image', 'image'=>true, 'value'=> asset('storage/common/images/important_link/').'/'.$data->image, 'class'=>'logo_input'  ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch', 'value'=> $data->is_active],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Business" :details="$details" :action="route('admin.important_links.update', $data->id)">
        @method('patch')
        <x-slot name="thead">

        </x-slot>
    </x-admin.form.form1>

</x-admin.app-layout>
