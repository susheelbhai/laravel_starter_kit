<x-mail::message>
# New inquiry received

Dear Admin,

{{ $data['name'] }} has submitted new query.

Followings are the detail
<x-mail::table>
|                |                          |
| -------------- | :----------------------: |
| Name           | {{ $data['name'] }}      |
| Phone          | <a href="tel:{{ $data['phone'] }}">{{ $data['phone'] }}</a>     |
| Email          | <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>     |
| Subject        | {{ $data['subject'] }}   |
| Message        | {{ $data['message'] }}   |
</x-mail::table>

<x-mail::button :url="route('admin.userQuery.show',$data['id'])">
View Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
