<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> General Setting | {{ config('app.name') }}</title>
    </x-slot>
    
    <x-slot name="page_name">
        General Setting
    </x-slot>

    <x-form.type.standard title="General Setting" action="{{ route('admin.settings.general') }}">
        @method('patch')
        <x-form.element.input1 name="app_name" label="App Name" type="text" :value="$data['app_name']" required="required" div="1" />
        <x-form.element.input-img name="favicon" label="Favicon" type="photo" :value="asset('images/logo/'.$data['favicon'])" div="4" />
        <x-form.element.input-img name="dark_logo" label="Dark Logo" type="photo" :value="asset('images/logo/'.$data['dark_logo'])" div="4" />
        <x-form.element.input-img name="light_logo" label="Light Logo" type="photo" :value="asset('images/logo/'.$data['light_logo'])" div="4" />
        <x-form.element.input1 name="color1" label="Theme Color 1" type="color" :value="$data['color1']" required="required" />
        <x-form.element.input1 name="color2" label="Theme Color 2" type="color" :value="$data['color2']" required="required" />
        <x-form.element.input1 name="color3" label="Theme Color 3" type="color" :value="$data['color3']" required="required" />
        <x-form.element.input1 name="color4" label="Theme Color 4" type="color" :value="$data['color4']" required="required" />
        <x-form.element.input1 name="color5" label="Theme Color 5" type="color" :value="$data['color5']" required="required" />
        <x-form.element.input1 name="color6" label="Theme Color 6" type="color" :value="$data['color6']" required="required" />
        <x-form.element.input1 name="image" label="Image" type="image" required="required" />
    </x-form.type.standard>
    
</x-layout.admin.app>
