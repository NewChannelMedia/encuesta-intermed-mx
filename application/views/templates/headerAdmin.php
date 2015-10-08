<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?echo base_url(); ?>css/encuesta.css">
    <link rel="stylesheet" type="text/css" href="<?echo base_url(); ?>fonts/fonts.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index flamaBook-Normal">
  <nav class="navbar navbar-inverse navbar-static-top no-margin">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed nav-btn-toggle" id="menu-toggle">
        <span class="glyphicon glyphicon-menu-hamburger nav-icon" aria-hidden="true"></span>
      </button>
      <div class="collapse navbar-collapse pull-left nav-btn" id="bs-example-navbar-collapse-1">
        <span class="navbar-toggle collapse in glyphicon glyphicon-menu-hamburger nav-icon" data-toggle="collapse" id="menu-toggle-2"></span>
      </div>
      <a href="" class="navbar-brand">Encuesta Intermed</a>
    </div>
  </nav>
  <div id="wrapper">
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
        <li class="active">
          <a href="#"><span class="glyphicon glyphicon-dashboard nav-icon"></span> Dashboard</a>
        </li>
        <li>
          <a href="#"><span class="glyphicon glyphicon-list-alt nav-icon"></span> Solicitudes</a>
          <ul class="nav-pills nav-stacked secondLevel-ul">
            <li>
              <a href="#">test</a>
            </li>
            <li>
              <a href="#">test</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><span class="glyphicon glyphicon-signal nav-icon"></span> Resultados</a>
          <ul class="nav-pills nav-stacked secondLevel-ul">
            <li>
              <a href="#">test</a>
            </li>
            <li>
              <a href="#">test</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><span class="glyphicon glyphicon-plus nav-icon"></span> Añadir preguntas</a>
        </li>
        <li>
          <a href="#"><span class="glyphicon glyphicon-log-out nav-icon"></span> salir</a>
        </li>
      </ul>
    </div>

  <nav class="navbar navbar-inverse navbar-static-top hidden invisible" role="navigation" style="margin-bottom: 0">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" >
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Encuestas Intermed</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="#" class="uppr"><?= $administrador; ?></a>
        </li>
      </ul>
    </div>
    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a href="<?= base_url() ?>admin/control2"><span class="glyphicon glyphicon-list-alt"></span> Dashboard</a>
          </li>
          <li>
            <a href="#">Solcitudes<span class="glyphicon glyphicon-chevron-down arrow"></span></a>
            <ul class="nav nav-second-level">
              <li><a href="#" id="pAceptar">Por aceptar</a></li>
              <li><a href="#" id="nAceptar">No aceptados</a></li>
              <li><a href="#" id="paceptados">aceptados</a></li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#">Resultados<span class="glyphicon glyphicon-chevron-down arrow"></span></a>
            <ul class="nav nav-second-level">
              <li><a href="#">Individuales</a></li>
              <li><a href="#">Cross Reference</a></li>
            </ul>
          </li>
          <li>
            <a href="grid.html">Config</a>
          </li>
          <li>
            <a href="#">Salir</a>
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
  </nav>
  <div id="page-content-wrapper">
    <!-- Aqui empieza el body de la pagina -->
