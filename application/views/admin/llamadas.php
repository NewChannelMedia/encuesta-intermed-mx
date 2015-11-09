<section>
  <div class="container-fluid">
    <div class="panel-body">
      <div class="row">
        <?php if ($total <= 0){ ?>
        <div class="col-md-12">
          <div class="col-md-6" id="generar">
            <div class="jumbotron">
              <p><a class="btn btn-danger btn-lg" href="#" role="button" onclick="generarMuestraMedicos()">Generar contenido</a></p>
            </div>
          </div>
          <div class="col-md-6" id="mensajes"></div>
        </div>
        <?php } else {
          echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
            generarMuestraMedicos();
          });</script>';
          ?>
          <div class="col-md-12">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
                  <th>Conf. correo</th>
                  <th>Autorizo</th>
                  <th>No autorizo</th>
                  <th>Guardar</th>
                </tr>
              </thead>
              <tbody id="muestraMed">

              </tbody>
            </table>
          </div>
        <?php
        }?>
      </div>
    </div>
  </div>
</section>
