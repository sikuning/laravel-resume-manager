<section id="service-section" class="pt-5">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-lg-4 col-md-12">
                <span class="text-span">What i do</span>
            </div>
            <div class="col-lg-8 col-md-12 row">
                @foreach($services as $service)
                <div class="col-md-6">
                    <div class="service-box">
                        <h3><i class="{{$service->icon}}"></i> {{$service->title}}</h3>
                        <p>{{$service->description}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>