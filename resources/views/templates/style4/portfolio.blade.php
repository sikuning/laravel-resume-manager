<section id="portfolio-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head">
                    <h3>Latest Works</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($portfolios as $portfolio)
            <div class="col-md-4">
                <a href="javascript:void(0);" class="d-block portfolio-box project-box" data-category="{{$portfolio->category}}" data-id="{{$portfolio->id}}">
                    @if($portfolio->image != '')
                        <img src="{{asset('public/portfolio/'.$portfolio->image)}}" alt="">
                        @else
                        <img src="{{asset('public/portfolio/default.png')}}" alt="">
                        @endif
                    <div class="content">
                        <h4>{{$portfolio->title}}</h4>
                        <span>{{$portfolio->cat_name->title}}</span>
                    </div>
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