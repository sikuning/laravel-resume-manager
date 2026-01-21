<section id="experience-section" class="container py-5">
    <div class="row">
        <div class="col-12 section-head text-center">
            <h3>My Experience</h3>
        </div>
        <div class="col-12 experience-list">
            @foreach($experience as $exp)
            <div class="experience-box">
                <span class="designation">{{$exp->designation}}</span>
                <span class="company">{{$exp->company}}</span>
                <span class="duration">{{date('M, Y',strtotime($exp->from_year))}} - {{($exp->to_year == 'current') ? 'current' : date('M, Y',strtotime($exp->to_year))}}</span>
                <p>{{$exp->description}}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>