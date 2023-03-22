<x-admin.app-layout>

    @php
        $details = [
            [
                // 'name'=> 'Company Details',
                'data'=> [
                    ['name'=>' Name', 'value'=> $data->name],
                    ['name'=>'Email', 'value'=> $data->email],
                    ['name'=>'phone', 'value'=> $data->phone],
                    ['name'=>'subject', 'value'=> $data->subject],
                    ['name'=>'message', 'value'=> $data->message],
                ]
            ],
        ];
    @endphp
    <x-admin.detail-page.page1 heading="View User Query" :details="$details" >

        <x-slot name="footer">
            <form action="{{ route('admin.userQuery.update', $data->id) }}" method="post">
                @method('patch')
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <tr>
                <td class=""> 
                    Status
                </td>
                <td>
                    <div class="row">
                        <div class="col col-6">
                            <select name="status" class="form-control">
                                <option value=""> Select Status *</option>
                                @foreach ($statuses as $i)
                                    <option value="{{ $i->id }}" @if($i->id == $data->status_id) selected @endif> {{ $i->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-6">
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>
                    
                </td>
                
            </tr>
            
            </form>
            
        </x-slot>
    </x-admin.detail-page.page1>

</x-admin-layout>
