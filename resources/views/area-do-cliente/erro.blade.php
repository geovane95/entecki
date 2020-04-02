@extends('area-do-cliente.template.template')
@section('miolo')

    <section class="miolo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>
                        ERRO
                    </h1>
                    <h4>
                        <strong>
                            {{ $error }} <br>
                        </strong>
                        <a href="{{ $error == 'inicio' ? route('client-space.index') : route('client-space.logout') }}">Clique aqui para ser redirecionado.</a>
                    </h4>

                </div>
            </div>
        </div>
    </section>
@stop
