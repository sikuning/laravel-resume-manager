@extends('frontend.layout')
@section('title',$page->page_title.' : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') {{$page->page_title}} @endslot
    @slot('active') {{$page->page_title}}  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        <div class="col-12">
            {!!htmlspecialchars_decode($page->description)!!}
        </div>
    </div>
</div>
@endsection