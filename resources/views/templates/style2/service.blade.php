<section id="service-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 section-head">
                <h2>What i do?</h2>
            </div>
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="service-box">
                    @if($service->icon != '')
                    <i class="{{$service->icon}}"></i>
                    @endif
                    <h4>{{$service->title}}</h4>
                    <p>{{$service->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>