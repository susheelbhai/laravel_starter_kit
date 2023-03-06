<x-partner-layout>


    <x-partner.table.table1 heading="All Business" :addUrl="route('partner.business.create')"  >

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Business Name</th>
                <th> Logo</th>
                <th> Display Image</th>
                <th> Status </th>
                <th> View </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($data as $i)
            <tr>
                <th scope="row">1</th>
                <td>{{ $i->business_name }}</td>
                <td> <img src="{{ url('storage/business/images',$i->logo)  }}" alt="" width="40"> </td>
                <td> <img src="{{ url('storage/business/images',$i->display_img)  }}" alt="" width="200"> </td>
                @if ($i->is_approved == 1)
                <td> Approved </td>
                @else
                <td> Not Approved </td>
                @endif
                <td> <a href="{{ route('partner.business.show', $i->id) }}"> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>
    </x-partner.table.table1>

</x-partner-layout>