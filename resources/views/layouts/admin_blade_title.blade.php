<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
                <h1>{{$title ?? ''}}</h1>
            </div>
                <div class="col-sm-4 text-center">
                    @if( ! empty($link) )
                        <a href="{{ $link }}" class="btn btn-outline-success">{{ __($text ) }}</a>
                    @endif
                </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{$title ?? ''}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
