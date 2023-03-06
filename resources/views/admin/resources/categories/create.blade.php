<x-admin-layout>

    @php
        $details = [
            ['name'=> 'name','lbl'=> 'category Name', ],
            ['name'=> 'icon','lbl'=> 'Icon', ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Category" :details="$details" :action="route('admin.subCategory.store')" />

</x-admin-layout>
