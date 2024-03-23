<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Partner  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Edit Partner" action="{{ route('admin.partner.update', $user->id) }}">
        @method('patch')
            <x-form.element.input1 name="name" :value="$user['name']" label="Name" required="required" />
            <x-form.element.input1 name="email" :value="$user['email']" label="Email" required="required" />
            <x-form.element.input1 name="phone" :value="$user['phone']" label="Phone" type="number" required="required" />
            <x-form.element.input1 name="dob" value="2024-12-12" label="Date of Birth" type="date" required="required" />
            <x-form.element.input-img name="profile_pic" :value="asset('images/profile_pic/partner/'.$user['profile_pic'])" label="Profile Pic" type="image" div="6" ratio="125" />
        
    </x-form.type.standard>

    

</x-layout.admin.app>
