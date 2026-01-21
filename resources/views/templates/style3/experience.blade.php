<section id="experience-section" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Experience</h2>
            </div>
            <div class="row">
                @foreach($experience as $exp)
                <div class="col-md-6">
                <div class="experience-box">
                    <span class="designation">{{$exp->designation}}</span>
                    <span class="company">{{$exp->company}}</span>
                    <span class="duration">{{date('M, Y',strtotime($exp->from_year))}} - {{($exp->to_year == 'current') ? 'current' : date('M, Y',strtotime($exp->to_year))}}</span>
                    <p>{{$exp->description}}</p>
                </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>