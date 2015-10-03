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
  <div class="main-body-intern">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-1">
          <form method="post" action="/encuesta-intermed-mx/codigo/pedir" id="datosSolicitud"><!-- main-body-intern-container -->
            <div class="h400">
              <h4 class="Flama-normal s20 text-center white">Ingresa los siguientes datos para procesar tu solicitud:</h4>
              <div class="form-group col-md-8 col-md-offset-2 usuarioSolcitud">
                <input class="form-control" type="text" placeholder="Nombre">
              </div>
              <div class="form-group col-md-8 col-md-offset-2">
                <input class="form-control" type="mail" id="e-mail" name="email" placeholder="E-mail:"/>
              </div>
            <div id = "doctor"></div>
              <div class="form-group col-md-8 col-md-offset-2">
                <div class="seleccionador radio">
                  <label>
                    <input class="" type="radio" id="medicoRadio" name="check" checked="true" value="0"/>
                    Soy Medico
                  </label>
                  <label>
                    <input class="" type="radio" id="usuarioRadio" name="check" value="1" />
                    No soy medico
                  </label>
                </div>
              </div>
              <div id="medicoSolicitud" class="form-group col-md-8 col-md-offset-2 ">
                <input class="form-control" type="text" id="cedula" name="cedula" placeholder="Ingresa tu cedula profesional, por favor">
              </div>
              <div id=usuarioSolicitud class="form-group col-md-8 col-md-offset-2 hidden">
                <textarea class="form-control" rows="5" id="justificacion" name="justificacion" placeholder="Por favor, dinos por qué te gustaría saber mas de Intermed"></textarea>
              </div>
              </br>
              <div class="form-group col-md-8 col-md-offset-2 ">
                <input class="btn btn-info btn-block" type="submit" value="solicitar" id="envioDatos">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row hidden invisible">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-1">
          <div class="">
            <form class="" method = "POST" id = "correo" action = "/encuesta-intermed-mx/codigo/dataPostCorreo">
              <h4 class="Flama-normal s20 text-center">Ingresa los siguientes datos para procesar tu solicitud:</h4>
              <div class="form-group col-md-8 col-md-offset-2">
                <input class="form-control" type="mail" id="e-mail" name="email" placeholder="E-mail:"/><br />
                <input class="btn btn-default btn-block" type="submit" value="solicitar" id="envioEmail">
              </div>
            </form>
            <div id = "doctor"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main2-bg"></div>
