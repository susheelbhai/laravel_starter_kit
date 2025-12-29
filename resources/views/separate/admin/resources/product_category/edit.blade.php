<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Product Category | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Product Category" action="{{ route('admin.product_category.update', $data['id']) }}">
        @method('patch')
        <x-form.element.input1 name="title" :value="$data['title']" label="Title" type="text" required="required" div="2" />
        <x-form.element.input1 name="slug" :value="$data['slug']" label="Slug" type="text" div="2" />
        <x-form.element.input1 name="description" :value="$data['description']" label="Description" type="textarea" div="2" />
        <x-form.element.input1 name="position" :value="$data['position']" label="Position" type="number" div="2" />
        <x-form.element.input1 name="meta_title" :value="$data['meta_title']" label="Meta Title" type="text" div="2" />
        <x-form.element.input1 name="meta_description" :value="$data['meta_description']" label="Meta Description" type="textarea" div="2" />
        <x-form.element.input-img name="icon" :value="$data['icon_thumb'] ?? ''" label="Icon" type="image" div="2" ratio="56.25" />
        <x-form.element.input-img name="banner" :value="$data['banner_thumb'] ?? ''" label="Banner" type="image" div="2" ratio="56.25" />
        <x-form.element.input1 name="is_active" :value="$data['is_active']" label="Status" type="switch" :value="1" />
        <x-form.element.input1 name="is_featured" :value="$data['is_featured']" label="Featured" type="switch" :value="0" />
    </x-form.type.standard>

</x-admin.app-layout>
