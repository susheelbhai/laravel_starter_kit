<div class="row">

    <style>
        .form-search {
            background: #fff;
            border: 0.0625rem solid #d2d2d2;
            padding: 0.3125rem 1.25rem;
            color: #6e6e6e;
            height: 2.8rem;
            border-radius: 1rem;
        }
    </style>
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
                    @if ($inputName != '')
                        <input type="text" wire:model.live="{{ $inputName }}" class="form-search"
                            placeholder="Search">
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        {{ $slot }}

                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $data2->links() }}
            </div>
        </div>
    </div>

</div>
