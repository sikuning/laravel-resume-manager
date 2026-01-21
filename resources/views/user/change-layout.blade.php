@extends('user.layout')
@section('title','Layouts : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Layouts @endslot
          @slot('add_btn')  @endslot
        @slot('active') Layouts  @endslot
    @endcomponent
    <!-- /.content-header -->
    <section class="content card">
        <div class="container-fluid card-body">
            <!-- form start -->
            <form class="form-horizontal" id="changeLayout"  method="POST">
                @csrf
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Available Layouts</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    @for($i=0;$i<$layout_count;$i++)
                                    @php $checked = ('style'.$i+1 == $user_layout) ? 'checked' : '';  @endphp
                                    <div class="form-group layout-box">
                                        <input type="radio" name="layout" class="select-layout" id="layout{{$i+1}}" value="style{{$i+1}}" {{$checked}}>
                                        <label for="layout{{$i+1}}">
                                            <img src="{{asset('public/layouts/layout'.($i+1).'.jpg')}}" class="w-100" alt="">
                                        </label>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col -->
                </div>
                <!-- /.row -->
            </form> <!-- /.form start -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    
    
</div>
@stop

@section('pageJsScripts')

@stop