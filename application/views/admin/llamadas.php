<section class="helpSection">
  <?php if ($total <= 0){ ?>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <button class="btn btn-success btn-lg center-block">Generar</button>
        </div>
      </div>
    </div>
    <?php } else { ?>
    <div class="row">
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="col-md-2">
        <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      </div>
    </div>
  <?php } ?>
</section>

<section class="llamadasSection container-fluid">
  <div class="contaer-fluid">
    <div class="panel">
      <?php if ($total <= 0){ ?>
        <div class="panel-body text-center">
          <span class="glyphicon glyphicon-triangle-bottom s20 white"></span>
        </div>
      <?php } else {
        echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
          generarMuestraMedicos();
        });</script>';
      ?>
      <div class="panel-heading">
        <h3 class="panel-title">Realizar llamadas</h3>
      </div>
      <div class="panel-body">
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

      <?php } ?>
    </div>
  </div>
</section>
