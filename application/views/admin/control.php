
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Encuestas Intermed</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" id = "pAceptar">Por aceptar</a></li>
            <li><a href="#" id = "nAceptar">No aceptados</a></li>
            <li><a href="#" id = "paceptados">aceptados</a></li>
            <li><a href = "#" id = "">salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>

<div id="admin-page" class="container">

  <div class="starter-template">
    <h1>Bienvenido administrador <?php echo $administrador; ?></h1>
    <h2 id="mensaje"></h2>
    <p class="lead">Esta es la pagina de inicio</p>
  </div>
  <div id = "porAceptar" class = "hidden">
    <h1>Estas son las solicitudes que han llegado</h1>
    <table id = "pa" class = "table table-hover table-striped table-bordered">
        <thead>
            <tr class = "warning">
              <th><center>#</center></th>
              <th><center>Nombre</center></th>
              <th><center>Correo</center></th>
              <th><center>Cedula</center></th>
              <th><center>Justificacion</center></th>
              <th><center>Aceptar</center></th>
              <th><center>Rechazar</center></th>
            </tr>
        </thead>
        <tbody id = "datosPa"></tbody>
    </table>
  </div>
  <div id = "noAceptadas" class = "hidden">
    <h1>Estas son las solicitudes que no se aceptaron</h1>
    <table id = "nAc" class = "table table-bordered table-striped">
        <thead>
            <tr class = "danger">
              <th><center>#</center></th>
              <th><center>Nombre</center></th>
              <th><center>Correo</center></th>
              <th><center>Cedula</center></th>
              <th><center>Justificacion</center></th>
            </tr>
        </thead>
        <tbody id = "nAceptados"></tbody>
    </table>
  </div>
  <div id = "aceptados" class = "hidden">
    <h1>Estas son las solicitudes que estan aceptadas</h1>
    <table id = "ace" class = "table table-bordered">
        <thead>
            <tr class = "success">
              <th><center>#</center></th>
              <th><center>Nombre</center></th>
              <th><center>Correo</center></th>
              <th><center>Cedula</center></th>
              <th><center>Justificacion</center></th>
            </tr>
        </thead>
        <tbody id = "idAceptados"></tbody>
    </table>
  </div>
</div><!-- /.container -->
