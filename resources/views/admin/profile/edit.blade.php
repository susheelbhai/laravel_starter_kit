<x-admin.app-layout>

    <x-slot name="head">
        <style>
            .avatar-upload .avatar-preview {
                height: 12rem;
            }
        </style>
    </x-slot>

    @php
        $details = [
                    ['name'=> 'name', 'lbl'=>'Name', 'value'=>$user->name, 'class'=>'col50'],
                    ['name'=> 'email', 'lbl'=>'Email Adress', 'value'=>$user->email, 'class'=>'col50'],
                    ['name'=> 'phone', 'lbl'=>'Phone Number', 'value'=>$user->phone, 'class'=>'col50'],
                    ['name'=> 'profile_pic', 'lbl'=>'Profile Pic', 'type'=>'file', 'image'=>true, 'value'=>url('storage/images/admin/profile/').'/'.$user->profile_pic, 'class'=>'profile_pic_input'],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Edit Profile" :details="$details" :action="route('admin.profile.update')" >
        @method('patch')
        <x-slot name="thead">

        </x-slot>
    </x-admin.form.form1>

</x-admin.app-layout>
