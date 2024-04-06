<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Testimonial | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Testimonial" action="{{ route('admin.testimonial.update', $data['id']) }}">
        @method('patch')
        <div class="col-6">
            <div class="row">
                <x-form.element.input1 name="name" label="Name" :value="$data['name']" required="required" div="1" />
                <x-form.element.input1 name="designation" label="designation" :value="$data['designation']" required="required" div="1" />
                <x-form.element.input1 name="organisation" label="organisation" :value="$data['organisation']" required="required" div="1" />
                <x-form.element.input1 name="message" label="message" type="textarea" :value="$data['message']" required="required" div="1" />
                <x-form.element.input1 name="is_active" label="Status" type="switch" :value="$data['is_active']" />
            </div>
        </div>
        
        <x-form.element.input-img name="image" :value="asset($data['image'])" label="Profile Pic" type="image" div="4" ratio="125" />
    </x-form.type.standard>

</x-admin.app-layout>
