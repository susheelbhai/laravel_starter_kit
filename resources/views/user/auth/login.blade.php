<x-user.guest-layout>
    <!-- Session Status -->
    <h4>Welcome Back!</h4>
    <p>Didn't have an account?<a class="ms-2" href="{{ route('register') }}">Sign Up</a></p>
    <x-user.form.login-form name="" method="POST" action="{{ route('login') }}">
        <x-user.form.login-input type="text" name="login" lbl="Username" value="{{ old('login') }}" />
        <x-user.form.login-input type="password" name="password" lbl="Password" value="{{ old('password') }}" />
        <x-user.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember') }}" />
        <x-user.form.login-input type="submit" lbl="Log In" />
        <x-user.form.login-input type="footer_link" name="forgot_password" lbl="Forgot your password?"
            value="password.request" />
        
    </x-user.form.login-form>





</x-user.guest-layout>
