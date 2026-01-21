<section id="service-section" class="gray-background py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>My Services</h3>
                </div>
            </div>
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="service-box">
                    <i class="{{$service->icon}}"></i>
                    <h4>{{$service->title}}</h4>
                    <p>{{$service->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>