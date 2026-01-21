@extends('frontend.layout')
@section('title','Layouts : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Layouts @endslot
    @slot('active') Layouts  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        @for($i=1;$i<=$layouts_count;$i++)
        <div class="col-md-3 layout-box">
            <img src="{{asset('public/layouts/layout'.$i.'.jpg')}}" class="w-100" alt="">
        </div>
        @endfor
    </div>
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
</div>
@endsection