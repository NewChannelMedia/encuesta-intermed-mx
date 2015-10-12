<!-- Navigation -->
<nav class="navbar navbar-default navbarMain2 Flama">
  <div class="navcontainer container">
    <div class="row upper-row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 logo text-center">
        <a class="page-scroll" href="#page-top">
          <img class="center-block" src="<?=base_url()?>img/logos/intermedWhite.png">
        </a>
      </div>
    </div>
  </div>
</nav>
<section class="main2">
  <div class="main-body-intern2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <?php if ($status != 0){ ?>
            <h1 class="Flama-Bold s35 text-center white shadow"><strong>¡Gracias por tu colaboración!</strong></h1>
            <div class="row message-container">
              <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
                <p class="Flama-normal s15 white text-center">
                  ¡En agradecimiento a tu apoyo, Intermed® te regala 3 meses<br>
                  de suscripción a su servicio!<br>
                  Registrate en nuestra lista de espera para recibir tu código de invitación<br>
                  en nuestra fecha de lanzamiento.
                </p>
                <p class="s15 white text-center">
                  <label class="col-md-12">
                    <input type="checkbox" id="invitacion" value="si" onchange="aceptarPromocion()">
                    Quiero formar parte del grupo de pruebas beta del proyecto.
                  </label>
                  <label class="col-md-12">
                    <input type="checkbox" id="promo" value="si" onchange="aceptarPromocion()">
                    Deseo recibir correos y promociones por parte de Intermed.
                  </label>
                </p>

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-offset-1">
                <div id="contenido"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-offset-1">
                <a href="<?= base_url() ?>" class="btn btn-danger btn-lg btn-block">Regresar</a>
              </div>
            </div>
          <?php } else {?>
            <?php echo $error ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main3-bg"></div>
