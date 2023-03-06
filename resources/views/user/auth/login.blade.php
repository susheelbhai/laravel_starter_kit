<x-user.guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="register-form my-4 my-lg-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="form-group mb-3">
            <input name="login" class="form-control rounded-0" type="login" placeholder="Email Address" required>
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
          </div>
          <div class="form-group mb-3">
            <label class="label-psswd" for="registerPassword">Show</label>
            <input name="password" class="form-control rounded-0" id="registerPassword" type="password" placeholder="Password" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <button class="btn btn-primary w-100" type="submit"><i class="bi bi-unlock me-2"></i>Login</button>
        </form>
        <div class="login-meta-data d-flex align-items-center justify-content-between">
          <div class="form-check mt-3">
            <input name="remember" class="form-check-input" id="rememberMe" type="checkbox" value="" checked>
            <label class="form-check-label" for="rememberMe">Keep me logged in</label>
          </div>
          @if (Route::has('password.request'))
          <a class="forgot-password mt-3" href="{{ route('password.request') }}">Forgot Password?</a>
          @endif
        </div>
      </div>

</x-user.guest-layout>
