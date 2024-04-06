<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Service | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Service" action="{{ route('admin.service.update', $data['id']) }}">
        @method('patch')
        <x-form.element.input1 name="title" :value="$data['title']" label="Name" type="text" required="required" div="2" />
        <x-form.element.input1 name="category" :value="$data['category']" label="Category" type="text" required="required" div="2" />
        <x-form.element.input1 name="short_description" :value="$data['short_description']" label="Short Description" type="textarea" required="required" div="1" />
        <x-form.element.input1 name="long_description1" :value="$data['long_description1']" label="Long Description" type="editor" required="required" div="1" />
        <x-form.element.input1 name="long_description2" :value="$data['long_description2']" label="Long Description" type="editor" div="1" />
        <x-form.element.input1 name="long_description3" :value="$data['long_description3']" label="Long Description" type="editor" div="1" />
        <x-form.element.input1 name="tags" :value="$data['tags']" label="Tags" type="tags" required="required" div="1" />
        <x-form.element.input1 name="is_active" :value="$data['is_active']" label="Status" type="switch" />
        <x-form.element.input-img name="image" :value="asset($data['display_img'])" label="Image" type="image" div="2" ratio="56.25" />
    </x-form.type.standard>

</x-admin.app-layout>
