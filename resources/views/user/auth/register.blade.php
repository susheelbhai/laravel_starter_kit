
<x-user.guest-layout>
    <!-- Session Status -->
    <h4>Create your free account</h4>
    <p>Already Registered?<a class="ms-2" href="{{ route('login') }}">Sign In</a></p>
    <x-user.form.login-form name="" method="POST" action="{{ route('register') }}">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-user.form.login-input type="text" name="name" lbl="Full Name" value="{{ old('name') }}" />
        <x-user.form.login-input type="email" name="email" lbl="Email" value="{{ old('email') }}" />
        <x-user.form.login-input type="text" name="phone" lbl="Phone Number" value="{{ old('phone') }}" />
        <x-user.form.login-input type="password" name="password" lbl="Password" value="{{ old('password') }}" />
        <x-user.form.login-input type="password" name="password_confirmation" lbl="Confirm Password" value="{{ old('password_confirmation') }}" />
        <x-user.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember') }}" />
        <x-user.form.login-input type="submit" lbl="Register" />
        
    </x-user.form.login-form>


</x-user.guest-layout>
