<x-admin.guest-layout>
    <x-admin.form.login-form name="Login" method="POST" action="{{ route('admin.login') }}">

        <x-admin.form.login-input type="text" name="login" lbl="Username" value="{{ old('login') }}" />
        <x-admin.form.login-input type="password" name="password" lbl="Password" value="{{ old('password') }}" />
        <div id="tooglePasswordDiv"> <i class="fa fa-eye" id="tooglePassword" onclick="tooglePassword()"> </i> </div>

        <x-admin.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember') }}" />
        <x-admin.form.login-input type="submit" name="submit" lbl="Log In" />
        <x-admin.form.login-input type="footer_link" name="remember" lbl="Forgot your password?"
            value="admin.password.request" />

    </x-admin.form.login-form>
</x-admin.guest-layout>
