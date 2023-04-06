<x-admin.app-layout>
    <x-slot name="head">
        <title> View Partner  | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    @php
        $details = [
            [
                // 'name'=> 'Company Details',
                'data'=> [
                    ['name'=>' Name', 'value'=> $data->name],
                    ['name'=>'Email', 'value'=> $data->email],
                    ['name'=>'Phone', 'value'=> $data->phone],
                    ['name'=> 'Profile Picture','lbl'=> 'Image', 'image'=>true, 'value'=> asset('storage/images/partner/profile/').'/'.$data->profile_pic ],
                    ['name'=>'Status', 'value'=> ($data->is_active) ? 'Active' : 'Not Active'],
                ]
            ],
        ];
    @endphp
    <x-admin.detail-page.page1 heading="View partner Detail" :details="$details" :editUrl="route('admin.partner.store')">

        <x-slot name="footer">
            <tr>
                <td class="text-center"> <a class="btn btn-primary" href="{{ route('admin.partner.edit', $data->partner_id) }}">Edit</a> </td>
                
            </tr>
        </x-slot>
    </x-admin.detail-page.page1>


</x-admin.app-layout>