<section id="contact-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>Get in Touch</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="contact-form">
                    <h4>Say Something</h4>
                    <form method="POST" id="saveContactMessage" class="row">
                        @csrf
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name *">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email *">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Your Message *"></textarea>
                        </div>
                        <input type="text" hidden name="user" value="{{$user->id}}">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                        </div>
                    </form>
                    <div class="message mt-3"></div>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="contact-info">
                    <li class="d-flex">
                        <i class="fa fa-map-marker-alt"></i>
                        <div>
                            <h6>Address</h6>
                            <span>@if($user->city != '')
                                {{$user->city}}
                            @endif
                            @if($user->pincode != '')
                            -{{$user->pincode}},
                            @endif
                            @if($user->state != '')
                            {{$user->state}},
                            @endif {{$user->country}}</span>
                        </div>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <div>
                            <h6>Phone</h6>
                            <span>{{$user->phone}}</span>
                        </div>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-envelope"></i>
                        <div>
                            <h6>Email</h6>
                            <span>{{$user->email}}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>