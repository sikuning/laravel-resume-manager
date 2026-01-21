<section id="skill-section" class="container py-5">
            <div class="row">
                <div class="col-12 section-head">
                    <h3>My Skills</h3>
                </div>
                @foreach($skills as $skill)
                <div class="col-md-6 skill-box">
                    <span>{{$skill->title}}</span>
                    <div class="range">
                        <div class="range-slide" style="width:{{$skill->percent}}%;"></div>
                        <div class="range-handle" style="left:{{$skill->percent}}%;"></div>
                    </div>
                    <p>{{$skill->percent}}%</p>
                </div>
                @endforeach
            </div>
        </section>