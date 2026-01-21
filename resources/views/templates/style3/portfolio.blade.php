<section id="portfolio-section" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="text-span">MY Portfolio</span>
                <h2 class="mb-5">Latest Projects</h2>
            </div>
        </div>
        <div class="row">
            @foreach($portfolios as $project)
            <div class="col-md-4 offset-md-1">
                <a href="javascript:void(0);" class="d-block portfolio-box project-box" data-category="{{$project->category}}" data-id="{{$project->id}}">
                    <div class="portfolio-img">
                        @if($project->image != '')
                        <img src="{{asset('public/portfolio/'.$project->image)}}" alt="">
                        @else
                        <img src="{{asset('public/portfolio/default.png')}}" alt="">
                        @endif
                    </div>
                    <h3>{{$project->title}}</h3>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="modal" tabindex="-1" id="projectModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
</div>