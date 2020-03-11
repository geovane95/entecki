<h2>Projeto Entecki</h2>

<h4>Instalar o Projeto</h4>


<pre>git clone git@github.com:klzchz/enteck.git</pre>


<h4>Instalar o Composer</h4>


<pre>composer install</pre>



<h4>Setar o Env File</h4>


<pre>cp .env.example .env</pre>
<pre>php artisan key:generate</pre>
<small>Colocar as configurações de ambiente e banco de dados no env</small>


<h4>Rodar as migrations</h4>

<pre>php artisan migrate</pre>