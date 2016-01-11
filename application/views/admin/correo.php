<div class="llamadasWrapper">
  <?php if ($total <= 0){ ?>
    <div class="llamadasSection">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <button class="btn btn-success btn-lg center-block" onclick="generarMuestraMedicos_correo()">Generar</button>
          </div>
        </div>
      </div>
    </div>
  <?php } else {
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
      generarMuestraMedicos_correo();
    });</script>';
  ?>
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <h3 class="panel-title s25">Encuestas físicas a enviar</h3>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
            <button class="btn btn-primary btn-sm btn-block" onclick="ExportarAExcell('EncuestasFisicas')">
              Exportar
            </button>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-condensed" id="EncuestasFisicas">
          <thead>
            <tr>
              <th class="text-center text-capitalize" style="width:20%">Nombre</th>
              <th class="text-center" style="width:70%">Direcciones</th>
              <th class="text-center" style="width:10%">Código</th>
            </tr>
          </thead>
          <tbody id="muestraMedCorreo">

          </tbody>
        </table>
      </div>
    </div>
  </section>
  <?php } ?>
</div>
