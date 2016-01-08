<!-- Navigation -->
<nav class="navbar navbar-default navbarMain about flama">
  <div class="navcontainer container-fluid">
    <div class="row upper-row ruppr text-right">
      <div class="container">
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-8 col-md-offset-8 col-sm-offset-7">
          <p class="pull-right">
            <span class="ag-light s15">Atención y contacto: 52 (33) 3125-2200</span><br>
          </p>
        </div>
      </div>
    </div>
    <div class="row upper-row">
      <div class="container">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo text-left">
          <a class="uppr-logo" href="<?=base_url()?>">
            <img class="center-block" src="<?=base_url()?>img/logos/intermed.png">
          </a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 texts text-right hidden-xs">
          <ul class="list-inline flama-book s15 uppr">
            <li>
              <strong>Para:</strong>
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
  </div>
</nav>
<section class="main2">
  <div class="main-body-container clearfix">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-1">
          <form method="post" action="<?php echo base_url(); ?>codigo/dataPost" id="datosSolicitud"><!-- main-body-intern-container -->
            <h4 class="flama-normal s20 text-center white-c">Ingresa los siguientes datos para procesar tu solicitud:</h4>
            <div class="form-group col-md-8 col-md-offset-2 usuarioSolcitud">
              <input class="form-control validada" type="text" placeholder="Nombre" name="nombre" id="nombre">
            </div>
            <div class="form-group col-md-8 col-md-offset-2">
              <input class="form-control validada" type="mail" placeholder="E-mail:" name="email" id="e-mail"/>
            </div>
          <div id = "doctor"></div>
            <div class="form-group col-md-8 col-md-offset-2">
              <div class="seleccionador radio flama-normal s20">
                <label>
                  <input class="" type="radio" name="medico" checked="true" value="1" id="medicoRadio"/>
                  Soy Medico
                </label>
                <label>
                  <input class="" type="radio" name="medico" value="0" id="usuarioRadio"/>
                  No soy medico
                </label>
              </div>
            </div>
            <div id="medicoSolicitud" class="form-group col-md-8 col-md-offset-2 ">
              <input class="form-control validada" type="text" placeholder="Ingresa tu cedula profesional, por favor" name="cedula" id="cedula">
            </div>
            <div id=usuarioSolicitud class="form-group col-md-8 col-md-offset-2 hidden">
              <textarea class="form-control validada" rows="5" id="justificacion" name="justificacion" placeholder="Por favor, dinos por qué te gustaría saber mas de Intermed"></textarea>
            </div>
            </br>
            <div class="form-group col-md-8 col-md-offset-2 ">
              <input class="btn btn-success btn-lg btn-block" type="submit" value="Solicitar" id="envioDatos">
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
          <div class="form-group col-md-6 col-md-offset-3">
            <p class="text-center">
              <br>
              <a href="<?echo base_url(); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left"></span>Regresar</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main-bg"></div>
