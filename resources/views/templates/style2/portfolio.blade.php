<section id="portfolio-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 section-head d-flex justify-content-between">
                <h2>Portfolio</h2>
                {{-- <ul class="align-self-center">
                    <li><a href="javascript:void(0);" class="active">All</a></li>
                    @foreach($portfolio_category as $cat)
                    @if($cat->posts_count > 0)
                    <li><a href="javascript:void(0)" data-filter="{{$cat->id}}">{{$cat->title}}</a></li>
                    @endif
                    @endforeach
                </ul> --}}
            </div>
        </div>
        <div class="row porject-list">
            @foreach($portfolios as $project)
            <a href="javascript:void(0);" data-category="{{$project->category}}"  class="col-md-4 project-box" data-id="{{$project->id}}">
                @if($project->image != '')
                <img src="{{asset('public/portfolio/'.$project->image)}}" alt="">
                @else
                <img src="{{asset('public/portfolio/default.png')}}" alt="">
                @endif
            </a>
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