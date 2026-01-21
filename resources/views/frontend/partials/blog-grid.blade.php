@foreach($blogs as $post)
<div class="col-md-4">
    <div class="blog-box">
        @if($post->image != '')
        <img src="{{asset('public/blog/'.$post->image)}}" alt="">
        @else
        <img src="{{asset('public/blog/default.png')}}" alt="">
        @endif
        <div class="blog-content">
            <span class="blog-category"><a href="{{url('blog/c/'.$post->blog_category->slug)}}">{{$post->blog_category->title}}</a></span>
            <h3><a href="{{url('blog/'.$post->slug)}}">{{substr($post->title,0,50).'...'}}</a></h3>
            <p>{{substr($post->short_desc,0,70).'...'}}</p>
        </div>
    </div>
</div>
@endforeach