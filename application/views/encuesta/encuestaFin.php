<!-- Navigation -->
<nav class="navbar navbar-default navbarMain2 flama-normal">
  <div class="navcontainer container">
    <div class="row upper-row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 logo text-center">
        <a class="page-scroll" href="<?=base_url()?>">
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
            <h1 class="flama-bold s35 text-center white-c shadow"><strong>¡Gracias por tu colaboración!</strong></h1>
            <div class="row message-container">
              <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
                <p class="flama s15 white-c text-center">
                  ¡En agradecimiento a tu apoyo, Intermed® te regala 3 meses<br>
                  de suscripción a su servicio!<br>
                  Registrate en nuestra lista de espera para recibir tu código de invitación<br>
                  en nuestra fecha de lanzamiento.
                </p>
                <p class="s15 white-c text-center">
                  <label class="col-md-12">
                    <input type="checkbox" id="pruebasCheck" value="si" onchange="aceptarNewsletter()">
                    Quiero formar parte del grupo de pruebas beta del proyecto.
                  </label>
                  <label class="col-md-12">
                    <input type="checkbox" id="newsCheck" value="si" onchange="aceptarNewsletter()">
                    Deseo recibir correos y promociones por parte de Intermed.
                  </label>
                </p>

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-offset-1">
                <div id="contenido" class="hidden invisible">
                  <form method="POST" action="newsletter">
                    <input type="hidden" name="newsletter" id="newsletter">
                    <input type="hidden" name="pruebas" id="pruebas">
                    <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control input-lg validada" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Correo:</label>
                      <input type="email" name="email" class="form-control input-lg validada" id="email" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Enviar" class="btn btn-success btn-lg btn-block"></form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-offset-1">
                <a href="<?= base_url() ?>" class="btn btn-danger btn-lg btn-block">Terminar</a>
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
