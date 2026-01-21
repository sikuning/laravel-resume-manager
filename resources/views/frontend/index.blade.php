@extends('frontend.layout')
@section('title','')
@section('content')
<section id="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7 d-flex flex-column">
                @if($banner->title != '')
                <h1 class="mt-auto">{{$banner->title}}</h1>
                @endif
                @if($banner->sub_title != '')
                <span class="mb-auto">{{$banner->sub_title}}</span>
                @endif
            </div>
            <div class="col-md-5">
                @if($banner->image != '')
                <img src="{{asset('public/banner/'.$banner->image)}}" class="w-100" alt="">
                @endif
            </div>
        </div>
    </div>
</section>
@php $i=1; @endphp
@foreach($services as $service)
<section class="service-section container py-5">
    <div class="row">
        @if($i%2 != 0)
        <div class="col-md-5">
            <img src="{{asset('public/admin_service/'.$service->image)}}" class="w-100" alt="">
        </div>
        <div class="col-md-7 d-flex flex-column">
            <h2 class="mt-auto">{{$service->title}}</h2>
            <p class="mb-auto">{{$service->description}}</p>
        </div>
        @else
        <div class="col-md-7 d-flex flex-column">
            <h2 class="mt-auto">{{$service->title}}</h2>
            <p class="mb-auto">{{$service->description}}</p>
        </div>
        <div class="col-md-5">
            <img src="{{asset('public/admin_service/'.$service->image)}}" class="w-100" alt="">
        </div>
        @endif
    </div>
</section>
@php $i++; @endphp
@endforeach
<section id="layouts-section" class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-head">Availabe Layouts</h2>
            </div>
            @for($i=1;$i<=$layouts_count;$i++)
            <div class="col-md-3 layout-box">
                <img src="{{asset('public/layouts/layout'.$i.'.jpg')}}" class="w-100" alt="">
            </div>
            @endfor
        </div>
    </div>
</section>
@if($blogs->isNotEmpty())
<section id="blog-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h2 class="section-head">Our Blog</h2>
            </div>
        </div>
        <div class="row">
            @include('frontend.partials.blog-grid')
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{url('blog')}}" class="show-more">Show More <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection