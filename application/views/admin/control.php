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
                <div class="huge"><?php echo $totalContestadas; ?></div>
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
                <div class="huge"><?php echo $totalPorValidar;?></div>
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
                <div class="huge"><?php echo $totalAceptados;?></div>
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
                <div class="huge"><?php echo $totalRechazados;?></div>
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
            <div class="row">
              <div class="col-md-11">
                <h3 class="panel-title">Encuestas por periodo</h3>
              </div>
              <div class="col-md-1 pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
                <div class="col-md-11">
                  <h3 class="panel-title">Precios propuestos</h3>
                </div>
                <div class="col-md-1 pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
              <div class="col-md-11">
                <h3 class="panel-title">Especialidades</h3>
              </div>
              <div class="col-md-1 pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
              <div class="col-md-11">
                <h3 class="panel-title">Dispositivos</h3>
              </div>
              <div class="col-md-1 pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
              <div class="col-md-11">
                <h3 class="panel-title">Nivel de influencia</h3>
              </div>
              <div class="col-md-1 pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
              <div class="col-md-11">
                <h3 class="panel-title">Edades</h3>
              </div>
              <div class="col-md-1 pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
  </div><!-- /.container -->
<?php } ?>
