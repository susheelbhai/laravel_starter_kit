<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Product | {{ config('app.name') }}</title>
    </x-slot>


    <x-form.type.standard title="Add Product" action="{{ route('admin.product.store') }}">
        <x-form.element.input1 name="title" label="Title" type="text" required="required" div="2" />
        <x-form.element.input1 name="slug" label="Slug" type="text" div="2" />
        <x-form.element.input1 name="sku" label="SKU" type="text" div="2" />
        <x-form.element.input1 name="product_category_id" label="Category ID" type="number" div="2" />
        <x-form.element.input1 name="short_description" label="Short Description" type="textarea" div="2" />
        <x-form.element.input1 name="description" label="Description" type="textarea" div="2" />
        <x-form.element.input1 name="long_description2" label="Long Description 2" type="textarea" div="2" />
        <x-form.element.input1 name="long_description3" label="Long Description 3" type="textarea" div="2" />
        <x-form.element.input1 name="features" label="Features" type="textarea" div="2" />
        <x-form.element.input1 name="price" label="Price" type="number" div="2" />
        <x-form.element.input1 name="original_price" label="Original Price" type="number" div="2" />
        <x-form.element.input1 name="mrp" label="MRP" type="number" div="2" />
        <x-form.element.input1 name="stock" label="Stock" type="number" div="2" />
        <x-form.element.input1 name="manage_stock" label="Manage Stock" type="switch" :value="0" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
        <x-form.element.input1 name="is_featured" label="Featured" type="switch" :value="0" />
        <x-form.element.input1 name="meta_title" label="Meta Title" type="text" div="2" />
        <x-form.element.input1 name="meta_description" label="Meta Description" type="textarea" div="2" />
        <x-form.element.input-img name="images[]" label="Images" type="image" div="2" ratio="56.25" multiple />
    </x-form.type.standard>

</x-admin.app-layout>
