<x-partner-layout>

    @php
        $details = [
            [
                'id'=>'01',
                'name'=> 'Company Details',
                'form'=> [
                    ['name'=> 'business_name', 'lbl'=>'Business Name', 'value'=> $data->business_name],
                    ['name'=> 'registration_number', 'lbl'=>'Registration Number', 'value'=> $data->registration_number],
                    ['name'=> 'gst_number', 'lbl'=>'Gst Number', 'value'=> $data->gst_number],
                    ['name'=> 'website', 'lbl'=>'Website', 'type'=>'url'],
                    ['name'=> 'logo', 'lbl'=>'Logo', 'value'=> url('storage/business/images', $data->logo), 'image'=>true],
                    ['name'=> 'display_img', 'lbl'=>'Display Image', 'value'=> url('storage/business/images', $data->display_img), 'image'=>true],
                    ['name'=> 'map_src', 'lbl'=>'Map Embad src', 'value'=> $data->map_src, 'type'=>'textarea'],
                    ['name'=> 'short_description', 'lbl'=>'Short Description', 'value'=> $data->short_description, 'type'=>'textarea'],
                    ['name'=> 'long_description', 'lbl'=>'Long Description', 'value'=> $data->long_description, 'type'=>'textarea'],
                ]
            ], 
            [
                'id'=>'02',
                'name'=> 'Company Address',
                'form'=> [
                    ['name'=> 'address', 'lbl'=>'Address', 'value'=> $data->business_address],
                    ['name'=> 'city', 'lbl'=>'City', 'value'=> $data->business_city],
                    ['name'=> 'pin', 'lbl'=>'Pin', 'value'=> $data->business_pin],
                    ['name'=> 'state', 'lbl'=>'State', 'value'=> $data->business_state],
                ]
            ], 
            [
                'id'=>'03',
                'name'=> 'Contact Person',
                'form'=> [
                    ['name'=> 'contact_person_name', 'lbl'=>'Contact Person Name', 'value'=> $data->contact_person_name],
                    ['name'=> 'contact_person_email', 'lbl'=>'Contact Person Email', 'value'=> $data->contact_person_email],
                    ['name'=> 'contact_person_phone', 'lbl'=>'Contact Person Phone', 'value'=> $data->contact_person_phone],
                    ['name'=> 'contact_person_alt_phone', 'lbl'=>'Contact Person Alternate Phone', 'value'=> $data->contact_person_alt_phone],
                ]
            ], 
            [
                'id'=>'04',
                'name'=> 'Confirm Details',
                'complete'=> [
                    ['name'=> 'business', 'lbl'=>'Business', 'type'=>'text', 'value'=> $data->business_name],
                    ['name'=> 'Name', 'lbl'=>'Name', 'type'=>'text', 'value'=> $data->business_name],
                    ['name'=> 'Name', 'lbl'=>'Name', 'type'=>'text', 'value'=> $data->business_name],
                ]
            ], 
        ];
    @endphp
    <x-partner.form.form_wizard1 heading="Add Business" :details="$details" :action="route('partner.business.update',$data->id)">
        @method('patch')
    </x-partner.form.form_wizard1>

</x-partner-layout>
