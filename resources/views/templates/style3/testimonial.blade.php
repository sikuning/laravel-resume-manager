<section id="testimonial-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <h2>Reviews</h2>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="owl-carousel testimonial-carousel">
                    @foreach($testimonials as $row)
                    <div class="item">
                        <div class="testimonial-box">
                            <h3>"</h3>
                            <p>{{$row->feedback}}</p>
                            <span>- {{$row->client_name}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>