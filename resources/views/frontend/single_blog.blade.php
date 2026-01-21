@extends('frontend.layout')
@section('title',$blog->title.' : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/','Blogs'=>'blog',$blog->blog_category->title=>'blog/c/'.$blog->blog_category->slug]])
    @slot('title') {{$blog->title}} @endslot
    @slot('active') {{$blog->title}}  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="blog-box single">
                <img src="{{asset('public/blog/'.$blog->image)}}" alt="">
                <div class="blog-content">
                    <p>{!!htmlspecialchars_decode($blog->description)!!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sidebar-widget">
                <h4>Category</h4>
                <ul>
                    @foreach($categories as $category)
                    @if($category->blogs_count > 0)
                    <li><a href="{{url('blog/c/'.$category->slug)}}"><i class="fa fa-angle-right"></i> {{$category->title}}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="sidebar-widget">
                <h4>Latest Posts</h4>
                @foreach($latest as $row)
                <div class="blog-sidebar d-flex">
                    @if($row->image != '')
                    <img src="{{asset('public/blog/'.$row->image)}}" alt="{{$row->title}}">
                    @else
                    <img src="{{asset('public/blog/default.png')}}" alt="">
                    @endif
                    <div class="content flex-grow-1">
                        <h5><a href="{{url('blog/'.$row->slug)}}">{{substr($row->title,0,50).'...'}}</a></h5>
                        <a href="{{url('blog/'.$row->slug)}}">Show</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection