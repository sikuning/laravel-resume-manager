<section id="service-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 section-head text-center">
                <h2>What i do?</h2>
                <h3>How i can help your next project</h3>
            </div>
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="service-box">
                    @if($service->image != '')
                    <img src="{{asset('public/user_service/'.$service->image)}}" alt="">
                    @else
                    <img src="{{asset('public/user_service/default.png')}}" alt="">
                    @endif
                    <h4>{{$service->title}}</h4>
                    <p>{{$service->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>