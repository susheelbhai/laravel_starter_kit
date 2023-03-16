<div class="register-form my-4 my-lg-5">
    <form class="form-horizontal mt-3" method="{{ $method }}" action="{{ $action }}">
        @csrf
        <x-auth-session-status class="mb-4" :status="session('status')" />
        {{ $slot }}

    </form>
</div>
