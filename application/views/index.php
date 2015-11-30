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
<section class="main">
  <div class="main-header">
    <div class="container">
      <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
        <p class="text-right">
          <span class="ag-regular s65 shadow welcome">Bienvenido a </span><span class="ag-medium s65 shadow">Intermed<sup><span class="shadow s35">&reg;</span></sup></span><br>
          <span class="ag-medium s30 shadow slogan">La red social de la salud</span>
        </p>
        <p class="text-center">
          <span class="ag-light s25 shadow">¡Conéctate con tu entorno profesional como nunca antes!</span>
        </p>
      </div>
    </div>
  </div>
  <div class="main-body">
    <div class="container">
      <div class="row">
        <div class="main-body-container col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
          <div class="col-md-12 col-sm-12 col-xs-12 code-info">
            <h4 class="flama-normal s20 text-center">
              <span class="ag-medium">Intermed<sup>®</sup></span> se encuentra en  desarrollo. <br>
              Si has recibido una invitación para participar en la encuesta, ingresa tu código para entrar y conocer mas acerca del proyecto y los servicios que tiene para ti.
            </h4>
          </div>
          <div class="col-md-12 code-info">
            <h4 class="flama-bold s20 text-center">Ingresa tu código aquí:</h4>
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
  <div class="main-extra">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
        <p class="flama-normal s20 extra-info text-center">
          Si no has recibido un código de invitación pero estas interesado en obtener información acerca de <span class="ag-medium">Intermed<sup>®</sup></span>,
          <a href = "<?php echo base_url(); ?>codigo/pedir" class="flama-bold s25">solicítalo aquí</a>
        </p>
      </div>
    </div>
  </div>
  <div class="container-fluid" id="contacto">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 text-center">
          <h2 class="flama-book s30 text-uppercase white-c">Contácto</h2>
          <form id="frm_contacto" method="POST">
            <h4 class="flama-book s20 text-center white-c">Quieres información de que es <span class="ag-medium">Intermed<sup>®</sup></span></strong>? <br>Usa el siguiente formulario para enviarnos un mensaje:</h4>
            <div class="form-group col-md-12">
              <div class="alert alert-success collapse" role="alert" id="frm_contacto-success">
                Su mensaje ha sido enviado
              </div>
            </div>
            <div class="form-group col-md-12">
              <input class="form-control input-lg" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
            </div>
            <div class="form-group col-md-12">
              <input class="form-control input-lg" type="email" placeholder="E-mail" name="email" id="email" required>
            </div>
            <div class="form-group col-md-12">
              <textarea class="form-control input-lg" rows="5" id="mensaje" name="mensaje" placeholder="Mensaje" required></textarea>
            </div>
            <div class="form-group col-md-12">
              <input class="btn btn-success btn-lg btn-block" type="submit" value="Enviar">
            </div>
          </form>
        </div>
      </div>
  </div>
</section>
<div class="main-bg"></div>
