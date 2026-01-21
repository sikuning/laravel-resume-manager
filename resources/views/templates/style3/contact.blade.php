<section id="contact-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <span class="text-span">Let's Work Together</span>
                <h2>Get in Touch</h2>
            </div>
            <div class="col-md-4">
                <span class="text-span">Email Me</span>
                <span class="footer-email">{{$user->email}}</span>
            </div>
            <div class="col-md-3">
                <span class="text-span">Find Me</span>
                <ul class="footer-social">
                    @foreach($social_links as $social)
                        <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>