<!-- Navigation -->
<nav class="navbar navbar-default navbarMain about Flama">
  <div class="navcontainer container-fluid">
    <div class="row upper-row ruppr text-right">
      <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-8 col-md-offset-8 col-sm-offset-7">
        <p class="text-center">
          <span class="ag-light s15">Atención y contacto: 52 (33) 3125-2200</span><br>
        </p>
      </div>
    </div>
    <div class="row upper-row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo text-left">
        <a class="uppr-logo" href="#page-top">
          <img class="center-block" src="<?=base_url()?>img/logos/intermed.png">
        </a>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 texts text-right hidden-xs">
        <p >
          <span class="flamaBook-normal s15 uppr ls1"><strong>Para:</strong> MÉDICOS PACIENTES INSTITUCIONES PROVEEDORES ASEGURADORAS</span>
        </p>
      </div>
    </div>
  </div>
</nav>
<section class="main2">
  <div class="main-header">
    <div class="container">
      <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
        <p class="text-right">
          <span class="ag-regular s65 shadow">Bienvenido a </span><span class="ag-medium s65 shadow">Intermed<sup><span class="shadow s35">&reg;</span></sup></span><br>
          <span class="ag-medium s30 shadow">La red social de la salud</span>
        </p>
        <p class="text-center">
          <span class="ag-light s25 shadow">¡Conéctate con tu entorno profesional como nunca antes!</span>
        </p>
      </div>
    </div>
  </div>
  <div class="main-body-intern">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
          <?php if ($status != 0){ ?>
            <form class="btn-empezar-encuesta" role="form" method="POST" action="<?php echo base_url(); ?>encuesta">
                  <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                  <button type="submit" class="btn btn-info btn-lg btn-block">
                      Contestar la encuesta
                  </button><br/>
            </form>
          <?php } else {?>
            <?php echo $error ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="main-body">
    <div class="container">
      <div class="row">
        <div class="main-body-container col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
          <div class="col-md-12 col-sm-12 col-xs-12 code-info">
            <h4 class="Flama-normal s20 text-center">
              Intermed® se encuentra en  desarrollo. <br>
              Si has recibido una invitación para participar en la encuesta, ingresa tu código para entrar y conocer mas acerca del proyecto y los servicios que tiene para ti.
            </h4>
          </div>
          <div class="col-md-12 code-info">
            <h4 class="Flama-w900 s20 text-center">Ingresa tu código aquí:</h4>
          </div>
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 code-input">
            <form role="form" method="POST" action="<?= base_url(); ?>about">
              <div class="form-group">
                <input type="text" class="form-control code-intput-control" placeholder="" name="codigo">
              </div>
              <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-default center-block code-intput-button">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main-bg about"></div>
