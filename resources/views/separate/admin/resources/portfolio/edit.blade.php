<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Portfolio | {{ config('app.name') }}</title>
    </x-slot>
    <x-form.type.standard title="Edit Portfolio" action="{{ route('admin.portfolio.update', $data['id']) }}">
        @method('patch')
        <div class="col-6">
            <div class="row">
                <x-form.element.input1 name="name" label="Name" :value="$data['name']" required="required" div="1" />
                <x-form.element.input1 name="url" label="url" :value="$data['url']" required="required" div="1" />
                <x-form.element.input1 name="is_active" label="Status" type="switch" :value="$data['is_active']" />
            </div>
        </div>
        
        <x-form.element.input-img name="image" :value="asset($data['logo'])" label="Logo" type="image" div="4" ratio="56.25" />
    </x-form.type.standard>

</x-admin.app-layout>
