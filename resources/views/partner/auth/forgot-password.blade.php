<x-partner.guest-layout>

    <x-partner.form.login-form name="Login" method="POST" action="{{ route('partner.password.email') }}"> 
        
        <x-partner.form.login-input type="text" name="email" lbl="email" value="{{ old('email')}}" />
        <x-partner.form.login-input type="submit" lbl="Email Password Reset Link"/>


    </x-partner.form.login-form >



</x-partner.guest-layout>


