<x-admin.guest-layout>
    <x-admin.form.login-form name="Login" method="POST" action="{{ route('admin.password.store') }}">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-admin.form.login-input type="text" name="email" lbl="email" :value="$request->email" />
        <x-admin.form.login-input type="password" name="password" lbl="Password" :value="old('password')" />
        <x-admin.form.login-input type="password" name="password_confirmation" lbl="Confirm Password"
            :value="old('password_confirmation')" />
        <x-admin.form.login-input type="submit" lbl="Reset Password" />

    </x-admin.form.login-form>
</x-admin.guest-layout>
