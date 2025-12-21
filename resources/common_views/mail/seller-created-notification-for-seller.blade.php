<x-mail::message>
# Congratulations! Your seller account has been created successfully.

Dear Seller,

Following are your account details:
<x-mail::panel>
**Name:** {{ $data->name }}  
**Email:** {{ $data->email }}  
@if ($data->phone)
**Phone:** {{ $data->phone }}  
@endif

</x-mail::panel>



<x-mail::button :url="route('seller.dashboard') ">
Dashboardf {{ $data->name }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
