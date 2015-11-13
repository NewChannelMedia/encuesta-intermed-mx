<!-- Formulario para agregar contactos al directorio -->
<section class="directorioSection container">
  <div id="nombreDatos" class="container-fluid" >
    <form method="post" onsubmit="guardarMedico();return false;" id="registroMedico" class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Datos Generales del Medico</h3>
      </div>
      <div class="panel-body">
	      <input type="hidden" id="medico_id" value="">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <div class="form-group col-md-4 col-sm-4">
                <input type="text" class="form-control" id="nombre" placeholder="Nombre(s)">
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <input type="text" class="form-control" id="apellidoP" placeholder="Apellido paterno">
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <input type="text" class="form-control" id="apellidoM" placeholder="Apellido materno">
              </div>
              <div class="form-group col-md-6 col-sm-6">
                <input type="email" class="form-control" id="email" placeholder="E-mail:">
              </div>
              <div class="form-group col-md-6 col-sm-6">
                <input type="text" class="form-control" id="especialidad" placeholder="Especialidad:">
                <?php
                  echo '<script type="text/javascript">var autocompleteEspecialidades = [];</script>';
                  foreach ($especialidades as $especialidad) {
                    echo '<script type="text/javascript">autocompleteEspecialidades.push("'.$especialidad['especialidad'].'")</script>';
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <button class="btn btn-info btn-block" id="agregarDatos" type="submit">Guardar Medico</button>
            </div>
            <div class="form-group">
              <button class="btn btn-warning btn-block" id="editarDatos" disabled=true>Editar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="direccionDatos" class="container-fluid " >
    <form method="post" onsubmit="return false;" id="registroDireccion" class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Direcciones</h3>
        <input type="hidden" class="hidden" id="superOculto" value="">
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <div class="form-group col-md-4 col-sm-4">
                <input type="text" class="form-control" id="nombreDireccion" placeholder="Nombre">
              </div>
              <div class="form-group col-md-5 col-sm-5">
                <input type="text" class="form-control" id="direccion" placeholder="Calle">
              </div>
              <div class="form-group col-md-3 col-sm-3">
                <input type="text" class="form-control" id="numero" placeholder="Numero">
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <select class="form-control" id="estado" placeholder="Estado">
                  <option value="">Estado</option>
                <?php
                  foreach ($estados as $estado) {
                    echo '<option value="'.$estado['id'].'" onchange="treaerMunicipios()">'.$estado['estado'].'</option>';
                  }
                ?>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <select class="form-control" id="municipio" placeholder="Municipio"><option value="">Municipio/Ciudad</option></select>
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <select class="form-control" id="localidad"><option value="">Localidad/Colonia</option></select>
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <input class="form-control" type="text" id="otralocalidad" placeholder="Otra localidad / colonia">
              </div>
              <div class="form-group col-md-4 col-sm-4">
                <input type="text" class="form-control" id="cp" placeholder="Codigo Postal">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <button class="btn btn-info btn-block btnAñade" id="agregarDireccion">Añadir</button>
            </div>
            <div id="editDinamico" class="btn-group edit-btns text-center" data-toggle="buttons">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="telefonos" class="container-fluid " >
      <form method="post" onsubmit="guardarTelefono();return false;" id="registroTelefonos" class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Teléfonos</h3>
        <input type="hidden" class="hidden" id="fonOculto" value=""/>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <div class="form-group col-md-6 col-sm-6">
                <input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/>
              </div>
              <div class="form-group col-md-6 col-sm-6">
                <select class="form-control" id="tipoTelefono">
                  <option value="casa">Casa</option>
                  <option value="celular">Celular</option>
                  <option value="oficina">Oficina</option>
                  <option value="localizador">Localizador</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <button type="submit" class="btn btn-info btnAñade btn-block" id="enviarFon">Añadir</button>
            </div>
            <div id="fonAgregado" class="btn-group edit-btns text-center" data-toggle="buttons">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
        <button class="btn btn-success btn-lg btn-block s20 uppr" onclick="LimpiarFormularios()">Siguiente <span class="glyphicon glyphicon-arrow-right"</button>
      </div>
    </div>
  </div>
</section>
<!-- FIN TERCER SECCION -->
