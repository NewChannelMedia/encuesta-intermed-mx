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
      <?php if($errorM != "") {?>
        <div class="row">
          <div class="alert alert-danger" role="alert">
            <p>
              <?= $errorM ?>
            </p>
          </div>
        </div>
      <?php }?>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-1 col-xs-offset-1">
          <div class="row">
            <h4 class="Flama-normal s20 text-center white">Login como administrador</h4>
            <div class="mensaje Flama-normal s20 white col-md-10 col-md-offset-1">
              <form method="POST" action ="<?= base_url()?>admin/control" id="loginAdmin">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="userLog" name="user" placeholder="Usuario:"/>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" id="pass" name="password" placeholder="Password:" />
                </div>
                <div class="row">
                  <div class="form-group col-md-6 pull-right">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Sign in</button>
                  </div>
                  <div class="form-group col-md-6 pull-left">
                    <a href="<?echo base_url(); ?>" class="btn btn-danger btn-lg btn-block">Regresar</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main2-bg"></div>
