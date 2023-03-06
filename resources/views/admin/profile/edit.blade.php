<x-admin.app-layout>

    @php
        $details = [
                    ['name'=> 'name', 'lbl'=>'Name', 'value'=>$user->name],
                    ['name'=> 'email', 'lbl'=>'Email Adress', 'value'=>$user->email],
                    ['name'=> 'phone', 'lbl'=>'Phone Number', 'value'=>$user->phone],
                    ['name'=> 'profile_pic', 'lbl'=>'Profile Pic', 'type'=>'file', 'image'=>true, 'value'=>url('storage/images/admin/profile/').'/'.$user->profile_pic],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Edit Profile" :details="$details" :action="route('admin.profile.update')" >
        @method('patch')
        <x-slot name="thead">

        </x-slot>
    </x-admin.form.form1>

</x-admin.app-layout>
