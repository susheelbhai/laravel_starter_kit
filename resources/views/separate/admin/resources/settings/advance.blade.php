<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Dashboard | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Advanced Setting" action="{{ route('admin.settings.advanced') }}">
        @method('patch')
        <x-form.element.input1 name="short_description" label="Short Description" type="textarea" :value="$data['short_description']" required="required" />
        <x-form.element.input1 name="address" label="Address" type="textarea" :value="$data['address']" required="required" />
        <x-form.element.input1 name="phone" label="Phone" type="text" :value="$data['phone']" required="required"/>
        <x-form.element.input1 name="email" label="Email" type="text" :value="$data['email']" required="required"/>
        <x-form.element.input1 name="facebook" label="Facebook" type="text" :value="$data['facebook']" required="required"/>
        <x-form.element.input1 name="twitter" label="Twitter" type="text" :value="$data['twitter']" required="required"/>
        <x-form.element.input1 name="linkedin" label="Linkedin" type="text" :value="$data['linkedin']" required="required"/>
        <x-form.element.input1 name="instagram" label="Instagram" type="text" :value="$data['instagram']" required="required"/>
    </x-form.type.standard>


    <section class="content">

    </section>
</x-layout.admin.app>
