
<x-layout.admin.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Authenticate {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.login title="Sign in your account" :action="route('admin.password.store')" :submitName=" __('Reset Password')">
    
        <x-form.element.input-login name="token" label="Email" type="hidden" :value="old('token', $request->token)" required="required" />
        <x-form.element.input-login name="email" label="Email" type="email" :value="old('email', $request->email)" required="required" />
        <x-form.element.input-login name="password" :label="__('Password')" type="password" required="required" />
        <x-form.element.input-login name="password_confirmation" :label="__('Confirm Password')" type="password" required="required" />
        
    </x-form.type.login>

</x-layout.admin.guest>