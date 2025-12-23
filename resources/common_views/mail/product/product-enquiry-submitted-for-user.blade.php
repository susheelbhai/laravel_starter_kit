<x-mail::message>
# Thank You for Your Enquiry!

Hello {{ $data->name }},

We have received your enquiry about **{{ $data->product->title }}** and our team will get back to you shortly.

<x-mail::panel>
**Your Details**  
**Email:** {{ $data->email }}  
@if ($data->phone)
**Phone:** {{ $data->phone }}  
@endif

**Product:** {{ $data->product->title }}
</x-mail::panel>

@if ($data->message)
## Your Message
{{ $data->message }}
@endif

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

If you need immediate assistance, you can reply directly to this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
