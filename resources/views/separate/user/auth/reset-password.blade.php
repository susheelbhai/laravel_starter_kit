<x-layout.guest>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Authenticate {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.login title="Reset Password" action="{{ route('password.store') }}" submitName="{{ __('Reset Password') }}">
        <x-form.element.input-login name="email" label="Email" type="email" :value="$request->email" required="required" />
        <x-form.element.input-login name="password" label="Password" type="password" required="required" />
        <x-form.element.input-login name="password_confirmation" label="Password" type="password_confirmation" required="required" />
        
    </x-form.type.login>
    
</x-layout.guest>
