<x-admin.app-layout>

    @php
        $details = [
            [
                // 'name'=> 'Company Details',
                'data'=> [
                    ['name'=>'Category Name', 'value'=> $data->name],
                    ['name'=>'href', 'value'=> $data->href],
                    ['name'=> 'image','lbl'=> 'Image', 'image'=>true, 'value'=> asset('storage/common/images/important_link/').'/'.$data->image ],
                    ['name'=>'status', 'value'=> ($data->is_active) ? 'Active' : 'Not Active'],
                ]
            ],
        ];
    @endphp
    <x-admin.detail-page.page1 heading="View Business Detail" :details="$details" :editUrl="route('admin.important_links.store')">

        <x-slot name="footer">
            <tr>
                <td class="text-center"> <a class="btn btn-primary" href="{{ route('admin.important_links.edit', $data->id) }}">Edit</a> </td>
                
            </tr>
        </x-slot>
    </x-admin.detail-page.page1>

</x-admin-layout>
