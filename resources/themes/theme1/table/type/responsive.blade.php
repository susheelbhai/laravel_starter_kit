<div class="row">
    @if ($addUrl != '#')
        <div class="col-12 py-3">
            <a href="{{ $addUrl }}" type="button" class="btn btn-primary"> <i class="fa fa-plus"></i>
                <span class="btn-icon-end"> Add New </span>
            </a>
        </div>
    @endif
    
    <div class="col-lg-12">
        <div class="card">
            <div class="cardhead">
                <div class="card-header">
                    <h5 class="card-title">{{ $title }}</h5>
                    {{ $status ?? '' }}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        {{ $slot }}
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
