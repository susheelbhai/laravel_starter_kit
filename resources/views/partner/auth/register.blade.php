<x-partner.guest-layout>

    <x-partner.form.login-form name="Register" method="POST" action="{{ route('partner.register') }}"> 
            
        <x-partner.form.login-input type="text" name="name" lbl="Name" value="{{ old('name')}}" />
        <x-partner.form.login-input type="email" name="email" lbl="Email" value="{{ old('email')}}" />
        <x-partner.form.login-input type="text" name="phone" lbl="Phone Number" value="{{ old('phone')}}" />
        <x-partner.form.login-input type="password" name="password" lbl="Password" value="{{ old('password')}}" />
        <x-partner.form.login-input type="password" name="password_confirmation" lbl="Confirm Password" value="{{ old('password_confirmation')}}" />
        <x-partner.form.login-input type="checkbox" name="remember" lbl="Remember me" value="{{ old('remember')}}" />
        <x-partner.form.login-input type="submit" lbl="Register" />
        
        <x-partner.form.login-input type="footer_link" lbl="Already registered?" value="partner.login" />


    </x-partner.form.login-form >
    
</x-partner.guest-layout>
