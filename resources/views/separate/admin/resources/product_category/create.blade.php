<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Product Category | {{ config('app.name') }}</title>
    </x-slot>


    <x-form.type.standard title="Add Product Category" action="{{ route('admin.product_category.store') }}">
        <x-form.element.input1 name="title" label="Title" type="text" required="required" div="2" />
        <x-form.element.input1 name="slug" label="Slug" type="text" div="2" />
        <x-form.element.input1 name="description" label="Description" type="textarea" div="2" />
        <x-form.element.input1 name="position" label="Position" type="number" div="2" />
        <x-form.element.input1 name="meta_title" label="Meta Title" type="text" div="2" />
        <x-form.element.input1 name="meta_description" label="Meta Description" type="textarea" div="2" />
        <x-form.element.input-img name="icon" label="Icon" type="image" div="2" ratio="56.25" />
        <x-form.element.input-img name="banner" label="Banner" type="image" div="2" ratio="56.25" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
        <x-form.element.input1 name="is_featured" label="Featured" type="switch" :value="0" />
    </x-form.type.standard>

</x-admin.app-layout>
