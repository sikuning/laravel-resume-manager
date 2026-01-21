<section id="experience-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 section-head d-flex justify-content-between">
                <h2>Experience</h2>
            </div>
            <div class="row">
                @foreach($experience as $exp)
                <div class="col-md-6 experience-box">
                    <span class="designation">{{$exp->designation}}</span>
                    <span class="company">{{$exp->company}}</span>
                    <span class="duration">{{date('M, Y',strtotime($exp->from_year))}} - {{($exp->to_year == 'current') ? 'current' : date('M, Y',strtotime($exp->to_year))}}</span>
                    <p>{{$exp->description}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>