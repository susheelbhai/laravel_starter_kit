
<x-layout.user.app type="auth">
    <x-slot name="head">
        <title>Edit Profile | {{ config('app.name') }}</title>
        <style>
            .profile-edit-card {
                max-width: 500px;
                margin: 2rem auto;
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.08);
                padding: 2rem 2.5rem;
            }
            .profile-avatar {
                display: flex;
                justify-content: center;
                margin-bottom: 1.5rem;
            }
            .profile-avatar img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 50%;
                border: 3px solid #e2e8f0;
            }
            .profile-form-group {
                margin-bottom: 1.25rem;
            }
            .profile-form-label {
                font-weight: 500;
                margin-bottom: 0.5rem;
                display: block;
            }
        </style>
    </x-slot>

    <div class="profile-edit-card">
        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="profile-avatar">
                <img src="{{ asset($user['profile_pic']) }}" alt="Profile Picture" />
            </div>
            <div class="profile-form-group">
                <label class="profile-form-label" for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $user['name'] }}" class="form-control" required />
            </div>
            <div class="profile-form-group">
                <label class="profile-form-label" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $user['email'] }}" class="form-control" required />
            </div>
            <div class="profile-form-group">
                <label class="profile-form-label" for="phone">Phone</label>
                <input type="number" name="phone" id="phone" value="{{ $user['phone'] }}" class="form-control" required />
            </div>
            <div class="profile-form-group">
                <label class="profile-form-label" for="profile_pic">Profile Picture</label>
                <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*" />
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
</x-layout.user.app>
