<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Slider 1 | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Slider 1" action="{{ route('admin.slider1.update', $data['id']) }}">
        @method('patch')
        <x-form.element.input1 name="heading1" label="Heading 1" type="text" required="required" :value="$data['heading1']" div="2" />
        <x-form.element.input1 name="heading2" label="Heading 2" type="text" required="required" :value="$data['heading2']" div="2" />
        <x-form.element.input1 name="paragraph1" label="Paragraph 1" type="textarea" required="required" :value="$data['paragraph1']" div="2" />
        <x-form.element.input1 name="paragraph2" label="Paragraph 2" type="textarea" required="required" :value="$data['paragraph2']" div="2" />
        <x-form.element.input1 name="btn_name" label="Button Name" type="text" required="required" :value="$data['btn_name']" div="2" />
        <x-form.element.input1 name="btn_url" label="Button URL" type="text" required="required" :value="$data['btn_url']" div="2" />
        <x-form.element.input1 name="btn_target" label="Button Target" type="text" required="required" :value="$data['btn_target']" div="2" />
        <x-form.element.input-img name="image1" :value="asset('images/slider/'.$data['image1'])" label="Image 1" type="image" div="4" ratio="56.25" />
        <x-form.element.input-img name="image2" :value="asset('images/slider/'.$data['image2'])" label="Image 1" type="image" div="4" ratio="56.25" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
    </x-form.type.standard>

</x-layout.admin.app>


