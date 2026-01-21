<section id="page-head" class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <h2>{{$title}}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    @foreach($breadcrumb as $key => $value)
                    <li class="breadcrumb-item"><a href="{{url($value)}}">{{$key}}</a></li>
                    @endforeach
                    <li class="breadcrumb-item active">{{$active}}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>