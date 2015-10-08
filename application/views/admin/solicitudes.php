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
              <div class="col-xs-3">
                <span class="glyphicon glyphicon-ok-sign s65"></span>
              </div>
              <div class="col-xs-9 text-right">
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
                <span class="glyphicon glyphicon-info-sign s65"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">12</div>
                <div>Solicitudes en espera</div>
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
                <span class="glyphicon glyphicon-plus-sign s65"></span>
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
                <span class="glyphicon glyphicon-question-sign s65"></span>
              </div>
              <div class="col-xs-8 text-right">
                <div class="huge">13</div>
                <div>Solcitudes de informacion</div>
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
      <div class="col-md-12">
        <div id="porAceptar" class="hidden">
          <h1>Estas son las solicitudes que han llegado</h1>
          <table id="pa" class="table table-hover table-condensed">
              <thead>
                  <tr class="warning">
                    <th><center>#</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Correo</center></th>
                    <th><center>Cedula</center></th>
                    <th><center>Justificacion</center></th>
                    <th><center>Aceptar</center></th>
                    <th><center>Rechazar</center></th>
                  </tr>
              </thead>
              <tbody id="datosPa"></tbody>
          </table>
        </div>
        <div id="noAceptadas" class="hidden">
          <h1>Estas son las solicitudes que no se aceptaron</h1>
          <table id="nAc" class="table table-bordered table-striped">
              <thead>
                  <tr class="danger">
                    <th><center>#</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Correo</center></th>
                    <th><center>Cedula</center></th>
                    <th><center>Justificacion</center></th>
                  </tr>
              </thead>
              <tbody id="nAceptados"></tbody>
          </table>
        </div>
        <div id="noAceptadas" class="hidden">
          <h1>Estas son las solicitudes que no se aceptaron</h1>
          <table id="nAc" class="table table-bordered table-striped">
              <thead>
                  <tr class="danger">
                    <th><center>#</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Correo</center></th>
                    <th><center>Cedula</center></th>
                    <th><center>Justificacion</center></th>
                  </tr>
              </thead>
              <tbody id="nAceptados"></tbody>
          </table>
        </div>
        <div id="aceptados" class="hidden">
          <h1>Estas son las solicitudes que estan aceptadas</h1>
          <table id="ace" class="table table-bordered">
              <thead>
                  <tr class="success">
                    <th><center>#</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Correo</center></th>
                    <th><center>Cedula</center></th>
                    <th><center>Justificacion</center></th>
                  </tr>
              </thead>
              <tbody id="idAceptados"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div><!-- /.container -->

  <!-- modal -->
  <div class="modal fade" id="aceptarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Enviar mensaje de aceptado</h4>
        </div>
        <div class="modal-body">
          <div class="">
            <div class="row">
                <div class="col-md-6">
                  <label>Generar código para:&nbsp;<br /><span id="codigoCorreo"></span></label>
                  <hr>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-danger" id ="generaCodigo" type ="button"><span class="glyphicon glyphicon-fire"></span></button>
                    </span>
                    <input type="text" id="aleatorioDato"class="form-control" readonly/>
                  </div>
                  <div class="col-md-12">
                    <button type="button" id="enviaCodigoGenerado" class="form-control btn btn-primary">Enviar codigo</button>
                  </div>
                </div>
                <div class="col-md-6 separador">
                  <div class="col-md-12">
                    <textarea class="form-control" id="mensajeAceptado"></textarea>
                  </div>
                  <div class="col-md-12">
                    <button type="button" class="form-control btn btn-danger" id="enviarMensaje">Enviar mensaje</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- SEGUNDO MODAL -->
  <div class="modal fade" id="NoaceptarModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Rechazados</h4>
          </div>
          <div class="modal-body">
            <div class ="">
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <textarea class="form-control" id="areaRechazado"></textarea>
                    </div>
                    <div class="col-md-12">
                      <button type="button" class="form-control btn btn-success"id="envioRechazado">Enviar</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
