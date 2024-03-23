<x-layout.admin.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Authenticate {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.login title="Sign in your account" action="{{ route('admin.login') }}" submitName="Sign Me In">
        <x-form.element.input-login name="email" label="Email" type="email" required="required" />
        <x-form.element.input-login name="password" label="Password" type="password" required="required" />
        <x-form.element.input-login name="remember_me" label="Remember my preference" type="remember" />
        <div class="mb-3">
            <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
        </div>
    </x-form.type.login>


</x-layout.admin.guest>
