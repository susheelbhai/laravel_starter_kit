<x-mail::message>
# Thank You for Contacting Us!

Hello {{ $data['name'] }},

We have received your message and our team will get back to you shortly.

<x-mail::panel>
**Your Details**  
**Email:** {{ $data['email'] }}  
@if (!empty($data['phone']))
**Phone:** {{ $data['phone'] }}  
@endif

**Subject:** {{ $data['subject'] }}
</x-mail::panel>

## Your Message
{{ $data['message'] }}

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

If you need immediate assistance, you can reply directly to this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
