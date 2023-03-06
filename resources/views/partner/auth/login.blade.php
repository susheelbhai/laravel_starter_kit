<x-partner.guest-layout>

        <x-partner.form.login-form name="Login" method="POST" action="{{ route('partner.login') }}"> 
            
            <x-partner.form.login-input type="text" name="login" lbl="Username" value="{{ old('login')}}" />
            <x-partner.form.login-input type="password" name="password" lbl="Password" value="{{ old('password')}}" />
            <x-partner.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember')}}" />
            <x-partner.form.login-input type="submit" lbl="Log In" />
            
            <x-partner.form.login-input type="footer_link" name="remember" lbl="Forgot your password?" value="partner.password.request" />
            <x-partner.form.login-input type="footer_link" lbl="Don't have an account?" value="partner.register" />


        </x-partner.form.login-form >
    


</x-partner.guest-layout>
