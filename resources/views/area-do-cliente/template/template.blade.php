<!DOCTYPE html>
<html  lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta name="description" content="Descrição">
    <meta name="keywords" content="palavras chave, separadas por virgula">
    <meta name="author" content="JuCamillo Web Co.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="revisit-after" content="1 days">
    <title>Entecki - Inteligência em gerenciamento, planejamento e gestão de obras</title>


    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

    <script src="https://use.fontawesome.com/6c10f0500f.js"></script>
    <script src="{{url('js/axios.js')}}"></script>
    <script src="{{url('js/jquery.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    @yield('style')
    <!--CSS geral-->
    <link rel="stylesheet" href="{{asset('css/geral.css')}}"/>
</head>

<body>
<!-- HEADER -->
<header class="site-header">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="branding">
            <a href="https://entecki.com.br/" class="custom-logo-link" rel="home">
                <img width="285" height="54" src="{{asset('images/entecki.svg')}}" class="custom-logo" alt="Entecki">
            </a>
        </div>
        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <div class="menu-principal-container">
                <ul id="primary-menu" class="menu nav-menu" aria-expanded="false">
                    <li>
                        <a href="https://entecki.com.br/" aria-current="page">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="https://entecki.com.br/empresa/">Empresa</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="https://entecki.com.br/empresa/#quem-somos">Quem Somos</a></li>
                            <li>
                                <a href="https://entecki.com.br/empresa/#missao-politica-de-qualidade">Missão/Política de Qualidade</a>
                            </li>
                            <li>
                                <a href="https://entecki.com.br/empresa/#valores">Valores</a>
                            </li>
                            <li>
                                <a href="https://entecki.com.br/empresa/#objetivos">Objetivos</a>
                            </li>
                            <li>
                                <a href="https://entecki.com.br/empresa/#resultados">Resultados</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="https://entecki.com.br/atuacao/">Atuação</a>
                    </li>
                    <li>
                        <a href="https://entecki.com.br/portfolio/">Portfolio</a></li>
                    <li  class="menu-item-has-children">
                        <a href="https://entecki.com.br/contato/">Contato</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="https://entecki.com.br/contato/#fale-conosco">Fale Conosco</a>
                            </li>
                            <li>
                                <a href="https://entecki.com.br/contato/#endereco">Endereço</a>
                            </li>
                            <li>
                                <a href="https://entecki.com.br/contato/#trabalhe-conosco">Trabalhe Conosco</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav><!-- #site-navigation -->
        <div class="right-content d-flex align-items-top">
            <div class="cliente d-flex flex-column justify-content-center align-items-center">
                <a href="{{ route('client-space.index') }}" target="_blank" class="btn-area">
                    Área do Cliente
                </a>
                <a href="{{ route('client-space.recover-password') }}" class="forget">
                    Esqueceu a senha?
                </a>
            </div>
            <form action="https://entecki.com.br/" role="search" method="get" class="search-form">
                <input type="text" name="s" id="search" value="" placeholder="O que você procura?">
                <button><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>

        <div class="title-print">
            <div class="h1">
                RELATÓRIO DE PERFORMANCE DE ENGENHARIA (RPE)
            </div>
            <div class="h2">
                INDICADORES DE OBRA
            </div>
        </div>
    </div>
</header>


@if(!Auth::guest())
<!--LOGGED INFO -->
<section class="logged-info">
    <div class="container-fluid">
        <div class="row d-flex justify-content-end align-items-center">
                <span class="col-auto">
                    Olá, {{ auth()->user()->name }}
                </span>
            <a href="{{ route('client-space.logout') }}" class="col-auto">
                Sair
            </a>
        </div>
    </div>
</section>
@endif


<!-- MIOLO -->
    @yield('miolo')

<!--FOOTER -->
<footer>
    <div class="container">
        <address>R. Borges de Figueiredo, 303 CJ 404 São Paulo – SP | CEP 03110-010</address>
        <p><a href="mailto:entecki@entecki.com.br">entecki@entecki.com.br</a> | + 55 11 2157-1889</p>
    </div>
</footer>
<!--FOOTER / END -->


<!-- JS PLUGINS -->
<script type="text/javascript" src="{{asset('js/custom.js')}}">
</script>

<!-- SCRIPTS / END -->


<!-- GOOGLE ANALYTICS -->


<!--GOOGLE ANALYTICS / END-->

</body>

</html>

