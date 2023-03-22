<x-admin.app-layout>
    <x-slot name="head">
        <title> All Testimonial | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    <x-admin.table.table1 heading="All Testimonials" :addUrl="route('admin.testimonial.create')"  >

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Desgnation</th>
                <th> Organisation </th>
                <th> Image </th>
                <th> Status </th>
                <th> View </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($data as $key => $i)
            <tr>
                <th scope="row">{{ $i->id }}</th>
                <td>{{ $i->name }}</td>
                <td> {{ $i->designation }} </td>
                <td> {{ $i->organisation }} </td>
                <td> <img src="{{ asset('storage/common/images/testimonials/').'/'.$i->image  }}" width="120px" alt=""> </td>
                @if ($i->is_active == 1)
                <td> Active </td>
                @else
                <td> Not Active </td>
                @endif
                <td> <a href="{{ route('admin.testimonial.show', $i->id) }}"> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>
    </x-admin.table.table1>

</x-admin.a-layout>