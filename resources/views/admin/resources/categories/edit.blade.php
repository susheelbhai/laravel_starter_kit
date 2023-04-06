<x-admin-layout>
    <x-slot name="head">
        <title> Edit Category  | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    @php
        $details = [
            ['name'=> 'name','lbl'=> 'category Name', 'value'=> $data->name],
            ['name'=> 'icon','lbl'=> 'Icon', 'value'=> $data->icon],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'value'=> $data->is_active],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Business" :details="$details" :action="route('admin.category.update', $data->id)">
        @method('patch')
        <x-slot name="thead">

        </x-slot>
    </x-admin.form.form1>

</x-admin-layout>
