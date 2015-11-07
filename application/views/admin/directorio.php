<!-- Formulario para agregar contactos al directorio -->
<section id="capturaDirectorio" class="directorioSection">
  <div id="nombreDatos" class="container-fluid nombreDatosContainer" >
    <form method="post" onsubmit="guardarMedico();return false;" id="registroMedico" class="panel">
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
            <button class="form-control btn btn-info" id="agregarDatos" type="submit">
              <span class="glyphicon glyphicon-star-empty"></span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- segunda seccion -->
<section id="calles">
  <div class="container">
    <div class="row"><!-- Inicio row -->
      <form>
        <div class="col-md-8">
          <div class="col-md-6">
            <div class="form-group">
              <label for="direccion">Direccion/es:</label>
              <input type="text" id="nombreDireccion" class="form-control" placeholder="nombre"/>
              <input type="text" id="direccion" class="form-control" placeholder="Calle/s:"/>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" id="estado" class="form-control" placeholder="Estado:"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" id="municipio" class="form-control" placeholder="Municipio:"/>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad:" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" id="localidad" class="form-control" placeholder="localidad" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <button type="button" id="agregaCalles" class="form-control">
            <span class="glyphicon glyphicon-upload"></span>
          </button>
        </div>
      </form>
    </div><!-- FIn row -->
  </div>
</section>
<!-- Fin segunda seccion -->
<!--- INICIO TERCER SECCION -->
<section id="telefonos">
  <div class="container">
    <div class="row">
      <form method="post" onsubmit="guardarTelefono();return false;" id="registroTelefonos" class="panel">
        <div class="col-md-8">
          <div class="col-md-12">
            <h3>Números de teléfono</h3>
            <div class="row">
            <div class="col-md-4">
              <select class="form-control" id="tipoTelefono">
                <option value="casa">Casa</option>
                <option value="celular">Celular</option>
                <option value="oficina">Oficina</option>
                <option value="localizador">Localizador</option>
              </select>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" id="ladaTelefono" class="form-control solo-numero" placeholder="Lada:" maxlength="5" onpaste="soloNumeros()"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="8" onpaste="soloNumeros()"/>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
          <button type="submit" id="enviarFon" class="form-control">
            <span class="glyphicon glyphicon-leaf"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- FIN TERCER SECCION -->
