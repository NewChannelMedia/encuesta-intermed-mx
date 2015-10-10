<?php if( isset($_SESSION['status']) && $_SESSION['status'] == 1 ){?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h3>Bienvenido <?php echo $administrador; ?></h3>
        <h4 id="mensaje"></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-4">
                <span class="glyphicon glyphicon-ok-sign s60"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">26</div>
                <div>Encuestas contestadas</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left">Ver Detalles</span>
              <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-green">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-4">
                <span class="glyphicon glyphicon-info-sign s60"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">12</div>
                <div>Solicitudes por aceptar</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left">Ver Detalles</span>
              <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-yellow">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-4">
                <span class="glyphicon glyphicon-plus-sign s60"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">124</div>
                <div>Suscripciones nuevas</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left">Ver Detalles</span>
              <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-red">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-4">
                <span class="glyphicon glyphicon-question-sign s60"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">13</div>
                <div>Solcitud de informacion</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left">Ver Detalles</span>
              <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Encuestas por periodo</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Precios propuestos</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Especialidades</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Dispositivos</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Nivel de influencia</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edades</h3>
          </div>
          <div class="panel-body">

          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container -->
<?php } ?>
