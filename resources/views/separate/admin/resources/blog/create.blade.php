<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Blog | {{ config('app.name') }}</title>
    </x-slot>


    <x-form.type.standard title="Add Blog" action="{{ route('admin.blog.store') }}">
        <x-form.element.input1 name="title" label="Title" type="text" required="required" div="2" />
        <x-form.element.input1 name="category" label="Category" type="text" required="required" div="2" />
        <x-form.element.input1 name="author" label="Author" type="text" required="required" div="2" />
        <x-form.element.input1 name="tags" label="Tags" type="tags" required="required" div="2" />
        <x-form.element.input1 name="short_description" label="Short Description" type="textarea" required="required" div="1" />
        <x-form.element.input1 name="long_description1" label="Long Description 1" type="editor" required="required" div="1" />
        <x-form.element.input1 name="highlighted_text1" label="Highlighted Text 1" type="textarea" div="1" />
        <x-form.element.input1 name="long_description2" label="Long Description 2" type="editor" div="1" />
        <x-form.element.input1 name="highlighted_text2" label="Highlighted Text 2" type="textarea" div="1" />
        <x-form.element.input1 name="long_description3" label="Long Description 3" type="editor" div="1" />
        <x-form.element.input-img name="image" :value="asset('images/blogs/'.'dummy.png')" label="Blog Image" type="image" div="2" ratio="56.25" />
        <x-form.element.input-img name="ad_img" :value="asset('images/blogs/'.'dummy.png')" label="Ad Image" type="image" div="2" ratio="56.25" />
        <x-form.element.input1 name="ad_url" label="Ad Url" type="url" required="required" div="2" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
    </x-form.type.standard>

</x-admin.app-layout>
