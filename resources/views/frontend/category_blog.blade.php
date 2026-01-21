@extends('frontend.layout')
@section('title',$category->title.' Blogs : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/','Blogs'=>'blog']])
    @slot('title') {{$category->title}} Blogs @endslot
    @slot('active') {{$category->slug}}  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        @include('frontend.partials.blog-grid')
    </div>
    <div class="row">
        <div class="col-md-12">
            {{$blogs->links()}}
        </div>
    </div>
</div>
@endsection