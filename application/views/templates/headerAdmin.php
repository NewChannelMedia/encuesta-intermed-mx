<?php
  if( !isset($_SESSION)){
    session_start();
    $_SESSION['user'] = "prueba";
  	$_SESSION['status'] = true;
  }
?>
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
      <a href="#" class="navbar-brand">Encuesta Intermed</a>
    </div>
  </nav>
  <div id="wrapper">
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav nav-stacked" id="menu">
        <li>
          <a href="<?= base_url() ?>admin/control"><span class="glyphicon glyphicon-dashboard nav-icon"></span> Dashboard</a>
        </li>
        <li>
          <a href="#"><span class="glyphicon glyphicon-stats nav-icon"></span> Resultados</a>
          <ul class="nav-pills nav-stacked secondLevel-ul">
            <li>
              <a href="#">Por Categorías</a>
            </li>
            <li>
              <a href="#">Cross Reference</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?= base_url() ?>admin/solicitudes"><span class="glyphicon glyphicon-list-alt nav-icon"></span> Solicitudes</a>
        </li>
        <li>
          <a href="<?= base_url();?>Admin/suscritos"><span class="glyphicon glyphicon-plus nav-icon"></span> Newsletter</a>
        </li>
        <li>
          <a href="<?= base_url();?>Admin/cerrar"><span class="glyphicon glyphicon-log-out nav-icon"></span> salir</a>
        </li>
      </ul>
    </div>
  <div id="page-content-wrapper">
    <!-- Aqui empieza el body de la pagina -->
