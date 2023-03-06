<x-partner-layout>

    @php
        $details = [
            [
                'name'=> 'Company Details',
                'data'=> [
                    ['name'=>'Category', 'value'=> $data['category']->name ?? ''],
                    ['name'=>'Sub Category', 'value'=> $data['subCategory']->name ?? ''],
                    ['name'=>'Business Name', 'value'=> $data->business_name],
                    ['name'=>'Registration Number', 'value'=> $data->registration_number],
                    ['name'=>'Gst Number', 'value'=> $data->gst_number],
                    ['name'=>'Logo', 'value'=> url('storage/business/images',$data->logo), 'image'=>true],
                    ['name'=>'Display Image', 'value'=> url('storage/business/images',$data->display_img), 'image'=>true],
                    ['name'=>'Short Description', 'value'=> $data->short_description],
                    ['name'=>'Long Description', 'value'=> $data->long_description],
                ]
            ], 
            [
                'name'=> 'Company Address',
                'data'=> [
                    ['name'=> 'Address', 'value'=> $data->business_address],
                    ['name'=> 'City', 'value'=> $data->business_city],
                    ['name'=> 'Pin', 'value'=> $data->business_pin],
                    ['name'=> 'State', 'value'=> $data->business_state],
                ]
            ], 
            [
                'name'=> 'Contact Person',
                'data'=> [
                    ['name'=> 'Contact Person Name', 'value'=> $data->contact_person_name],
                    ['name'=> 'Contact Person Email', 'value'=> $data->contact_person_email],
                    ['name'=> 'Contact Person Phone', 'value'=> $data->contact_person_phone],
                    ['name'=> 'Contact Person Alternate Phone', 'value'=> $data->contact_person_alt_phone],
                ]
            ], 
        ];
    @endphp
    <x-partner.detail-page.page1 heading="View Business Detail" :details="$details" :editUrl="route('partner.business.store')">

        <x-slot name="footer">
            <tr>
                <td class="text-center"> <a class="btn btn-primary" href="{{ route('partner.business.edit', $data->id) }}">Edit</a> </td>
                <td class="text-center">
                    @if($data->is_approved==1) 
                    @if($data->is_active==0) 
                    <form action="{{ route('partner.business.activate') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <button class="btn btn-primary" type="submit">Activate Now</button>
                    </form>
                    @else
                    <form action="{{ route('partner.business.deactivate') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <button class="btn btn-primary" type="submit">Deactivate Now</button>
                    </form>
                    @endif
                    @else
                    <button class="btn btn-danger"> Not Approved </button> 

                    @endif

                    
                    
                </td>
            </tr>
        </x-slot>
    </x-partner.detail-page.page1>

</x-partner-layout>
