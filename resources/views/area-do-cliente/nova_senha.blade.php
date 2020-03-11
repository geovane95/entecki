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
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

    <script src="https://use.fontawesome.com/6c10f0500f.js"></script>

    <!--CSS geral-->
    <link rel="stylesheet" href="stylesheets/geral.css"/>
</head>

<body>
    <!-- HEADER -->
    <header class="site-header">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="branding">
                <a href="https://entecki.com.br/" class="custom-logo-link" rel="home">
                    <img width="285" height="54" src="images/entecki.svg" class="custom-logo" alt="Entecki">
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
                    <a href="{{ route('area-do-cliente') }}" target="_blank" class="btn-area">
                        Área do Cliente
                    </a>
                    <a href="esqueceu_a_senha.blade.php" class="forget">
                        Esqueceu a senha?
                    </a>
                </div>
                <form action="https://entecki.com.br/" role="search" method="get" class="search-form">
                    <input type="text" name="s" id="search" value="" placeholder="O que você procura?">
                    <button><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </header>



    <!-- MIOLO -->
    <section class="miolo-login">
        <div class="container">
             <div class="row">
                 <div class="col-lg-4 offset-lg-4">
                     <form class="login">
                        <h1>
                            Esqueceu a senha?
                        </h1>
                        <p>
                            Cadastre sua nova senha abaixo.
                        </p>
                        <label>
                            Nova senha
                            <input type="password" name="">
                        </label>
                        <label>
                            Confirmar nova senha
                            <input type="password" name="">
                        </label>
                        <button>
                            Alterar senha
                        </button>
                     </form>
                 </div>
             </div>
        </div>
    </section>


    <!--FOOTER -->
    <footer>
        <div class="container">
            <address>R. Borges de Figueiredo, 303 CJ 404 São Paulo – SP | CEP 03110-010</address>
            <p><a href="mailto:entecki@entecki.com.br">entecki@entecki.com.br</a> | + 55 11 2157-1889</p>
        </div>
    </footer>
    <!--FOOTER / END -->


    <!-- JS PLUGINS -->

    <script type="text/javascript" src="javascripts/custom.js">
    </script>



    <!-- SCRIPTS / END -->


    <!-- GOOGLE ANALYTICS -->


    <!--GOOGLE ANALYTICS / END-->

</body>

</html>

