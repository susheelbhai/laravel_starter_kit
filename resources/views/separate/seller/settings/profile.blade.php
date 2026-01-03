<x-layout.seller.app>
    <x-slot name="head">
        <title> Edit Profile  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Edit Profile" action="{{ route('seller.profile.update', $data->id) }}">
        @method('patch')
            <x-form.element.input1 name="name" :value="$data['name']" label="Name" required="required" />
            <x-form.element.input1 name="email" :value="$data['email']" label="Email" required="required" />
            <x-form.element.input1 name="phone" :value="$data['phone']" label="Phone" type="number" required="required" />
            <x-form.element.input-img name="profile_pic" :value="asset($data['profile_pic'])" label="Profile Pic" type="image" div="6" ratio="125" />
        
    </x-form.type.standard>

    

</x-layout.seller.app>
