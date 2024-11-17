<x-layout.guest>
    
    <x-form.type.login title="Confirm Password" action="{{ route('password.confirm') }}" submitName="{{ __('Confirm') }}">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <x-form.element.input-login name="password" label="Password" type="password" required="required" />
    </x-form.type.login>
    
</x-layout.guest>
