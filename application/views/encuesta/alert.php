<!-- Navigation -->
<nav class="navbar navbar-default navbarMain2 flama-normal">
  <div class="navcontainer container">
    <div class="row upper-row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 logo text-center">
        <a href="<?=base_url()?>">
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
          <h1 class="flama-Bold s35 text-center text-danger shadow"><strong><?= $encabezado ?></strong></h1>';
          <div class="row message-container">
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
              <p class="flama-normal s20 white-c text-center">
                <?= $mensaje?>
              </p>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-offset-1">
              <a href="<?= base_url() ?>" class="btn btn-danger btn-lg btn-block">Regresar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  if($title != "Error"){
    echo '<div class="main3-bg"></div>';
  }else {
    echo '<div class="main2-bg"></div>';
  }
 ?>
