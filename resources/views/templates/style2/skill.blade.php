<section id="skill-section" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-head">
                    <h2>About Me</h2>
                </div>
                <ul class="skill-list">
                    @foreach($skills as $skill)
                    <li>{{$skill->title}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <p>{{$user->about_me}}</p>
            </div>
        </div>
    </div>
</section>