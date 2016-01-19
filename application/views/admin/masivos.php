<?php if( $total <= 0 ){?>
<section id="generando">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <center>
            <h1> Generar correos para envio masivos</h1>
            <p id="mensajeLleno" class="hidden"></p>
            <p>
              <a class="btn btn-success btn-lg" onclick="emailGenerate();" role="button">E-mails</a>
            </p>
          </center>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }else{?>
  <section id="enviarEmailA" >
    <!-- div spinner -->
    <div class="spinner hidden" id="spin">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
    <!-- div fin spinner -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2 style="color:red">
            Esta por enviar 500 correos a diferentes medicos<br /> <br />
          </h2>
          <span class="hidden" id="todoArray"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <label for="bodyMensaje" class="">Cuerpo del mensaje:</label>
          <textarea rows="8" id="bodyMensaje" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <button class="btn btn-danger btn-block" id="sendToAll">
            <span class="glyphicon glyphicon-screenshot"></span>&nbsp;Enviar a todos
          </button>
        </div>
      </div>
    </div>
  </section><br /><br /> <br />
  <section id="generados">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <label>Escribe el numero de los correos que quieres que se seleccionen</label>
        </div>
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="input-group">
              <input type="text" class="form-control" id="num_seleccionado" placeholder="Nº">
              <span class="input-group-btn">
                <button class="btn btn-warning" id="seleccionEnviar" type="button">
                  <span class="glyphicon glyphicon-magnet"></span>
                </button>
              </span>
            </div>
          </div>
        </div>
      </div><br /> <br />
      <!-- INICIO DE TABS -->
        <div class="container-fluid">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#generarMas" aria-controls="generar" role="tab" data-toggle="tab">
                Generar mas
              </a>
            </li>
            <li role="presentation" onclick="getMails();">
              <a href="#enviarA" aria-controls="enviar" role="tab" data-toggle="tab">
                Enviar a:
              </a>
            </li>
            <li role="presentation" onclick="getMailsSends();">
              <a href="#enviadosA" aria-controls="enviadosA" role="tab" data-toggle="tab">
                Enviados
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="generarMas">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="jumbotron">
                      <center>
                        <h1> Generar correos para envio masivos</h1>
                        <p id="mensajeLleno" class="hidden"></p>
                        <p>
                          <a class="btn btn-success btn-lg" onclick="emailGenerate();" role="button">E-mails</a>
                        </p>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade " id="enviarA">
              <div class="row">
                <div class="col-md-12">
                  <label for="enviosRandom" style="color:red">Lista de correos a los que se les enviara informacion</label>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-condensed" id="enviosRandom">
                      <thead>
                        <th><center><span class="glyphicon glyphicon-envelope"></span>&nbsp; Send:</center></th>
                        <th><center>#</center></th>
                        <th><center><span class="glyphicon glyphicon-envelope"></span>&nbsp;Correos</center></th>
                        <th><center><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</center></th>
                      </thead>
                      <tbody id="loadData"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade"id="enviadosA">
              <div class="row">
                <div class="col-md-12"></div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-condensed" id="enviadosRandom">
                      <thead>
                        <th><center>#</center></th>
                        <th><center><span class="glyphicon glyphicon-envelope"></span>&nbsp;Correos</center></th>
                        <th><center><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</center></th>
                        <!-- <th><center><span class="glyphicon glyphicon-barcode"></span>&nbsp;Codigo enviado</center></th>-->
                      </thead>
                      <tbody id="dataLoad"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- FIN DE TABS -->
    </div>
  </section>
<?php } ?>
