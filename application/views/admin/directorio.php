<!-- Formulario para agregar contactos al directorio -->
<section class="directorioSection container">
  <div id="nombreDatos" class="container-fluid" >
    <form method="post" onsubmit="return false;" id="registroMedico" class="panel">
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
                                <select class="form-control" id="especialidad" >
                  <option class="defoption" value="">Especialidad</option>
                  <?php
                    foreach ($especialidades as $especialidad) {
                      echo '<option value="' . $especialidad['id'] . '">'. $especialidad['especialidad'] .'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <button class="btn btn-info btn-block" id="agregarDatos" onclick="guardarMedico()">Guardar Medico</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="direccion" class="container-fluid " >
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
                <input type="email" class="form-control" id="municipio" placeholder="Municipio">
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" id="ciudad" placeholder="Ciudad">
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" id="localidad" placeholder="Colonia / Localidad">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <button class="btn btn-info btn-block" id="agregarDireccion">Añadir Dirección</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="telefonos" class="container-fluid " >
    <form method="post" onsubmit="return false;" id="registroMedico" class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Teléfonos</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="form-group col-md-3">
                <input type="text" id="lada" class="form-control" placeholder="Lada"/>
              </div>
              <div class="form-group col-md-4">
                <input type="text" id="numTelefono" class="form-control" placeholder="Número" />
              </div>
              <div class="form-group col-md-5">
                <select class="form-control">
                  <option value="">Tipo</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <button class="btn btn-info btn-block" id="enviarFon">Añadir Telefono</button>
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
<script src="<?echo base_url(); ?>js/utils-capturista.js"></script>
