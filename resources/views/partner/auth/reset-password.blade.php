<x-partner.guest-layout>
    <x-partner.form.login-form name="Login" method="POST" action="{{ route('partner.password.store') }}">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-partner.form.login-input type="text" name="email" lbl="email" :value="$request->email" />
        <x-partner.form.login-input type="password" name="password" lbl="Password" :value="old('password')" />
        <x-partner.form.login-input type="password" name="password_confirmation" lbl="Confirm Password"
            :value="old('password_confirmation')" />
        <x-partner.form.login-input type="submit" lbl="Reset Password" />

    </x-partner.form.login-form>
</x-partner.guest-layout>
