<x-admin.app-layout>
    <x-slot name="head">
        <title> Edit Partner  | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    @php
        $details = [
                    ['name'=> 'name', 'lbl'=>'Name', 'value'=>$user->name],
                    ['name'=> 'email', 'lbl'=>'Email Adress', 'value'=>$user->email],
                    ['name'=> 'phone', 'lbl'=>'Phone Number', 'value'=>$user->phone],
                    ['name'=> 'profile_pic', 'lbl'=>'Profile Pic', 'type'=>'file', 'image'=>true, 'value'=>url('storage/images/partner/profile/').'/'.$user->profile_pic],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Edit Partner" :details="$details" :action="route('admin.partner.update', $user->partner_id)" >
        @method('patch')
       
    </x-admin.form.form1>

</x-admin.app-layout>
