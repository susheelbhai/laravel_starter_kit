<x-partner.app-layout>

    @php
        $details = [
                    ['name'=> 'name', 'lbl'=>'Name', 'value'=>$user->name],
                    ['name'=> 'email', 'lbl'=>'Email Adress', 'value'=>$user->email],
                    ['name'=> 'phone', 'lbl'=>'Phone Number', 'value'=>$user->phone],
                    ['name'=> 'profile_pic', 'lbl'=>'Profile Pic', 'type'=>'file', 'image'=>true, 'value'=>url('storage/images/partner/profile/').'/'.$user->profile_pic],
        ];
    @endphp
    <x-partner.form.form1 method="post" heading="Edit Profile" :details="$details" :action="route('partner.profile.update')" >
        @method('patch')
       
    </x-partner.form.form1>

</x-partner.app-layout>
