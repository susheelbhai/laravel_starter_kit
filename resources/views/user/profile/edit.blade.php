<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title>{{ Config::get('settings', 'default')->app_name }}</title>
        <style>
            .avatar-upload .avatar-preview {
                height: 12rem;
                width: 12rem;
                border-radius: 6rem;
            }

            .avatar-upload {
                margin: auto;
            }

            .avatar-upload .avatar-preview>div {
                border-radius: 50%;
                background-size: cover;
            }

            .avatar-edit {
                z-index: 1;
                position: relative;
                top: -2rem;
            }
            .avatar-upload .avatar-edit input + label{
                width: 3rem;
                height: 3rem;
                border-radius: 1.5rem;
                color: red
            }
        </style>
    </x-slot>

    <!-- Breadcrumb Area-->
    <div class="breadcrumb-wrapper bg-img bg-overlay" style="background-image: url('img/bg-img/12.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">User Profile</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-120 d-block"></div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">

            <div class="col-md-5 border-right">


                <div class="card register-card bg-gray p-2 p-sm-4">
                    <div class="card-body">
                        <x-user.form.login-form name="" method="POST"
                            action="{{ route('user.profile.update') }}">
                            @method('patch')
                            <x-user.form.input-img1 type="image" name="profile_pic" lbl="<i class='fa-solid fa-pen-to-square'></i>"
                                value="{{ url('storage/images/user/profile/') . '/' . $user->profile_pic }}" />
                            <x-user.form.login-input type="text" name="name" lbl="Full Name"
                                value="{{ old('name', $user->name) }}" />
                            <x-user.form.login-input type="text" name="phone" lbl="Phone Number"
                                value="{{ old('phone', $user->phone) }}" />
                            <x-user.form.login-input type="email" name="email" lbl="Email"
                                value="{{ old('email', $user->email) }}" />
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <x-user.form.login-input type="submit" lbl="Submit" />

                        </x-user.form.login-form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"> </div>
            <div class="col-md-5">
                <div class="card register-card bg-gray p-2 p-sm-4">
                    <div class="card-body">
                        <x-user.form.login-form name="" method="POST" action="{{ route('password.update') }}">
                            @method('put')
                            <x-user.form.login-input type="password" name="current_password" lbl="Current Password"
                                value="{{ old('current_password') }}" />
                            <x-user.form.login-input type="password" name="password" lbl="New Password"
                                value="{{ old('password') }}" />
                            <x-user.form.login-input type="password" name="password_confirmation" lbl="Confirm Password"
                                value="{{ old('password_confirmation') }}" />


                            <x-user.form.login-input type="submit" lbl="Change Password" />

                        </x-user.form.login-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


</x-user.app-layout>
