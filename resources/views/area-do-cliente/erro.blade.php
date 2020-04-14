@extends('area-do-cliente.template.template')
@section('miolo')

    <section class="miolo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>
                        ERRO
                    </h1>
                    <h5>
                        <strong>
                            {{ $error }} <br>
                        </strong>
                    </h5>
                    <h6>
                        Você tentar voltar ao inicio <a href="{{ route('client-space.index') }}">clicando aqui</a>
                        ou
                        <a href="{{ $error == 'inicio' ? route('client-space.index') : route('client-space.logout') }}">Clique
                            aqui para ser redirecionado.</a>
                    </h6>


                </div>
            </div>
        </div>
    </section>
@stop
