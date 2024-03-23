<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Important Link  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Add Important Link" action="{{ route('admin.important_links.update', $data['id']) }}">
        @method('patch')
        <x-form.element.input1 name="name" label="Name" type="text" required="required" :value="$data['name']" div="2" />
        <x-form.element.input1 name="href" label="href" type="text" required="required" :value="$data['href']" div="2" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="$data['is_active']" />
    </x-form.type.standard>
    

</x-admin.app-layout>
