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
          <div class="col-md-8">
            <div class="row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="nombre" placeholder="Nombre(s)">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="apellidoP" placeholder="Apellido paterno">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="apellidoM" placeholder="Apellido materno">
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" id="email" placeholder="E-mail:">
              </div>
              <div class="form-group col-md-6">
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
          <div class="col-md-4">
            <div class="form-group">
              <button class="btn btn-info btn-block" id="agregarDatos" type="submit">Guardar Medico</button>
            </div>
            <div class="form-group">
              <button class="btn btn-warning btn-block" id="agregarDireccion">Editar</button>
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
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="nombreDireccion" placeholder="Nombre">
              </div>
              <div class="form-group col-md-5">
                <input type="text" class="form-control" id="direccion" placeholder="Calle">
              </div>
              <div class="form-group col-md-3">
                <input type="text" class="form-control" id="numero" placeholder="Numero">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="cp" placeholder="Codigo Postal">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="estado" placeholder="Estado">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="municipio" placeholder="Municipio">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="localidad" placeholder="Colonia / Localidad">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <button class="btn btn-info btn-block" id="agregarDireccion">Añadir Dirección</button>
            </div>
            <!--empiezan los botones de edicion-->
            <div class="btn-group edit-btns text-center" data-toggle="buttons">
              <div class="input-group-btn">
                <label class="btn btn-sm editar btnChk">
                  <input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""> Direccion 1
                </label>
                <button class="btn btn-sm borrar" disabled="disabled"><span class="glyphicon glyphicon-remove"></span></button>
              </div>
              <div class="input-group-btn">
                <label class="btn btn-sm editar btnChk">
                  <input type="radio" name="editDirecciones" id="option2" autocomplete="off" class=""> Direccion 2
                </label>
                <button class="btn btn-sm borrar" disabled="disabled"><span class="glyphicon glyphicon-remove"></span></button>
              </div>
              <div class="input-group-btn">
                <label class="btn btn-sm editar btnChk">
                  <input type="radio" name="editDirecciones" id="option3" autocomplete="off" class=""> Direccion 3
                </label>
                <button class="btn btn-sm borrar" disabled="disabled"><span class="glyphicon glyphicon-remove"></span></button>
              </div>

              <!-- este boton es para terminar de editar entradas y añadir nuevas-->
              <!-- debe quitar los checked de cada radio, limpiar el formulario y dejar activo el boton de añadir -->
              <div class="input-group-btn">
                <button class="btn btn-success btn-sm btnClean hidden" onclick="limpiaSection('#direccionDatos');">Añadir Nuevo &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
              </div>
            </div>
            <!--terminan los botones de edicion-->
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="telefonos" class="container-fluid " >
      <form method="post" onsubmit="guardarTelefono();return false;" id="registroTelefonos" class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Teléfonos</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="form-group col-md-3">
                <input type="text" id="ladaTelefono" class="form-control solo-numero" placeholder="Lada:" maxlength="5" onpaste="soloNumeros()"/>
              </div>
              <div class="form-group col-md-4">
                <input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="8" onpaste="soloNumeros()"/>
              </div>
              <div class="form-group col-md-5">
                <select class="form-control" id="tipoTelefono">
                  <option value="casa">Casa</option>
                  <option value="celular">Celular</option>
                  <option value="oficina">Oficina</option>
                  <option value="localizador">Localizador</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <button type="submit" class="btn btn-info btn-block" id="enviarFon">Añadir Telefono</button>
            </div>
            <div class="form-group">
              <ul class="list-inline">
                <li>
                  <button id="telefonoGuardado-1" class="btn btn-sm editar">Telefono 1</button>
                </li>
                <li>
                  <button id="telefonoGuardado-2" class="btn btn-sm editar">Telefono 2</button>
                </li>
              </ul>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
        <button class="btn btn-success btn-lg btn-block s20 uppr">Siguiente <span class="glyphicon glyphicon-arrow-right"</button>
      </div>
    </div>
  </div>
</section>
<!-- FIN TERCER SECCION -->
