<section id="contact-section" class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h3>Let's get in touch</h3>
            <ul class="contact-info">
                <li>
                    <span><i class="fa fa-home"></i> Living at :</span>
                    {{$user->country}}
                </li>
                <li>
                    <span><i class="fa fa-envelope"></i> Email :</span>
                    {{$user->email}}
                </li>
                <li>
                    <span><i class="fa fa-phone"></i> Phone :</span>
                    {{$user->phone}}
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <form method="POST" id="saveContactMessage">
                @csrf
                <div class="form-gorup mb-3">
                    <label for="">What is your name :</label>
                    <input type="text" name="name" class="form-control"/>
                </div>
                <div class="form-gorup mb-3">
                    <label for="">Your Email Address :</label>
                    <input type="email" name="email" class="form-control"/>
                </div>
                <div class="form-gorup mb-3">
                    <label for="">Message :</label>
                    <textarea name="message" class="form-control" cols="30" rows="5"></textarea>
                    <input type="text" hidden name="user" value="{{$user->id}}">
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
            <div class="message mt-3"></div>
        </div>
    </div>
</section>