<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Service | {{ config('app.name') }}</title>
    </x-slot>


    <x-form.type.standard title="Add Service" action="{{ route('admin.service.store') }}">
        <x-form.element.input1 name="title" label="Name" type="text" required="required" div="2" />
        <x-form.element.input1 name="category" label="Category" type="text" required="required" div="2" />
        <x-form.element.input1 name="short_description" label="Short Description" type="textarea" required="required" div="1" />
        <x-form.element.input1 name="long_description1" label="Long Description1" type="editor" required="required" div="1" />
        <x-form.element.input1 name="long_description2" label="Long Description2" type="editor" div="1" />
        <x-form.element.input1 name="long_description3" label="Long Description3" type="editor" div="1" />
        <x-form.element.input1 name="tags" label="Tags" type="tags" required="required" div="1" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
        <x-form.element.input-img name="image" :value="asset('images/services/'.'dummy.png')" label="Image" type="image" div="2" ratio="56.25" />
        
    </x-form.type.standard>

</x-admin.app-layout>
