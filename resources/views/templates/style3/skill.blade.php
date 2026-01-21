<section id="skill-section" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <span class="text-span">My Skills</span>
            </div>
            <div class="col-lg-8 col-md-12 row">
                @foreach($skills as $skill)
                <div class="col-md-6">
                    <div class="skill-box">
                        <h3>{{$skill->title}}</h3>
                        <p>{{$skill->percent}}%</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>