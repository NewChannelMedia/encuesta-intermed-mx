<?php
  if(!(isset($_SESSION) && isset($_SESSION['status']) && $_SESSION['status'] === true)){
    redirect(base_url().'admin');
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
    <link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/encuesta.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js">
    <link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="bodyAdmin" class="index flama-normal">
  <nav class="navbar navbar-inverse navbar-fixed-top no-margin">
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
      <ul class="nav nav-pills nav-stacked" id="menu">
        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'){ ?>
          <li>
            <a href="<?= base_url() ?>admin/control"><span class="glyphicon glyphicon-dashboard navicon"></span>Dashboard</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/resultados"><span class="glyphicon glyphicon-stats navicon"></span>Resultados</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/crossreference"><span class="glyphicon glyphicon-stats navicon"></span>Cross Reference</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/solicitudes"><span class="glyphicon glyphicon-list-alt navicon"></span>Solicitudes</a>
          </li>
          <li>
            <a href="<?= base_url();?>admin/suscritos"><span class="glyphicon glyphicon-plus navicon"></span>Newsletter</a>
          </li>
          <li>
            <a href="<?= base_url();?>admin/mensajes"><span class="glyphicon glyphicon-envelope navicon"></span>Mensajes</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/categorias"><span class="glyphicon glyphicon-wrench navicon"></span>Categorias</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/preguntas"><span class="glyphicon glyphicon-wrench navicon"></span>Preguntas</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/directorio"><span class="glyphicon glyphicon-user navicon"></span>Agregar a Directorio</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/registrados"><span class="glyphicon glyphicon-user navicon"></span>Registrados</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/llamadas"><span class="glyphicon glyphicon-user navicon"></span>Llamadas</a>
          </li>
          <li>
              <a href="<?= base_url() ?>admin/masivos"><span class="glyphicon glyphicon-comment navicon"></span>E-mail Masivos</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/anadirCapturista"><span class="glyphicon glyphicon-headphones navicon"></span>Añadir Capturista</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/statusCapturista"><span class="glyphicon glyphicon-headphones navicon"></span>Status Capturista</a>
          </li>
        <?php } elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'capturista'){ ?>
          <li>
            <a href="<?= base_url() ?>admin/directorio"><span class="glyphicon glyphicon-user navicon"></span>Directorio</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/llamadas"><span class="glyphicon glyphicon-earphone navicon"></span>Llamadas</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/registradosDelDia"><span class="glyphicon glyphicon-book navicon"></span>Registros del día</a>
          </li>
          <li>
            <a href="<?= base_url() ?>admin/revisados"><span class="glyphicon glyphicon-ok nav-icon"></span>Revisados</a>
          </li>
        <?php } ?>
        <li>
          <a href="<?= base_url();?>admin/cerrar"><span class="glyphicon glyphicon-log-out navicon"></span>Salir</a>
        </li>
      </ul>
    </div>
  <div id="page-content-wrapper">
    <!-- Aqui empieza el body de la pagina -->
  <div class="loader-container hidden">
    <div class="loader">
      <div class="spinner-loader">
        Loading…
      </div>
    </div>
  </div>
