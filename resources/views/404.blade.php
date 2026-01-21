@extends('frontend.layout')
@section('title','404')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') 404 @endslot
    @slot('active') 404  @endslot
@endcomponent
<div class="container py-5" id="main-content">
    <div class="row">   
        <div class="col-12 text-center">
            <h2 class="sub-heading">Page Not Found</h2>
        </div>
    </div>
</div>
@endsection