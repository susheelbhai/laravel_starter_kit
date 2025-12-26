
<x-layout.seller.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Authenticate {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.login title="Sign in your account" :action="route('seller.password.email')" :submitName="__('Email Password Reset Link')">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        <x-form.element.input-login name="email" label="Email" type="email" required="required" />
        
    </x-form.type.login>

</x-layout.seller.guest>

