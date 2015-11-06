<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <h3 class="panel-title">Encuestas por periodo</h3>
          </div>
          <div class="col-lg-2 col-md-2 pull-right">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu list-inline" role="menu">
              <?php echo $drop_encPer; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_encuestasPorPeriodo"></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
          <div class="row">
            <div class="col-lg-10 col-md-10">
              <h3 class="panel-title">Precios propuestos</h3>
            </div>
            <div class="col-lg-2 col-md-2 pull-right">
              <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                  <span class="caret"></span>
              </button>
              <ul class="dropdown-menu list-inline" role="menu">
                <?php echo $drop_precios; ?>
              </ul>
            </div>
          </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_preciosPropuestos"></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <h3 class="panel-title">Especialidades</h3>
          </div>
          <div class="col-lg-2 col-md-2 pull-right">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu list-inline" role="menu">
              <?php echo $drop_especialidades; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_especialidades"></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <h3 class="panel-title">Dispositivos</h3>
          </div>
          <div class="col-lg-2 col-md-2 pull-right">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu list-inline" role="menu">
              <?php echo $drop_dispositivos; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_dispositivos"></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <h3 class="panel-title">Nivel de influencia</h3>
          </div>
          <div class="col-lg-2 col-md-2 pull-right">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu list-inline" role="menu">
              <?php echo $drop_tecnologia; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_influenciaTecnologia"></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <h3 class="panel-title">Edades</h3>
          </div>
          <div class="col-lg-2 col-md-2 pull-right">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu list-inline" role="menu">
              <?php echo $drop_edades; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="grafica dashboard" id="div_edades"></div>
      </div>
    </div>
  </div>
</div>
