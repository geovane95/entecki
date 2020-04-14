<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{asset('css/style.scss')}}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @yield('adminlte_css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

@if(! config('adminlte.enabled_laravel_mix'))

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<script src="{{url('js/axios.js')}}"></script>
<script src="{{url('js/jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>




@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')
@else
<script src="{{ asset('js/app.js') }}"></script>
@endif


<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style type="text/css">
    body {
    font-family: 'Roboto', sans-serif;
}
div#tabeladiv h3,
.content-header h1 {
    text-transform: uppercase;
    font-weight: bold;
    color: #00205c;
}
div#tabeladiv h3{
    margin-top: 30px;
}
.card-header .btn-info,
.card-header .btn-success,
.bg-info {
    background-color: #b09700 !important;
    border-color:  #b09700 !important;
    text-transform: uppercase;
    font-weight: 500;
}
#table_uploads .btn-info:hover,
.btn-success:hover,
.btn-warning:hover,
.btn-danger:hover,
.btn-primary:hover,
.card-header .btn-info:hover,
.card-header .btn-success:hover{
    opacity: .9;
}
#table_uploads .btn-info,
.btn-success,
.btn-danger,
.btn-warning,
.btn-primary,
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
  background-color:#00205c  !important;
  border-color:  #00205c !important;
  cursor: pointer !important;
  color: #fff !important;
    text-transform: uppercase;
    font-weight: 500;
}
.table .thead-dark th{
    background-color:  #00205c !important;
    border-color: rgba(255,255,255,.2) !important;
}
table#table_uploads td{
    border-color: rgba(255,255,255,1) !important;
}
table#table_uploads .even td{
    border-color: rgba(0,0,0,.05) !important;
}
table#table_uploads {
    border-collapse: collapse;
}

#table_uploads .btn-info + .btn-info{
    margin-left: 10px;
}
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link {
    text-transform: uppercase;
    font-weight: 500;
}

.brand-link .brand-image {
    box-shadow: none !important;
    border-radius: 0;
    opacity: 1 !important;
    float: none !important;

}
</style>
</body>
</html>
