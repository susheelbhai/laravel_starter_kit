
<x-user.guest-layout>
    <!-- Session Status -->
    <h4>Reset Password</h4>
    <p> </p>
    <x-user.form.login-form name="" method="POST" action="{{ route('password.store') }}">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-user.form.login-input type="email" name="email" lbl="Email" value="{{ old('email',  $request->email) }}" />
        <x-user.form.login-input type="password" name="password" lbl="Password" value="{{ old('password') }}" />
        <x-user.form.login-input type="password" name="password_confirmation" lbl="Confirm Password" value="{{ old('password_confirmation') }}" />
        <x-user.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember') }}" />
        <x-user.form.login-input type="submit" lbl="Reset Password" />
        
    </x-user.form.login-form>


</x-user.guest-layout>


