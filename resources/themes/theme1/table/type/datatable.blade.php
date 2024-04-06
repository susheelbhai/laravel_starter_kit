
<div class="row">
    
    <div class="col-12 py-3">
        <a href="{{ $addUrl }}" type="button" class="btn btn-primary"> <i class="fa fa-plus"></i>
            <span class="btn-icon-end"> Add New </span>
        </a>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $title }} </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        {{ $slot }}
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

