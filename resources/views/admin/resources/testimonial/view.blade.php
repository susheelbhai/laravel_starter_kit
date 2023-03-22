<x-admin.app-layout>
    <x-slot name="head">
        <title> View Testimonial | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    @php
        $details = [
            [
                // 'name'=> 'Company Details',
                'data'=> [
                    ['name'=>' Name', 'value'=> $data->name],
                    ['name'=>'Designation', 'value'=> $data->designation],
                    ['name'=>'Organisation', 'value'=> $data->organisation],
                    ['name'=>'Message', 'value'=> $data->message],
                    ['name'=> 'Image','lbl'=> 'Image', 'image'=>true, 'value'=> asset('storage/common/images/testimonials/').'/'.$data->image ],
                    ['name'=>'Status', 'value'=> ($data->is_active) ? 'Active' : 'Not Active'],
                ]
            ],
        ];
    @endphp
    <x-admin.detail-page.page1 heading="View Testimonial Detail" :details="$details" :editUrl="route('admin.testimonial.store')">

        <x-slot name="footer">
            <tr>
                <td class="text-center"> <a class="btn btn-primary" href="{{ route('admin.testimonial.edit', $data->id) }}">Edit</a> </td>
                
            </tr>
        </x-slot>
    </x-admin.detail-page.page1>

</x-admin-layout>
