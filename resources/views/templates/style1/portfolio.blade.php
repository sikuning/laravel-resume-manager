<section id="portfolio-section" class="container-fluid py-5">
    <div class="row">
        <div class="col-12 section-head text-center">
            <h2>Porfolio</h2>
            <h3>Some of my most recent projects</h3>
        </div>
    </div>
    <div class="row">
        <div class="co-12 text-center mb-4">
            {{-- <ul class="portfolio-filter-list">
                <li><a href="">All</a></li>
                @foreach($portfolio_category as $cat)
                <li><a href="javascript:void(0);" data-filter="pro{{$cat->id}}">{{$cat->title}}</a></li>
                @endforeach
            </ul> --}}
        </div>
        @foreach($portfolios as $project)
        <div class="col-md-4">
            <a href="javascript:void(0);" data-id="{{$project->id}}" data-category="pro{{$project->category}}"  class="project-box">
                @if($project->image != '')
                <img src="{{asset('public/portfolio/'.$project->image)}}" alt="">
                @else
                <img src="{{asset('public/portfolio/default.png')}}" alt="">
                @endif
                <div class="content">
                    <h4>{{$project->title}}</h4>
                </div>
            </a>
        </div>
        @endforeach
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