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
<section class="main">
  <div class="main-header">
    <div class="container">
      <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
        <img class="center-block" src="<?= base_url()?>img/Texto-header.png">
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
            <form role="form" method="POST" action="/encuesta-intermed-mx/about">
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
  <div class="main-extra">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
        <p class="Flama-normal s20 extra-info text-center">
          Si no has recibido un código de invitación pero estas interesado en obtener información acerca de <span class="Flama-w900">intermed<sup>&reg;</sup></span>,
          <a href = "/encuesta-intermed-mx/codigo/pedir" class="Flama-w900 s25">solicítalo aquí</a>
        </p>
      </div>
    </div>
  </div>
</section>
<div class="main-bg"></div>
