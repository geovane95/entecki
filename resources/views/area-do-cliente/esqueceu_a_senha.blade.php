@extends('area-do-cliente.template.template')
@section('miolo')

    <!-- MIOLO -->
    <section class="miolo-login">
        <div class="container">
             <div class="row">
                 <div class="col-lg-4 offset-lg-4">
                     @if (session('status'))
                         <div class="alert alert-success">
                             {{ session('status') }}
                         </div>
                     @endif
                     <form class="login" action="{{ route('password.email') }}" method="post">
                        <h1>
                            Esqueceu a senha?
                        </h1>
                        <p>
                            Digite seu endereço de e-mail. Você receberá um link para criar uma nova senha via e-mail.
                        </p>
                         @csrf
                        <label>
                            Usuário/E-mail
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="seuemail@domain.com" required autocomplete="email" autofocus>
                        </label>
                         @if ($errors->has('email'))
                             <div class="invalid-feedback">
                                 {{ $errors->first('email') }}
                             </div>
                         @endif
                        <button type="submit">
                            Obter nova senha
                        </button>
                     </form>
                 </div>
             </div>
        </div>
    </section>
@stop
