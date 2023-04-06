<x-partner.app-layout>
    <x-slot name="head">
        <title> Edit Profile | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    @php
        $details = [
                    ['name'=> 'name', 'lbl'=>'Name', 'value'=>$user->name, 'class'=>'col50'],
                    ['name'=> 'email', 'lbl'=>'Email Adress', 'value'=>$user->email, 'class'=>'col50'],
                    ['name'=> 'phone', 'lbl'=>'Phone Number', 'value'=>$user->phone, 'class'=>'col50'],
                    ['name'=> 'profile_pic', 'lbl'=>'Profile Pic', 'type'=>'file', 'image'=>true, 'value'=>url('storage/images/partner/profile/').'/'.$user->profile_pic, 'class'=>'profile_pic_input'],
        ];
    @endphp
    <x-partner.form.form1 method="post" heading="Edit Profile" :details="$details" :action="route('partner.profile.update')" >
        @method('patch')
       
    </x-partner.form.form1>

</x-partner.app-layout>
