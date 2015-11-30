<!-- Navigation -->
<nav class="navbar navbar-default navbarMain ">
  <div class="navcontainer container">
    <div class="row upper-row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo text-left">
        <a href="<?=base_url()?>">
          <img class="center-block" src="<?=base_url()?>img/logos/intermedWhite.png">
        </a>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 texts text-right hidden-xs">
        <p >
          <span class="ag-light s15 white-c">Atención y contacto: 52 (33) 3125-2200</span><br>
        </p>
          <ul class="list-inline flama-normal s15 white-c text-uppercase">
            <li class="flama-bold">
              Para:
            </li>
            <li>
              MEDICOS
            </li>
            <li>
              PACIENTES
            </li>
            <li>
              INSTITUCIONES
            </li>
            <li>
              PROVEEDORES
            </li>
            <li>
              ASEGURADORAS
            </li>
          </ul>
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
            <h4 class="flama-medium s20 text-center white-c text-uppercase">Login como administrador</h4>
            <div class="mensaje flama-normal s20 white-c col-md-10 col-md-offset-1">
              <form method="POST" action ="<?= base_url()?>admin/control" id="loginAdmin">
                <div class="form-group">
                  <input type="text" class="validada form-control input-lg" id="userLog" name="user" placeholder="Usuario:"/>
                </div>
                <div class="form-group">
                  <input type="password" class="validada form-control input-lg" id="pass" name="password" placeholder="Password:" />
                </div>
                <div class="row">
                  <div class="form-group col-md-6 pull-right">
                    <input class="btn btn-success btn-lg btn-block" type="submit" value="Sing in" disabled>
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
