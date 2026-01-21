<section id="testimonial-section" class="py-5 gray-background">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>Testimonials</h3>
                </div>
            </div>
        </div>
        <div class="owl-carousel testimonial-carousel">
            @foreach($testimonials as $row)
            <div class="item">
                <div class="testimonial-box">
                    <div class="testimonial-img">
                        @if($row->client_image != '')
                        <img src="{{asset('public/testimonial/'.$row->client_image)}}" alt="">
                        @else
                        <img src="{{asset('public/testimonial/default.png')}}" alt="">
                        @endif
                    </div>
                    <div class="content">
                        <p>{{$row->feedback}}</p>
                        <h5>{{$row->client_name}}</h5>
                        <span>{{$row->client_designation}}</span>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>