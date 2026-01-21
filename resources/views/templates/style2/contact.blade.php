<section id="contact-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 section-head d-flex justify-content-between">
                <h2>Contact Me</h2>
            </div>
            <div class="col-md-6">
                <form method="POST" id="saveContactMessage">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" paceholder="Your Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" paceholder="Your Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Message</label>
                        <textarea name="message" class="form-control" placeholder="Message"></textarea>
                        <input type="text" hidden name="user" value="{{$user->id}}">
                    </div>
                    <input type="submit" class="btn">
                </form>
                <div class="message mt-3"></div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>