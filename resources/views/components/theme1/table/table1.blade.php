@props(['heading', 'search', 'para', 'addUrl'])

<style>
    .right_div{text-align: right; display: inline;}
    .table_heading{text-align: left; display: inline;}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title table_heading">{{ $heading }}</h4>
                
                @if(isset($search)) 
                <div class="right_div">
                    <form action="" method="get">
                        <input type="text" name="search" value="{{ request()->search }}">
                        <button type="submit"><i class="fas fa-search"></i> </button>
                    </form>
                </div>
                @endif
                @if(isset($addUrl)) 
                <div class="right_div">
                    <a class="btn btn-primary" href="{{ $addUrl }}"> Add New </a>
                </div>
                @endif
                @if(isset($para)) {{ $para }} @endif
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0">

                        <thead>
                            @if(isset($thead)) {{ $thead }} @endif
                        </thead>
                        <tbody>
                            @if(isset($tbody)) {{ $tbody }} @endif
                        </tbody>
                    </table>
                </div>

                @if(isset($paginate)) {{ $paginate }} @endif


            </div>
        </div>
    </div>
</div>