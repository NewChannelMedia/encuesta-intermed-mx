<div class="llamadasWrapper">
  <?php if ($total <= 0){ ?>
    <div class="llamadasSection">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <button class="btn btn-success btn-lg center-block" onclick="generarMuestraMedicos()">Generar</button>
          </div>
        </div>
      </div>
    </div>
  <?php } else {
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
      generarMuestraMedicos();
    });</script>';
  ?>
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <h3 class="panel-title s25">Realizar llamadas</h3>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <button class="btn btn-primary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#ayuda" aria-expanded="false" aria-controls="ayuda">
              Ver Ayuda
            </button>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <button class="btn btn-primary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#status" aria-expanded="false" aria-controls="status">
              Ver Status
            </button>
          </div>
        </div>
        <div class="helpSection collapse" id="ayuda">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <p class="text-muted"><span class="glyphicon glyphicon-chevron-right"></span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
          </div>
        </div>
        <div class="helpSection collapse" id="status">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
              <table class="table table-condensed text-uppercase">
                <tbody>
                  <tr>
                    <td>Total de Medicos Seleccionados</td>
                    <td class="text-center"><strong>500</strong></td>
                  </tr>
                  <tr>
                    <td>Codigos autorizados</td>
                    <td class="text-center"><strong>150</strong></td>
                  </tr>
                  <tr>
                    <td>Rechazados</td>
                    <td class="text-center"><strong>0</strong></td>
                  </tr>
                  <tr>
                    <td>Restantes</td>
                    <td class="text-center"><strong>350</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="padding: 0px">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" onclick="generarMuestraMedicos()">Por hacer</a></li>
          <li role="presentation"><a href="#Pospuestos" aria-controls="Pospuestos" role="tab" data-toggle="tab" onclick="generarMuestraMedicosPospuestos()">Pospuestos</a></li>
        </ul>

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Teléfono</th>
                  <th class="text-center">Correo</th>
                  <th class="text-center">Conf. correo</th>
                  <th class="text-center">Autorizo</th>
                  <th class="text-center">No autorizo</th>
                  <th class="text-center">Guardar</th>
                  <th class="text-center">Posponer</th>
                </tr>
              </thead>
              <tbody id="muestraMed">

              </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane" id="Pospuestos" >
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th class="text-center">Pospuesto</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Teléfono</th>
                  <th class="text-center">Correo</th>
                  <th class="text-center">Conf. correo</th>
                  <th class="text-center">Autorizo</th>
                  <th class="text-center">No autorizo</th>
                  <th class="text-center">Guardar</th>
                  <th class="text-center">Posponer</th>
                </tr>
              </thead>
              <tbody id="muestraMedPos">

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
  <?php } ?>
</div>
