<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Seller  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Edit Seller" action="{{ route('admin.seller.update', $data->id) }}">
        @method('patch')
            <x-form.element.input1 name="name" :value="$data['name']" label="Name" required="required" />
            <x-form.element.input1 name="email" :value="$data['email']" label="Email" required="required" />
            <x-form.element.input1 name="phone" :value="$data['phone']" label="Phone" type="number" required="required" />
            <x-form.element.input1 name="dob" value="2024-12-12" label="Date of Birth" type="date" required="required" />
            <x-form.element.input-img name="profile_pic" :value="asset('images/profile_pic/seller/'.$data['profile_pic'])" label="Profile Pic" type="image" div="6" ratio="125" />
        
    </x-form.type.standard>

    

</x-layout.admin.app>
