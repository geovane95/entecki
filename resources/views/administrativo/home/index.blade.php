@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        @can('administrativo')
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$user}}</h3>

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$construction}}</h3>

                    <p>Obras</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building"></i>
                </div>
                @can('administrativo')
                <a href="{{ route('construction.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>


    </div>

@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
