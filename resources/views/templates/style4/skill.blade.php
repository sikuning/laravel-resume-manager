<section id="skill-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>My Skills</h3>
                </div>
            </div>
            @foreach($skills as $skill)
            <div class="col-md-6">
                <div class="skill-box">
                    <div class="d-flex justify-content-between">
                        <h5>{{$skill->title}}</h5>
                        <div class="range-value">{{$skill->percent}}%</div>
                    </div>
                    <div class="range-box">
                        <div class="range-fill" style="width:{{$skill->percent}}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>