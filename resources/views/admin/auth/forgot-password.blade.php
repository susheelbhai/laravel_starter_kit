<x-admin.guest-layout>
    <x-admin.form.login-form name="Login" method="POST" action="{{ route('admin.password.email') }}"> 
        
        <x-admin.form.login-input type="text" name="email" lbl="email" value="{{ old('email')}}" />
        
        <x-admin.form.login-input type="submit" lbl="Email Password Reset Link"/>

    </x-admin.form.login-form >
</x-admin.guest-layout>


