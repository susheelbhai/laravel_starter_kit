<x-mail::message>
# Hello

You are receiving this email because we received a password reset request for your account.

<x-mail::button :url="$token_url">
Reset Password
</x-mail::button>

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Regards,
Team {{ Config::get('settings', 'default')->app_name; }}


If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{ $token_url }}">{{ $token_url }}</a> 

</x-mail::message>
