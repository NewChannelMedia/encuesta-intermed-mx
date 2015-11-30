<!-- Navigation -->
<nav class="navbar navbar-default navbarMain about flama">
  <div class="navcontainer container-fluid">
    <div class="row upper-row ruppr text-right">
      <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-8 col-md-offset-8 col-sm-offset-7">
        <p class="pull-right">
          <span class="ag-light s15">Atención y contacto: 52 (33) 3125-2200</span><br>
        </p>
      </div>
    </div>
    <div class="row upper-row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo text-left">
        <a class="uppr-logo" href="<?=base_url()?>">
          <img class="center-block" src="<?=base_url()?>img/logos/intermed.png">
        </a>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 texts text-right hidden-xs" style="padding-top: 30px;">
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
</nav>
<section class="main2">
  <div class="main-header">
    <div class="container">
      <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
        <p class="text-right">
          <span class="ag-regular s65 shadow">Bienvenido a </span><span class="akzidenz ag-medium bold s65 shadow">Intermed<sup><span class="shadow s35">&reg;</span></sup></span><br>
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">
          <?php if ($status != 0){ ?>
            <form class="btn-empezar-encuesta" role="form" method="POST" action="<?php echo base_url(); ?>encuesta">
                  <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                  <button type="submit" class="flama-bold btn btn-info btn-lg btn-block">
                      Contestar la encuesta
                  </button>
            </form>
          <?php } else {?>
            <?php echo $error ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="main-body intern">
    <div class="container">
      <div class="row">
        <div class="main-body-container col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        </div>
      </div>
    </div>
  </div>
</section>
<section id="info">
  <div class="container info-container">
    <div class="row info-row">
      <h1 class="flama-bold s25 text-center">Conoce las ventajas y servicios que Intermed<sup>&reg;</sup> tiene para ti:</h1>
    </div>
    <div class="row info-row">
      <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
        <div class="row info-row">
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center info-selector">
            <div class="selector-btn-container" data-toggle="buttons">
              <h3 class="flama-bold s20">Selecciona una opción</h3>
              <label id="btn1" class="btn btn-default btn-sel active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                <!--<span class="glyphicon glyphicon-comment"></span>-->
              </label>
              <label id="btn2" class="btn btn-default btn-sel">
                <input type="radio" name="options" id="option2" autocomplete="off">
                <!--<span class="glyphicon glyphicon-list-alt"></span>-->
              </label>
              <label id="btn3" class="btn btn-default btn-sel">
                <input type="radio" name="options" id="option3" autocomplete="off">
                <!--<span class="glyphicon glyphicon-user"></span>-->
              </label>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 text-left">
            <div id="comunicacion">
              <div class="info-section">
                <h3 class="flama-bold s20">Comunicación y difusión</h3>
                <p class="flama s15">
                  Intermed® es el mejor canal para dar a conocer tu trabajo,
                  llegar a nuevos clientes y mantener una base de pacientes
                  en constante crecimiento. Deja que nuevos pacientes te
                  encuentren con nuestro directorio, que tus pacientes
                  actuales te recomienden con nuestro sistema de
                  recomendaciones y manten a tus contactos al tanto de tus
                  avances con nuestro editor de publicaciones.
                </p>
              </div>
            </div>
            <div id="funcionalidad">
              <div class="info-section hidden">
                <h3 class="flama-bold s20">Funcionalidad</h3>
                <p class="flama s15">
                  ¡Hemos diseñado la mejor seleción de herramientas para ti!
                  Citas en línea, editor de expedientes en la nube, sistema de
                  publicaciones y estadísticas son algunas de las múltiples
                  funciones de tu Oficina en Intermed®.
                </p>
              </div>
            </div>
            <div id="versatilidad">
              <div class="info-section hidden">
                <h3 class="flama-bold s20">Versatilidad</h3>
                <p class="flama s15">
                  ¿El tiempo es un problema? Intermed® esta diseñado para
                  permitirte delegar las funciones que desees a una tercera
                  persona, sin perder el control y la privacidad de tu
                  información, y nuestra aplicación móvil pone en tus manos
                  toda la funcionalidad de tu oficina en cualquier momento y
                  desde cualquier lugar.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="subComunicacion" class="row info-row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section" id="subComunicacion">
          <div class="media-left">
            <div id="info-img-s1" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Red Social</h4>
            <p class="flama s15">
              Intermed® es una comunidad que se basa en las mécanicas de las redes sociales, poniendo a tu disposición las funciones mas útiles de estás.
Además de incluir herramientas profesionales especificas para tus labores como médico, te permite mantenerte en contacto con tu entorno de trabajo. (Pacientes, colegas, proveedores, etc.)
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s2" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Directorio</h4>
            <p class="flama s15">
              La forma mas rápida y efectiva para lograr que nuevos pacientes te contacten.
Nuestro directorio inteligente muestra una liga y un resumen de tu perfil, que además aparecerá listado en los principales motores de busqueda del mundo.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s3" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Recomendaciones</h4>
            <p class="flama s15">
              Nuestro sistema permite a los usuarios (pacientes) intercambiar recomendaciones con sus contactos dentro y fuera de la red Intermed®.
La nueva publicidad “de boca en boca”.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s4" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Librería de Publicaciones</h4>
            <p class="flama s15">
              Intermed® tambien es una plataforma para compartir información y conocimientos.
Desde tu propia Oficina Intermed, publica y comparte artículos y publicaciones con tu comunidad.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="subFuncionalidad" class="row info-row hidden">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section" id="subComunicacion">
          <div class="media-left">
            <div id="info-img-s5" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Agenda en Línea</h4>
            <p class="flama s15">
              La manera mas moderna y eficiente de manejar las citas con tus pacientes.
Nuestro sistema le permite a tus pacientes agendar citas según tus horarios particulares, desde su computadora o móvil.
Modifica estas citas desde cualquier lugar y en cualquier momento y tus pacientes serán notificados instantáneamente.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s6" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Expedientes</h4>
            <p class="flama s15">
              Consulta, edita y actualiza tus expedientes en cualquier momento y desde cualquier lugar, vinculándolos a los perfiles de tus pacientes en la red social.
Nuestro sistema de expedientes en línea te permitira manejar tu información de manera mas segura, dinámica y eficiente que nunca.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s7" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Estadísticas</h4>
            <p class="flama s15">
              Recibe valiosa información directamente de tus pacientes.
Al término de cada cita, tus pacientes podrán evaluar el servicio recibido, y sus evaluaciones se reflejarán en estadísticas que podrás consultar de manera privada.
¡Identifica y fortalece tus áreas de oportunidad!.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s8" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Facturación digital</h4>
            <p class="flama s15">
              Intermed® incluye un sistema de facturación digital para que puedas expedir facturas desde tu perfil cuando tus pacientes así lo requieran.
Lleva el control fiscal de tus actividades de una manera clara y sencilla.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="subVersatilidad" class="row info-row hidden">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section" id="subComunicacion">
          <div class="media-left">
            <div id="info-img-s9" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Secretaria</h4>
            <p class="flama s15">
              Delega el control de tu perfil a tu secretaría, especificando cuales aspectos deseas que ella maneje.
Actualización de publicaciones, atención a dudas y preguntas de tus pacientes o manejo de tu agenda, son tan solo algunas de las funciones que esta función te permite delegar.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="media info-section">
          <div class="media-left">
            <div id="info-img-s10" class="info-img media-object img-circle"></div>
          </div>
          <div class="media-body">
            <h4 class="s20 flama-bold media-heading">Versión móvil</h4>
            <p class="flama s15">
              Lleva contigo todos los beneficios de Intermed® con nuestra versión móvil.
Agenda y mofica citas, consulta y edita expedientes de tus pacientes y mantente en contacto con ellos desde cualquier parte y en cualquier momento con tu smartphone o tablet.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="main-bg about"><div class="grad"></div></div>
