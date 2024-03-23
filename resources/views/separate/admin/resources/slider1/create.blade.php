<x-layout.admin.app>
    <x-slot name="head">
        <title> Slider 1 | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Slider 1" action="{{ route('admin.slider1.store') }}">
        <x-form.element.input1 name="heading1" label="Heading 1" type="text" required="required" div="2" />
        <x-form.element.input1 name="heading2" label="Heading 2" type="text" required="required" div="2" />
        <x-form.element.input1 name="paragraph1" label="Paragraph 1" type="textarea" required="required" div="2" />
        <x-form.element.input1 name="paragraph2" label="Paragraph 2" type="textarea" required="required" div="2" />
        <x-form.element.input1 name="btn_name" label="Button Name" type="text" required="required" div="2" />
        <x-form.element.input1 name="btn_url" label="Button URL" type="text" required="required" div="2" />
        <x-form.element.input1 name="btn_target" label="Button Target" type="text" required="required" div="2" />
        <x-form.element.input-img name="image1" :value="asset('images/slider/'.'dummy.png')" label="Image 1" type="image" div="4" ratio="56.25" required="required" />
        <x-form.element.input-img name="image2" :value="asset('images/slider/'.'dummy.png')" label="Image 1" type="image" div="4" ratio="56.25" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
    </x-form.type.standard>

</x-admin.app-layout>
