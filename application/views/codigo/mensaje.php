<!-- Navigation -->
<nav class="navbar navbar-default navbarMain flama">
  <div class="navcontainer container">
    <div class="row upper-row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo text-left">
        <a class="page-scroll" href="#page-top">
          <img class="center-block" src="<?=base_url()?>img/logos/intermedWhite.png">
        </a>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 texts text-right hidden-xs">
        <img class="center-block" src="<?=base_url()?>img/textos-top.png"></a>
      </div>
    </div>
  </div>
</nav>
<section class="main2">
  <div class="main-body-intern">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-1">
          <div class="row">
            <div class="mensaje flama s20 white col-md-10 col-md-offset-1">
              <h1 class="flama s40 white text-left">¡Gracias!</h1>
              <?php if( $medico == "0"){ ?>
                <p>Hola <strong><?php echo $nombre ?></strong><br />
                  Tu solicitud será procesada por nuestro equipo de trabajo.<br>
                  En unos días recibirás a tu correo: <strong><?php echo $correo ?></strong> nuestra respuesta a tu solicitud.<br>
                  Queremos pedirte paciencia en este proceso, y te agradecemos tu interés en nosotros.
                </p>
              <?php } else { ?>
                <p>
                  Estimado <strong>Dr. <?php echo $nombre ?></strong><br>
                  Tu solicitud será procesada por nuestro equipo de trabajo junto con tu cedula: <strong><?php echo $cedula ?></strong>.<br>
                  En unos días recibirás a tu correo: <strong><?php echo $correo ?></strong> nuestra respuesta a tu solicitud.<br>
                  Queremos pedirte paciencia en este proceso, y te agradecemos tu interés en nosotros.
                </p>
              <?php } ?>
              <h1 class="flama s40 white text-right">¡Hasta pronto!</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
        </br><a href="<?echo base_url();; ?>" class="btn btn-info btn-lg btn-block">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main2-bg"></div>
