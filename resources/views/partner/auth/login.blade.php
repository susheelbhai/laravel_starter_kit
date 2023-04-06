<x-partner.guest-layout>
    <x-slot name="head">
        <title> Partner Login | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    

    <x-partner.form.login-form name="Login" method="POST" action="{{ route('partner.login') }}">

        <x-partner.form.login-input type="text" name="login" lbl="Username" value="{{ old('login') }}" />
        <x-partner.form.login-input type="password" name="password" lbl="Password" value="{{ old('password') }}" />
        <div id="tooglePasswordDiv"> <i class="fa fa-eye" id="tooglePassword" onclick="tooglePassword()"> </i> </div>
        <x-partner.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember') }}" />
        <x-partner.form.login-input type="submit" name="submit" lbl="Log In" />

        <x-partner.form.login-input type="footer_link" name="remember" lbl="Forgot your password?"
            value="partner.password.request" />
        <x-partner.form.login-input type="footer_link" lbl="Don't have an account?" value="partner.register" />


    </x-partner.form.login-form>



</x-partner.guest-layout>
