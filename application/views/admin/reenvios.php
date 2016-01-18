<div class="llamadasWrapper">
  REENVIOS:
  <pre><?php echo print_r($reenvios,1); ?></pre>
  <?php
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
      traerDisponiblesReenvio();
    });</script>';
  ?>
  <section class="llamadasSection container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
      <h1>Encuestas disponibles para reenvio</h1>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="margin-top:30px">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th class="text-center">id</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Correo</th>
            <th class="text-center">Código</th>
            <th class="text-center">Tipo canal</th>
          </tr>
        </thead>
        <tbody id="ReenvioMuestras">

        </tbody>
      </table>
    </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-top:30px">
        <input type="button" class="btn btn-warning btn-block" value="Reenviar">
      </div>
  </section>
</div>
