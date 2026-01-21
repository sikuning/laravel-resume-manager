<section id="experience-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>Experience</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($experience as $row)
            <div class="col-md-6">
                <div class="experience-box">
                    <h4>{{$row->designation}}</h4>
                    <span class="company">{{$row->company}}</span>
                    <span>{{date('M, Y',strtotime($row->from_year))}} - {{($row->to_year == 'current') ? 'current' : date('M, Y',strtotime($row->to_year))}}</span>
                    <p>{{$row->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>