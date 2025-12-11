<x-mail::message>
# New Contact Form Submission

Dear Admin,

You have received a new message from your website.

<x-mail::panel>
**Name:** {{ $data->name }}  
**Email:** {{ $data->email }}  
@if ($data->phone)
**Phone:** {{ $data->phone }}  
@endif
**Subject:** {{ $data->subject }}
</x-mail::panel>

## Message
{{ $data->body }}

<x-mail::button :url="route('admin.userQuery.show',$data->id) ">
Reply to {{ $data->name }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
