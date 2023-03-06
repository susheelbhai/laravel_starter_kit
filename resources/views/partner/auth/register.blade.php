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
    <form method="POST" action="{{ route('partner.register') }}">
        @csrf


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('partner.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-partner.guest-layout>
