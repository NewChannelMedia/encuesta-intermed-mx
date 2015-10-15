<!-- Navigation -->
<nav class="navbar navbar-default navbarMain Flama">
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
          <?php if ($status != 0){ ?>
            <form role="form" method="POST" action="<?php echo base_url(); ?>encuesta">
                  <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                  <button type="submit" class="btn btn-success btn-lg btn-block">
                      Contestar la encuesta
                  </button><br/>
            </form>
          <?php } else {?>
            <?php echo $error ?>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
        </br><a href="<?echo base_url();; ?>" class="btn btn-danger btn-lg btn-block">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main2-bg"></div>
