<x-admin.app-layout>


    <x-admin.table.table1 heading="All Link" :addUrl="route('admin.important_links.create')"  >

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Href</th>
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
                <td> {{ $i->href }} </td>
                <td> <img src="{{ asset('storage/common/images/important_link/').'/'.$i->image  }}" alt=""> </td>
                @if ($i->is_active == 1)
                <td> Active </td>
                @else
                <td> Not Active </td>
                @endif
                <td> <a href="{{ route('admin.important_links.show', $i->id) }}"> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>
    </x-admin.table.table1>

</x-admin.a-layout>