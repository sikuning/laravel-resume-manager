@if($project)
<div class="project-modal-box d-flex flex-row">
    @if($project->image != '')
        <img src="{{asset('public/portfolio/'.$project->image)}}" alt="">
    @else
        <img src="{{asset('public/portfolio/default.png')}}" alt="">
    @endif
    <div class="content">
        <h4>{{$project->title}}</h4>
        <p>{{$project->description}}</p>
        @if($project->link != '')
        <a href="{{$project->link}}" target="_blank" class="btn">View Project</a>
        @endif
    </div>
</div>
@else
    <div>No Content Found.</div>
@endif