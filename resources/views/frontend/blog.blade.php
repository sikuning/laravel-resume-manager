@extends('frontend.layout')
@section('title','Blog : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Blogs @endslot
    @slot('active') Blog  @endslot
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