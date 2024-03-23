<x-layout.user.guest>
    
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Authenticate {{ config('app.name') }}</title>
    </x-slot>

    <div class="col-xl-12">
        <div class="auth-form">
            <div class="text-center mb-3">
                <a href="index.html"><img src="images/logo-full.png" alt=""></a>
            </div>
            <h4 class="text-center mb-4">Sign in your account</h4>
            @error('email')
                <x-form.validation-error :value="$message" />
            @enderror
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="mb-1"><strong>Email</strong></label>
                    <input name="email" type="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="mb-1"><strong>Password</strong></label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="row d-flex justify-content-between mt-4 mb-2">
                    <div class="mb-3">
                        <div class="form-check custom-checkbox ms-1">
                            <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                            <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="page-forgot-password.html">Forgot Password?</a>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                </div>
            </form>

        </div>
    </div>
</x-layout.user.guest>
