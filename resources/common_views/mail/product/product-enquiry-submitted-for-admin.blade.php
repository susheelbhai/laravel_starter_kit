<x-mail::message>
# New Product Enquiry Received

Dear Admin,

You have received a new product enquiry from your website.

<x-mail::panel>
**Product:** {{ $data->product->title }}  
**Name:** {{ $data->name }}  
**Email:** {{ $data->email }}  
@if ($data->phone)
**Phone:** {{ $data->phone }}  
@endif
</x-mail::panel>

## Message
{{ $data->message ?? 'No message provided.' }}

<x-mail::button :url="route('admin.productEnquiry.show', $data->id)">
View Enquiry Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
