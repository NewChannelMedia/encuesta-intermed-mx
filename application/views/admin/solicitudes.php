<?php if( isset($_SESSION['status']) && $_SESSION['status'] == 1 ){?>
  <div id="solicitudes" class="container-fluid">
    <div class="row">
      <ul class="solicitudes-tabs nav nav-tabs">
        <li class="active"><a href="#" id = "pAceptar">Por aceptar</a></li>
        <li><a href="#" id = "nAceptar">No aceptados</a></li>
        <li><a href="#" id = "paceptados">aceptados</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="porAceptar" class="">
          <h3>Estas son las solicitudes que han llegado</h3>
          <div class="table-responsive">
            <table id="pa" class="table table-condensed">
              <thead>
                <tr>
                  <th><center>#</center></th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Cedula</th>
                  <th>Justificacion</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="datosPa"></tbody>
            </table>
          </div>
        </div>
        <div id="noAceptadas" class="hidden">
          <h3>Estas son las solicitudes que no se aceptaron</h3>
          <div class="table-responsive">
            <table id="nAc" class="table table-striped table-condensed">
              <thead>
                <tr>
                  <th><center>#</center></th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Cedula</th>
                  <th>Justificacion</th>
                </tr>
              </thead>
              <tbody id="datosNa"></tbody>
            </table>
          </div>
        </div>
        <div id="aceptados" class="hidden">
          <h3>Estas son las solicitudes que se aceptaron</h3>
          <div class="table-responsive">
            <table id="sAc" class="table table-striped table-condensed">
              <thead>
                <tr>
                  <th><center>#</center></th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Cedula</th>
                  <th>Justificacion</th>
                </tr>
              </thead>
              <tbody id="datosSa"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


    <!-- modal -->
    <div class="modal fade" id="aceptarModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Enviar correo a: <small><span id="codigoCorreo"></span></small></h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-danger" id ="generaCodigo" type ="button"><span class="glyphicon glyphicon-fire"></span></button>
                    </span>
                    <input type="text" id="aleatorioDato"class="form-control" readonly placeholder="Genera un codigo"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <textarea rows="5" class="form-control" id="mensajeAceptado" placeholder="Escribe un mensaje personalizado."></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="enviaCodigoGenerado" class="btn btn-primary pull-left">Enviar codigo</button>
            <button type="button" id="enviarMensaje" class="btn btn-danger pull-right">Enviar mensaje</button>
          </div>
        </div>
      </div>
    </div>
    <!-- SEGUNDO MODAL -->
    <div class="modal fade" id="NoaceptarModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Enviar correo a: <small><span id="codigoCorreo"></span></small></h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <textarea rows="5" class="form-control" id="areaRechazado" placeholder="Escribe un mensaje personalizado."></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-right" id="envioRechazado">Enviar</button>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
