@extends('area-do-cliente.template.template')
@section('miolo')


<!-- MIOLO -->
<section class="miolo-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form class="login" action="{{ route('password.update') }}" method="post">
                    <h1>
                        Esqueceu a senha?
                    </h1>
                    <p>
                        Cadastre sua nova senha abaixo.
                    </p>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <label>
                        E-mail
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                               autocomplete="email" autofocus>
                    </label>
                    @if ($errors->has('email'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                    <label>
                        Nova senha
                        <input id="password" type="password" name="password" required autocomplete="new-password">
                    </label>
                    @if ($errors->has('password'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                    <label>
                        Confirmar nova senha
                        <input id="password-confirm" type="password" name="password_confirmation" required
                               autocomplete="new-password">
                    </label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                    @endif
                    <button type="submit">
                        Alterar senha
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@stop
