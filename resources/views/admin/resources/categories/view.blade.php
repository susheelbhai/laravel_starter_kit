<x-admin-layout>

    @php
        $details = [
            [
                // 'name'=> 'Company Details',
                'data'=> [
                    ['name'=>'Category Name', 'value'=> $data->name],
                    ['name'=>'Icon', 'value'=> $data->icon],
                    ['name'=>'status', 'value'=> $data->is_active],
                ]
            ],
        ];
    @endphp
    <x-admin.detail-page.page1 heading="View Business Detail" :details="$details" :editUrl="route('admin.category.store')">

        <x-slot name="footer">
            <tr>
                <td class="text-center"> <a class="btn btn-primary" href="{{ route('admin.category.edit', $data->id) }}">Edit</a> </td>
                
            </tr>
        </x-slot>
    </x-admin.detail-page.page1>

</x-admin-layout>
