@props(['heading', 'details'])

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }}</h4>
    
                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav-justified">
                        @foreach ($details as $key => $i)
                        <li class="nav-item">
                            <a href="#progress{{$i['id']}}" class="nav-link" data-toggle="tab">
                                <span class="step-number"> {{ $i['id'] }}</span>
                                <span class="step-title">{{ $i['name'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
    
                    <div id="bar" class="progress mt-4">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                    </div>
                <form method="POST" novalidate action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    {{ $slot }}
                    <div class="tab-content twitter-bs-wizard-tab-content">

                        @foreach ($details as $key => $i)
                        <div class="tab-pane" id="progress{{ $i['id'] }}">
                            <div>
                                <div class="row">
                                    @if (isset($i['form']))
                                    @foreach ($i['form'] as $j)
                                    <div class="col-lg-6">
                                        {{-- <x-partner.form.input1 name="{{ $j['name'] }}" lbl="{{ $j['lbl'] }}" :value="$j['value'] ?? ''" /> --}}
                                        @if (isset($j['image']))
                                            <x-partner.form.input-img1 name="{{ $j['name'] }}" lbl="{{ $j['lbl'] }}" type="file" value="{{ $j['value'] ?? '' }}" />
                                        @elseif(isset($j['options']))
                                            <x-partner.form.input1 name="{{ $j['name'] }}" lbl="{{ $j['lbl'] }}" value="{{ $j['value'] ?? '' }}" type="select" :options="$j['options']" required="{{ $required ?? ''}}"  />
                                        @else
                                            <x-partner.form.input1 name="{{ $j['name'] }}" lbl="{{ $j['lbl'] }}" type="{{ $j['type'] ?? 'text' }}" value="{{ $j['value'] ?? '' }}" />
                                        @endif 
                                    </div>
                                    @endforeach
                                    @endif

                                    @if (isset($i['complete']))
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                            </div>
                                            <div>
                                                <h5>Confirm Detail</h5>
                                                <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                            </div>
                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    
                                </div>
    
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="tab-pane" id="progress-confirm-detail">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                        </div>
                                        <div>
                                            <h5>Confirm Detail</h5>
                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                        <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                        <li class="next"><a href="javascript: void(0);">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>