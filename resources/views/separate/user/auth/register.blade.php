<x-layout.guest>
    <x-form.type.login title="Sign in your account" action="{{ route('register') }}" submitName=" {{ __('Register') }}">
        <x-form.element.input-login name="email" label="Email" type="email" required="required" />
        <x-form.element.input-login name="password" label="Password" type="password" required="required" />
        <x-form.element.input-login name="password_confirmation" label="password_confirmation" type="password" required="required" />
        <x-form.element.input-login name="remember_me" label="Remember my preference" type="remember" />
        <div class="mb-3">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
        
    </x-form.type.login>

</x-layout.guest>
