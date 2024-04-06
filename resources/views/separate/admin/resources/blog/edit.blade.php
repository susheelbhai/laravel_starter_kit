<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Blog | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Blog" action="{{ route('admin.blog.update', $data['id']) }}">
        @method('patch')
        <x-form.element.input1 name="title" :value="$data['title']" label="Name" type="text" required="required" div="2" />
        <x-form.element.input1 name="category" :value="$data['category']" label="Category" type="text" required="required" div="2" />
        <x-form.element.input1 name="author" :value="$data['author']" label="Author" type="text" required="required" div="2" />
        <x-form.element.input1 name="tags" :value="$data['tags']" label="Tags" type="tags" required="required" div="2" />
        <x-form.element.input1 name="short_description" :value="$data['short_description']" label="Short Description" type="textarea" required="required" div="1" />
        <x-form.element.input1 name="long_description1" :value="$data['long_description1']" label="Long Description" type="editor" required="required" div="1" />
        <x-form.element.input1 name="highlighted_text1" :value="$data['highlighted_text1']" label="Highlighted Text 2" type="textarea" div="1" />
        <x-form.element.input1 name="long_description2" :value="$data['long_description2']" label="Long Description" type="editor" div="1" />
        <x-form.element.input1 name="highlighted_text2" :value="$data['highlighted_text2']" label="Highlighted Text 2" type="textarea" div="1" />
        <x-form.element.input1 name="long_description3" :value="$data['long_description3']" label="Long Description" type="editor" div="1" />
        <x-form.element.input-img name="image" :value="asset($data['display_img'])" label="Image" type="image" div="2" ratio="56.25" />
        <x-form.element.input-img name="ad_img" :value="asset($data['ad_img'])" label="Ad Image" type="image" div="2" ratio="56.25" />
        <x-form.element.input1 name="ad_url" :value="$data['ad_url']" label="Ad Url" type="url" required="required" div="2" />
        <x-form.element.input1 name="is_active" :value="$data['is_active']" label="Status" type="switch" :value="1" />
    </x-form.type.standard>

</x-admin.app-layout>
