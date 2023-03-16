
<x-user.guest-layout>
    <!-- Session Status -->
    <h4>Forgot your password? </h4>
    <p> {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} </p>
    <x-user.form.login-form name="" method="POST" action="{{ route('password.email') }}">
        <x-user.form.login-input type="email" name="email" lbl="Email Address" value="{{ old('email') }}" />
        <x-user.form.login-input type="submit" lbl="Email Password Reset Link" />
        
    </x-user.form.login-form>





</x-user.guest-layout>

