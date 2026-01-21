<section id="testimonial-section" class="container py-5">
    <div class="row">
        <div class="col-12 section-head text-center">
            <h2>Client Speak</h2>
            <h3>What some of my clients say</h3>
        </div>
    </div>
    <div class="row">
        @foreach($testimonials as $row)
        <div class="col-md-6">
            <div class="testimonial-box">
                <p>{{$row->feedback}}</p>
                @if($row->client_image != '')
                <img src="{{asset('public/testimonial/'.$row->client_image)}}" alt="">
                @else
                <img src="{{asset('public/testimonial/default.png')}}" alt="">
                @endif
                <h4>{{$row->client_name}}</h4>
                <span>{{$row->client_designation}}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>