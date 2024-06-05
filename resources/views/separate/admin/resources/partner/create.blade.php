<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Partner  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Create Partner" action="{{ route('admin.partner.store') }}">
        <x-form.element.input1 name="name"  label="Name" required="required" />
        <x-form.element.input1 name="email"  label="Email" required="required" />
        <x-form.element.input1 name="phone"  label="Phone" type="number" required="required" />
        <x-form.element.input1 name="dob" label="Date of Birth" type="date" required="required" />
        <x-form.element.input-img name="profile_pic" :value="asset('images/profile_pic/partner/dummy.png')" label="Profile Pic" type="image" div="6" ratio="125" />
    
</x-form.type.standard>

    

</x-layout.admin.app>
