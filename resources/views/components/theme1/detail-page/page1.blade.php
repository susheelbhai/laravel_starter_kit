@props(['heading', 'search', 'para', 'addUrl'])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title table_heading">{{ $heading }}</h4>
                
                @if(isset($para)) {{ $para }} @endif
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                        @foreach ($details as $key => $i)
                        @if (isset($i['name']))
                            <tr class="bg-light">
                                <td colspan="2"> {{ $i['name'] }} </td>
                            </tr>
                            @endif
                                    @if (isset($i['data']))
                                    @foreach ($i['data'] as $j)
                                    <tr>
                                        <td> {{ $j['name'] }} </td>
                                        <td> 
                                            @if (isset($j['icon']))
                                                <i class="{{ $j['value'] }}"></i>
                                            @elseif (isset($j['image']))
                                                <img src="{{ $j['value'] }}" alt="" style="max-height: 120px; max-width:240px" >
                                            @else
                                                {{ $j['value'] }}
                                            @endif    
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                    @endif
                                   
                        @endforeach
                        @if(isset($footer)) {{ $footer }} @endif
    
                    </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>